<?php require_once '_config.php'; ?>
<?php require_once 'libreria.php'; ?>
<?php require_once 'Connections/bonaire_atalaya_db.php'; ?>
<?php

if (isset($_REQUEST['lang']) && ($_REQUEST['lang'] != '')) {
    if (array_search($_REQUEST['lang'], array_column($arrLenguajes, 'idioma')) !== false) {
        $_SESSION['datos_usuario']->idioma = $_REQUEST['lang'];
    }
}

carga_idiomas($_SESSION['datos_usuario']->idioma);

$salir = true;
if (isset($_REQUEST['id'])) {

    $id = (int)($_GET["id"] ?? 0);

    mysqli_select_db($bonaire_atalaya_db, $database_bonaire_atalaya_db);
    $query_tabla = "SELECT *, DATE_FORMAT(created_at, '%d/%m/%Y') AS fecha, category.name AS category FROM post " .
        "LEFT JOIN category ON post.category_id = category.id WHERE post.id = " . $id . " AND post.status = 1 " .
        "AND (post.publish_at IS NULL OR post.publish_at <= NOW()) AND (post.expires_at IS NULL OR post.expires_at > NOW()) LIMIT 1;";
    $tabla = mysqli_query($bonaire_atalaya_db, $query_tabla);

    if ($tabla != false) {
        $row_blog = mysqli_fetch_array($tabla, MYSQLI_ASSOC);
        mysqli_free_result($tabla);
        $salir = ($row_blog === null);
    }
}

if ($salir == true) {
    header('location: blog.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['datos_usuario']->idioma; ?>">
<head>
    <?php require_once 'ls_head.php'; ?>
</head>

<body>

<?php require_once 'ls_menu.php'; ?>


<section class="probootstrap-section">
    <div class="container">
        <div class="row" id="">
            <div class="col-md-12">
                <h3><?php echo pon_campo_idioma($row_blog, 'title'); ?></h3>
                <?php
                $image = "uploads/". $row_blog['image'] ."";
                if (($row_blog['image'] != "") && (file_exists($image))) : ?>
                    <img src="<?php echo $image; ?>" class="img-responsive">
                <?php endif; ?>
                <br>
                <div class="">
                    <div class="panel-body">
                        <h4><?php echo pon_campo_idioma($row_blog, 'brief'); ?></h4>
                        <p class="text-center"><img src="img/curve.svg" class="seperator probootstrap-animate" alt=""></p>
                        <div class="blog-content"><?php echo pon_campo_idioma($row_blog, 'content'); ?></div>
                        <p class="text-center"><img src="img/curve.svg" class="seperator probootstrap-animate" alt=""></p>
                        <small><?php echo $row_blog['fecha']; ?></small>
                        <small><?php echo $row_blog['category']; ?></small>
                    </div>
                </div>
                <div>
                    <a href="blog.php" class="links"><-- <?php echo trans('txt_blog.003'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<hr>

<?php require_once 'ls_footer.php'; ?>

</body>
</html>