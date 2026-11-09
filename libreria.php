<?php

// Clase acceso
class datos_usuario
{
    public $idioma;
}


//inicio la sesión
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['datos_usuario'])) {
    $_SESSION['datos_usuario'] = new datos_usuario;
    $_SESSION['datos_usuario']->idioma = 'en';
}


$arrLenguajes = [
    'es' => ['idioma' => "es", 'desc' => 'Castellano'],
    'en' => ['idioma' => "en", 'desc' => 'English'],
    'de' => ['idioma' => "de", 'desc' => 'German']
];

$arrLenguajesCortos = [
    'es' => ['idioma' => "es", 'desc' => 'Esp'],
    'en' => ['idioma' => "en", 'desc' => 'Eng'],
    'de' => ['idioma' => "de", 'desc' => 'Ger']
];


/**
 * @param $array
 * @param $partes
 * @param $pos
 * @return mixed|null
 */
function buscaKeyTrans($array, $partes, &$pos)
{
    $resp = null;
    if (array_key_exists($partes[$pos], $array)) {
        $resp = $array[$partes[$pos]];
        if ((is_array($resp)) && ($pos < (count($partes) - 1))) {
            $pos++;
            $resp = buscaKeyTrans($resp, $partes, $pos);
        }
    }
    return $resp;
}

/**
 * @param $key
 * @return mixed|null
 */
function trans($key)
{
    $resp = $key;
    if (isset($_SESSION['traducciones'])) {
        $array = $_SESSION['traducciones']['lang'];
        if (strpos($key, ".") !== false) {
            $partes = explode(".", $key);
            $pos = 0;
            $resp = buscaKeyTrans($array, $partes, $pos);
        } else {
            $resp = $array[$key];
        }

        if ($resp == '') {
            $resp = $key;
        }
    }

    return $resp;
}


function addTranslationsToArray($idioma)
{
    return require_once('lang/' . $_SESSION['datos_usuario']->idioma . '.php');
}

/**
 * @return array
 */
function cogeListaIdiomas($idioma_usuario)
{
    global $arrLenguajes;

    $lista_idiomas_user = '';
    $lista_idiomas = '<select class="selectpicker opcion_idioma">';
    $bandera_user = '';

    //$ruta = Route::getFacadeRoot()->current()->uri();
    foreach ($arrLenguajes AS $ind => $lenguaje) {
        /* LENGUAJE CASTELLANO */
        $vars = explode("|", $lenguaje['idioma']);
        $claseAdd = '';
        if ($lenguaje['idioma'] == 'es|es_ES') {
            $claseAdd .= ' active';
        }
        $lista_idiomas .= '<option data-icon="flag flag-' . $vars[0] . '" rel-lang="' . $vars[0] . '" value="' . $vars[0] . '"> ';
        $lista_idiomas .= $lenguaje['desc'];
        $lista_idiomas .= '</option>' . PHP_EOL;

        /* LENGUAJE CASTELLANO MENU USUARIO */
        $vars = explode("|", $lenguaje['idioma']);
        $lista_idiomas_user .= '<li ';
        $bandera_idioma = '<img src="img/blank.gif" class="flag flag-' . $vars[0] . ' " data-lang="' . $vars[0] . '" alt="' . $lenguaje['desc'] . '" title="' . $lenguaje['desc'] . '">';
        if ($idioma_usuario === $lenguaje['idioma']) {
            $lista_idiomas_user .= 'class="active"';
            $bandera_user = $bandera_idioma;
        }

        $ruta = 'index_back.php?lang=' . $vars[0];
        //if (isset($_SERVER['QUERY_STRING'])) $ruta .= ($_SERVER['QUERY_STRING'] ? ('&' . $_SERVER['QUERY_STRING']) : '');

        $lista_idiomas_user .= '><a href="' . $ruta . '">' . $bandera_idioma . ' ' . $lenguaje['desc'] . ' </a></li>';
    }


    if ($bandera_user == '') {
        $bandera_user = "[" . $idioma_usuario . "]";
    }

    $lista_idiomas .= '</select>';

    return [
        'bandera_user' => $bandera_user,
        'lista_idiomas_user' => $lista_idiomas_user,
        'lista_idiomas' => $lista_idiomas
    ];

}

/**
 * @param $idioma_usuario
 */
function carga_idiomas($idioma_usuario)
{
    $temp = cogeListaIdiomas($idioma_usuario);
    $_SESSION['traducciones'] = [];
    $_SESSION['traducciones']['bandera_user'] = $temp['bandera_user'];
    $_SESSION['traducciones']['lista_idiomas_user'] = $temp['lista_idiomas_user'];
    $_SESSION['traducciones']['lang'] = addTranslationsToArray($idioma_usuario);
}

/**
 * @param $array
 * @param $name_field
 * @return mixed
 */
function trans_field($array, $name_field)
{
    $temp = explode("|", $_SESSION['datos_usuario']->idioma);
    $lang = $temp[0];
    if (is_array($array)) {
        if (count($array) > 0) {
            if ((isset($array[$name_field . '_' . $lang])) && ($array[$name_field . '_' . $lang] != '')) {
                return $array[$name_field . '_' . $lang];
            } elseif ((isset($array[$name_field . '_es'])) && ($array[$name_field . '_es'] != '')) {
                return $array[$name_field . '_es'];
            } elseif ((isset($array[$name_field])) && ($array[$name_field] != '')) {
                return $array[$name_field];
            }
        }
    }
    return null;
}

/**
 * @param $field
 * @param $campo
 * @param bool $modo_array
 * @return bool
 */
function comprueba_campo_vacio($field, $campo, $modo_array = false)
{
    global $arrLenguajesCortos;

    $devuelto = false;
    foreach ($arrLenguajesCortos as $lang => $valor) {
        $campo_lang = $campo;
        if ($lang != 'es') {
            $campo_lang = $campo . '_' . $lang;
        }
        if ($modo_array == true) {
            if (isset($field[$campo_lang])) {
                if ($field[$campo_lang] != '') {
                    $devuelto = true;
                }
            }
        } else {
            if (isset($field->$campo_lang)) {
                if ($field->$campo_lang != '') {
                    $devuelto = true;
                }
            }
        }
    }

    return $devuelto;
}


function pon_seleccionado($opcion, $texto, $comando = 'active')
{
    $resultado = "";
    if (is_array($texto)) {
        foreach ($texto as $valor) {
            if (strpos($opcion, $valor) !== false) {
                $resultado = $comando;
            }
        }
    } else {
        if (strpos($opcion, $texto) !== false) {
            $resultado = $comando;
        }
    }

    return $resultado;
}

function pon_campo_idioma ($array, $campo) {
    $lang = $_SESSION['datos_usuario']->idioma;
    $field = $campo;
    if ($lang == 'es') {
        $campo .= '_es';
    } elseif ($lang == 'de') {
        $campo .= '_de';
    }
    return ($array[$campo] !== null) ? $array[$campo] : $array[$field];
}