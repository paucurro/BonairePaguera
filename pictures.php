<?php require_once '_config.php'; ?>
<?php require_once 'libreria.php'; ?>
<?php

if (isset($_REQUEST['lang']) && ($_REQUEST['lang'] != '')) {
    if (array_search($_REQUEST['lang'], array_column($arrLenguajes, 'idioma')) !== false) {
        $_SESSION['datos_usuario']->idioma = $_REQUEST['lang'];
    }
}

carga_idiomas($_SESSION['datos_usuario']->idioma);

$array_fotos = [
    'portada1.jpg',
    'serra_tramuntana.jpg',
    'exterior1.jpg',
    'cocina2.jpg',
    'salon3.jpg',
    'paguera_2.jpg',
    'cocina4.jpg',
    'dormitorio5.jpg',
    'puigmajor5.jpg',
    'paguera_3.jpg',
    'dormitorio7.jpg',
    'paguera_4.jpg',
    'pasillo.jpg',
    'portada7.jpg',
    'portada8.jpg',
    // 'piscina2.jpg',
    'cala_moro_santanyi.jpg',
    'salon1.jpg',
    'terraza1.jpg'
];

?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['datos_usuario']->idioma; ?>">
<head>
    <?php require_once 'ls_head.php'; ?>

    <link rel="stylesheet" href="css/vendor/magnific-popup.css">

</head>

<body>

<?php require_once 'ls_menu.php'; ?>

<section class="probootstrap-section">
    <div class="container">

        <!--Carousel Wrapper-->
        <div id="carousel-with-lb" class="carousel slide carousel-multi-item" data-ride="carousel">

            <!--Slides and lightbox-->

            <div class="carousel-inner mdb-lightbox" role="listbox">
                <div id="mdb-lightbox-ui"></div>
                <!--First slide-->
                <div class=" carousel-item active text-center">

                    <?php
                    $contador = 0;
                    foreach ($array_fotos as $foto) {
                        echo '<figure class="col-md-6 d-md-inline-block">';
                        echo '    <a class="img_zoom" href="pictures/' . $foto . '" data-size="800x450">';
                        echo '        <img src="pictures/' . $foto . '" class="img-responsive">';
                        echo '    </a>';
                        echo '</figure>';

                        $contador ++;
                        if ($contador >= 2) {
                            $contador = 0;
                            echo '</div>';
                            echo '<div class="carousel-item text-center">';
                        }
                    }

                    ?>

                </div>
                <!--/.First slide-->

        </div>
        <!--/.Carousel Wrapper-->

    </div>
</section>

<?php require_once 'ls_footer.php'; ?>

</body>
</html>