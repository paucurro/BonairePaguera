<?php require_once '_config.php'; ?>
<?php require_once 'libreria.php'; ?>
<?php

if (isset($_REQUEST['lang']) && ($_REQUEST['lang'] != '')) {
    if (array_search($_REQUEST['lang'], array_column($arrLenguajes, 'idioma')) !== false) {
        $_SESSION['datos_usuario']->idioma = $_REQUEST['lang'];
    }
}

carga_idiomas($_SESSION['datos_usuario']->idioma);

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['datos_usuario']->idioma; ?>">
<head>
    <?php require_once 'ls_head.php'; ?>
</head>

<body>

<?php require_once 'ls_menu.php'; ?>


<section class="probootstrap-slider flexslider probootstrap-inner">
    <ul class="slides">
        <li style="background-image: url(pictures/nyt-trump-taxes.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_blog.001'); ?></h1>
                            <div class="probootstrap-animate probootstrap-sub-wrap"><?php echo trans('txt_blog.002'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="probootstrap-section">
    <div class="container">
        <div class="row" id="zona_blog"><i class="fa fa-spin fa-spinner"></i></div>
        <div class="text-center" id="zona_blog_mas" style="display:none; margin-top: 20px;">
            <button type="button" id="btn_blog_mas" class="btn btn-primary btn-lg"><?php echo trans('txt_blog.004'); ?></button>
        </div>
    </div>
</section>

<hr style="height: 2px; background-color: #CCCCCC;">

<?php require_once 'ls_footer.php'; ?>

</body>
</html>