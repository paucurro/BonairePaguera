<?php require_once '_config.php'; ?>
<?php require_once 'Connections/bonaire_atalaya_db.php'; ?>
<?php

mysqli_select_db($bonaire_atalaya_db, $database_bonaire_atalaya_db);
$query_tabla = "SELECT post.*, DATE_FORMAT(created_at, '%d/%m/%Y') AS fecha, category.name AS category ".
    "FROM post " .
    "LEFT JOIN category ON post.category_id = category.id " .
    "WHERE post.status = 1 AND destination IN (0,2) " .
    "ORDER BY created_at DESC;";
$tabla = mysqli_query($bonaire_atalaya_db, $query_tabla);

if ($tabla != false) {
    $arr_objetos = mysqli_fetch_all($tabla, MYSQLI_ASSOC);
    mysqli_free_result($tabla);

    $respuesta = ['resp' => 'OK', 'data' => $arr_objetos];
} else {
    $respuesta = ['resp' => 'ERROR SQL', 'data' => mysqli_error($bonaire_atalaya_db) . " GET VALUE "];
}

echo json_encode($respuesta);

