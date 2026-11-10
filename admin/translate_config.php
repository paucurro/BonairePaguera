<?php
/**
 * Configuracion del traductor automatico del admin.
 *
 * 1. Crea una cuenta en https://www.deepl.com/pro-api y elige el plan "API Free"
 *    (500.000 caracteres/mes gratis).
 * 2. Copia la "Authentication Key" y pegala abajo.
 *    Las claves del plan Free terminan en ":fx" y el script usa solo
 *    api-free.deepl.com; el resto usa api.deepl.com (plan Pro, de pago).
 *
 * Mientras 'deepl_key' este vacia, el formulario usa el traductor gratuito
 * (no oficial) de Google desde el navegador.
 *
 * IMPORTANTE: no subas este archivo a un repositorio publico.
 */
return [
    'deepl_key' => 'b97911b2-b87a-4352-8615-0504355fc284:fx',
    // Opcional. Si se deja vacio se elige solo: claves ":fx" -> api-free.deepl.com, el resto -> api.deepl.com.
    // Si DeepL responde "clave no valida" con una clave correcta, prueba con el otro servidor.
    'deepl_host' => '',
];
