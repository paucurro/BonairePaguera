<?php require_once '_config.php'; ?>
<?php require_once 'Connections/bonaire_atalaya_db.php'; ?>
<?php

const POR_PAGINA = 10;

$offset = max(0, (int)($_REQUEST['offset'] ?? 0));

mysqli_select_db($bonaire_atalaya_db, $database_bonaire_atalaya_db);

// Visible solo si: activo, ya ha llegado su fecha de activacion y aun no ha caducado
$query_tabla = "SELECT post.*, DATE_FORMAT(COALESCE(post.publish_at, post.created_at), '%d/%m/%Y') AS fecha, category.name AS category " .
    "FROM post " .
    "LEFT JOIN category ON post.category_id = category.id " .
    "WHERE post.status = 1 AND post.destination IN (0,2) " .
    "AND (post.publish_at IS NULL OR post.publish_at <= NOW()) " .
    "AND (post.expires_at IS NULL OR post.expires_at > NOW()) " .
    "ORDER BY COALESCE(post.publish_at, post.created_at) DESC, post.id DESC " .
    "LIMIT " . (POR_PAGINA + 1) . " OFFSET " . $offset . ";";
$tabla = mysqli_query($bonaire_atalaya_db, $query_tabla);

if ($tabla != false) {
    $arr_objetos = mysqli_fetch_all($tabla, MYSQLI_ASSOC);
    mysqli_free_result($tabla);

    // Se piden POR_PAGINA + 1 para saber si quedan mas sin hacer otra consulta
    $hay_mas = count($arr_objetos) > POR_PAGINA;
    $arr_objetos = array_slice($arr_objetos, 0, POR_PAGINA);

    $respuesta = ['resp' => 'OK', 'data' => $arr_objetos, 'has_more' => $hay_mas, 'next_offset' => $offset + count($arr_objetos)];
} else {
    $respuesta = ['resp' => 'ERROR SQL', 'data' => mysqli_error($bonaire_atalaya_db) . " GET VALUE "];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($respuesta);
