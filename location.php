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
        <li style="background-image: url(pictures/aeropuerto.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_location.002'); ?></h1>
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/private_transfer.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_location.012'); ?></h1>
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/taxi_imagen.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_location.013'); ?></h1>
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/bus_tib.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_location.014'); ?></h1>
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/catedral3.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_location.003'); ?></h1>
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/castell_de_bellver.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_location.009'); ?></h1>
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="probootstrap-section">
    <div class="container">
        <div class="row mb30">
            <div class="col-md-12">
                <figure>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d98431.22148682954!2d2.575383416660093!3d39.56015612179709!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x1297942ff5db35f3%3A0x7031da6569b7f956!2sAeropuerto+de+Palma+de+Mallorca%2C+Palma+de+Mallorca!3m2!1d39.551740699999996!2d2.7361649!4m5!1s0x129827494e11c861%3A0x1bf9c07fd9f78670!2sApartment+Bon-Aire%2C+Carrer+de+la+Talaia%2C+3%2C+07160+Peguera%2C+Illes+Balears%2C+Espa%C3%B1a!3m2!1d39.537825!2d2.44551!5e0!3m2!1ses!2ses!4v1441923728774" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </figure>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><?php echo trans('txt_location.001'); ?></div>
        </div>
    </div>
</section>

<section class="probootstrap-section probootstrap-section-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mt0"><?php echo trans('txt_location.005'); ?></h2>
                <p class="mb50"><img src="img/curve.svg" class="svg" alt=""></p>
            </div>
            <div class="col-md-4">
                <div class="service left-icon left-icon-sm probootstrap-animate">
                    <div class="text-center"><img src="pictures/svg/taxi.png" class=""/></div> <!-- Taxi or private -->
                    <div class="text-center"><h3 class="no-padding"><?php echo trans('txt_location.008'); ?></h3></div>
                    <div class="text-center"><a href="contact.php"><?php echo trans('txt_contact.001'); ?></a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service left-icon left-icon-sm probootstrap-animate">
                    <div class="text-center"><img src="pictures/svg/bus.png" class=""/></div> <!-- Public Bus -->
                    <div class="text-center"><h3><?php echo trans('txt_location.007'); ?></h3></div>
                    <div class="text-center"><a href="https://www.tib.org/es/web/ctm/autobus/linia/A11">https://www.tib.org</a></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service left-icon left-icon-sm probootstrap-animate">
                    <div class="text-center"><img src="pictures/svg/rentacar.png" class="" /></div> <!-- rent a car -->
                    <div class="text-center"><h3><?php echo trans('txt_location.006'); ?></h3></div>
                    <div class="text-center"><a href="contact.php"><?php echo trans('txt_contact.001'); ?></a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'ls_footer.php'; ?>

</body>
</html>