<?php
/**
 * Proxy de traduccion (DeepL) para el panel de administracion.
 *
 * POST application/json: {"texts": ["..", ".."], "source": "es", "target": "en", "html": true}
 * Respuesta:             {"translations": ["..", ".."]}
 * Errores:               {"error": "..."} con codigo HTTP != 200
 *                        501 = no hay clave configurada (el cliente usa su respaldo)
 */

session_start();
header('Content-Type: application/json; charset=utf-8');

function responde($codigo, $datos)
{
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    exit;
}

// Solo usuarios autenticados en el admin
if (empty($_SESSION['user_id'])) {
    responde(401, ['error' => 'No autenticado']);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== 0) {
    responde(405, ['error' => 'Metodo no permitido']);
}

$config = require __DIR__ . '/translate_config.php';
$clave = trim($config['deepl_key'] ?? '');
if ($clave === '') {
    responde(501, ['error' => 'DeepL no configurado']);
}

$in = json_decode(file_get_contents('php://input'), true);
$textos = $in['texts'] ?? null;
$origen = strtoupper($in['source'] ?? '');
$destino = strtoupper($in['target'] ?? '');
$esHtml = !empty($in['html']);

$validos = ['EN', 'ES', 'DE'];
if (!is_array($textos) || !$textos || !in_array($origen, $validos, true) || !in_array($destino, $validos, true)) {
    responde(400, ['error' => 'Parametros no validos']);
}
$textos = array_map('strval', array_values($textos));
if (count($textos) > 20 || array_sum(array_map('mb_strlen', $textos)) > 100000) {
    responde(413, ['error' => 'Texto demasiado largo']);
}

// DeepL exige variante regional para el ingles de destino
if ($destino === 'EN') {
    $destino = 'EN-GB';
}

$host = trim($config['deepl_host'] ?? '');
if ($host === '') {
    $host = (substr($clave, -3) === ':fx') ? 'api-free.deepl.com' : 'api.deepl.com';
}
$cuerpo = [
    'text' => $textos,
    'source_lang' => $origen,
    'target_lang' => $destino,
];
if ($esHtml) {
    $cuerpo['tag_handling'] = 'html';
}

$ch = curl_init("https://$host/v2/translate");
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($cuerpo, JSON_UNESCAPED_UNICODE),
    CURLOPT_HTTPHEADER => [
        'Authorization: DeepL-Auth-Key ' . $clave,
        'Content-Type: application/json',
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
]);
$respuesta = curl_exec($ch);
$http = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
$errCurl = curl_error($ch);

if ($respuesta === false) {
    responde(502, ['error' => 'No se pudo conectar con DeepL: ' . $errCurl]);
}
$datos = json_decode($respuesta, true);
if ($http !== 200 || !isset($datos['translations'])) {
    $mensajes = [
        403 => 'Clave de DeepL no valida',
        456 => 'Cuota de DeepL agotada este mes',
        429 => 'Demasiadas peticiones a DeepL, reintenta en un momento',
    ];
    responde(502, ['error' => $mensajes[$http] ?? ('Error de DeepL (HTTP ' . $http . ')')]);
}

responde(200, ['translations' => array_column($datos['translations'], 'text')]);
