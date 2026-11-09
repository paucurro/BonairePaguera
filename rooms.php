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
        <li style="background-image: url(pictures/salon1.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_portada.044'); ?></h1>
                            <div class="probootstrap-animate probootstrap-sub-wrap" style="color: #FFF;"><?php echo trans('txt_location.010'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/dormitorio2.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_portada.054'); ?></h1>
                            <div class="probootstrap-animate probootstrap-sub-wrap" style="color: #FFF;"><?php echo trans('txt_location.010'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/cocina4.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_portada.033'); ?></h1>
                            <div class="probootstrap-animate probootstrap-sub-wrap" style="color: #FFF;"><?php echo trans('txt_portada.057'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li style="background-image: url(pictures/terraza1.jpg);" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="probootstrap-slider-text text-center">
                            <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                            <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_portada.056'); ?></h1>
                            <div class="probootstrap-animate probootstrap-sub-wrap" style="color: #FFF;"><?php echo trans('txt_portada.058'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="probootstrap-cta probootstrap-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- <div id="sb-container" style="position: relative; z-index: 3000;"></div> -->
                <div class="ibe" data-region="emea" data-query-locale="<?php echo ($_SESSION['datos_usuario']->idioma); ?>"  data-channelcode="bonaireapartmentsdirect" data-widget="property_grid"></div>
            </div>
        </div>
    </div>
</section>

<section class="probootstrap-section">
    <div class="container">
        <div class="row mb30">
            <div class="col-md-8 col-md-offset-2 probootstrap-section-heading text-center">
                <h2><?php trans('txt_portada.016'); ?></h2>
                <p class="lead"><?php trans('txt_portada.017'); ?></p>
                <p><img src="img/curve.svg" class="svg" alt=""></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="service left-icon probootstrap-animate">
                    <div class="icon">
                        <img src="img/flaticon/svg/005-bed.svg" class="svg" alt="All rooms with bed">
                    </div>
                    <div class="text">
                        <h3><?php echo trans('txt_portada.044'); ?></h3>
                        <p><?php echo trans('txt_portada.045'); ?></p>
                        <!-- <p><a href="#" class="link-with-icon">< ?php echo trans('genericos.learn'); ?> <i class=" icon-chevron-right"></i></a></p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service left-icon probootstrap-animate">
                    <div class="icon">
                        <img src="img/flaticon/svg/003-restaurant.svg" class="svg" alt="All offer restaurant nearby">
                    </div>
                    <div class="text">
                        <h3><?php echo trans('txt_portada.018'); ?></h3>
                        <p><?php echo trans('txt_portada.018A'); ?></p>
                        <!-- <p><a href="#" class="link-with-icon">< ?php echo trans('genericos.learn'); ?> <i class=" icon-chevron-right"></i></a></p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service left-icon probootstrap-animate">
                    <div class="icon">
                        <img src="img/flaticon/svg/006-beach.svg" class="svg" alt="Beach near apartment">
                    </div>
                    <div class="text">
                        <h3><?php echo trans('txt_portada.047'); ?></h3>
                        <p><?php echo trans('txt_portada.048'); ?></p>
                        <!-- <p><a href="#" class="link-with-icon">< ?php echo trans('genericos.learn'); ?> <i class=" icon-chevron-right"></i></a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="probootstrap-section probootstrap-section-dark">
    <div class="container">
        <div class="row mb30">
            <div class="col-md-8 col-md-offset-2 probootstrap-section-heading text-center">
                <h2><?php echo trans('txt_portada.046'); ?></h2>
                <p class="lead"><?php echo trans('txt_portada.046A'); ?></p>
                <p><img src="img/curve.svg" class="svg" alt=""></p>
            </div>
        </div>
        <div class="row probootstrap-gutter10">
            <div class="col-md-4">
                <div class="probootstrap-block-image-text">
                    <figure>
                        <a href="pictures/dormitorio1.jpg" class="image-popup">
                            <img src="pictures/dormitorio1.jpg" alt="" class="img-responsive">
                        </a>
                    </figure>
                    <div class="text">
                        <h3><a href="#"><?php echo trans('txt_portada.023'); ?></a></h3>
                        <p><?php echo trans('txt_portada.024'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="probootstrap-block-image-text">
                    <figure>
                        <a href="pictures/cocina4.jpg" class="image-popup">
                            <img src="pictures/cocina4.jpg" alt="" class="img-responsive">
                        </a>
                    </figure>
                    <div class="text">
                        <h3><a href="#"><?php echo trans('txt_portada.025'); ?></a></h3>
                        <p><?php echo trans('txt_portada.026'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="probootstrap-block-image-text">
                    <figure>
                        <a href="pictures/cocina2.jpg" class="image-popup">
                            <img src="pictures/cocina2.jpg" alt="" class="img-responsive">
                        </a>
                    </figure>
                    <div class="text">
                        <h3><a href="#"><?php echo trans('txt_portada.027'); ?></a></h3>
                        <p><?php echo trans('txt_portada.028'); ?></p>
                    </div>
                </div>
            </div>
            <div class="row probootstrap-gutter10">
                <?php echo trans('txt_portada.051') ?>
            </div>
        </div>
    </div>
</section>

<section class="probootstrap-half">
    <div class="text">
        <div class="probootstrap-animate fadeInUp probootstrap-animated">
            <h2 class="mt0"><?php echo trans('txt_location.011'); ?></h2>
            <p><img src="img/curve_white.svg" class="seperator" alt=""></p>
            <div class="row">
                <div class="col-md-6">
                    <p><?php echo trans('txt_portada.030'); ?></p>
                </div>
                <div class="col-md-6">
                    <p><?php echo trans('txt_portada.031'); ?></p>
                </div>
            </div>
            <!-- <p><a href="#" class="link-with-icon white">< ?php echo trans('genericos.learn'); ?> <i class=" icon-chevron-right"></i></a></p> -->
        </div>
    </div>
    <div class="image" style="background-image: url(pictures/salon3.jpg);"></div>
</section>

<?php require_once 'ls_footer.php'; ?>

<script src="https://widget.siteminder.com/ibe.min.js"></script>

<script type="text/javascript">
    /*(function (i, s, o, g, r, a, m) {
        i['SBSyncroBoxParam'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://cdn.simplebooking.it/search-box-script.axd?IDA=5720', 'SBSyncroBox');

    SBSyncroBox({
        CodLang: '<?php echo strtoupper($_SESSION['datos_usuario']->idioma); ?>',
        Styles: {
            Theme: "light-pink",
            CustomColor: "#333333",   //primary color ex. #CDEFDD
            CustomBGColor: "#f5f5f5",   //background color
            CustomLabelColor: "#999999",   //labels color
            CustomWidgetColor: "#333333",   //popovers text color,
            CustomButtonBGColor: "#903479",
        },

    }); */
</script>


</body>
</html>