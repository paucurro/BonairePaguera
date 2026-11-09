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
            <li style="background-image: url(pictures/contact.jpg);" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="probootstrap-slider-text text-center">
                                <p><img src="img/curve_white.svg" class="seperator probootstrap-animate" alt=""></p>
                                <h1 class="probootstrap-heading probootstrap-animate"><?php echo trans('txt_contact.001'); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </section>

    <section class="probootstrap-section">
        <div class="container">
            <div class="row probootstrap-gutter60">
                <div class="col-md-8">
                    <h2 class="mt0"><?php echo trans('txt_contact.010'); ?></h2>
                    <form action="#" method="post" class="probootstrap-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname"><?php echo trans('txt_contact.002'); ?></label>
                                    <input type="text" class="form-control" id="fname" name="fname">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname"><?php echo trans('txt_contact.003'); ?></label>
                                    <input type="text" class="form-control" id="lname" name="lname">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo trans('txt_contact.004'); ?></label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="subject"><?php echo trans('txt_contact.005'); ?></label>
                            <input type="text" class="form-control" id="subject" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="message"><?php echo trans('txt_contact.006'); ?></label>
                            <textarea cols="30" rows="10" class="form-control" id="message" name="message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg" id="submit" name="submit" value="<?php echo trans('txt_contact.007'); ?>">
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <h2 class="mt0"><?php echo trans('txt_contact.011'); ?></h2>
                    <ul class="probootstrap-contact-info">
                        <li><i class="icon-location2"></i> <span>C/ Atalaya n.3<br>07160 - Paguera - Mallorca</span></li>
                        <li><i class="icon-mail"></i><span>recepcion@bonairepaguera.com</span></li>
                        <li>
                            <a href="tel:+34971687372" aria-label="Llamar al 971 687 372 ">
                                <i class="icon-phone2"></i> <span>+34 971 687 372</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:+34670362947" aria-label="Llamar al 670 362 947">
                                <i class="icon-phone2"></i> <span>+34 670 362 947</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/34670362947" target="_blank" rel="noopener" aria-label="Contactar por WhatsApp">
                                <i class="icon-whatsapp"></i> <span>+34 670 362 947</span>
                            </a>
                        </li>
                    </ul>
                    <h2><?php echo trans('txt_contact.008'); ?></h2>
                    <p><?php echo trans('txt_contact.009'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <hr style="height: 2px; background-color: #CCCCCC;">

    <?php require_once 'ls_footer.php'; ?>

</body>

</html>