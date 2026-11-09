<!-- START: footer -->
<footer role="contentinfo" class="probootstrap-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="probootstrap-footer-widget">
                    <p class="mt40"><img src="pictures/logo/logo.png" class="hires" alt=""></p>
                    <p><?php echo trans('txt_portada.032'); ?></p>
                </div>
            </div>
            <?php /*             <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                    <h3>Blog</h3>
                    <ul class="probootstrap-blog-list">
                        <li>
                            <!-- <a href="#">
                                <figure class="probootstrap-image"><img src="img/img_1.jpg" alt="" class="img-responsive"></figure>
                                <div class="probootstrap-text">
                                    <h4>River named Duden flows</h4>
                                    <span class="meta">August 2, 2017</span>
                                    <p>A small river named Duden flows by their place</p>
                                </div>
                            </a> -->
                        </li>
                        <li>
                            <!-- <a href="#">
                                <figure class="probootstrap-image"><img src="img/img_2.jpg" alt="" class="img-responsive"></figure>
                                <div class="probootstrap-text">
                                    <h4>River named Duden flows</h4>
                                    <span class="meta">August 2, 2017</span>
                                    <p>A small river named Duden flows by their place</p>
                                </div>
                            </a> -->
                        </li>
                        <li>
                            <!-- <a href="#">
                                <figure class="probootstrap-image"><img src="img/img_3.jpg" alt="" class="img-responsive"></figure>
                                <div class="probootstrap-text">
                                    <h4>River named Duden flows</h4>
                                    <span class="meta">August 2, 2017</span>
                                    <p>A small river named Duden flows by their place</p>
                                </div>
                            </a> -->
                        </li>
                    </ul>
                </div>
            </div> */ ?>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="probootstrap-footer-widget">
                    <h3>Contact</h3>
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

                </div>
            </div>
        </div>
        <div class="row mt40">
            <div class="col-md-12 text-center">
                <ul class="probootstrap-footer-social">
                    <li><a href=""><i class="icon-twitter"></i></a></li>
                    <li><a href=""><i class="icon-facebook"></i></a></li>
                    <li><a href=""><i class="icon-instagram2"></i></a></li>
                </ul>
                <p>
                    <small>&copy; <?php echo date("Y"); ?> Apartamentos Bonaire Paguera. All Rights Reserved. <br> Designed &amp; Developed by <a href="https://4folios.com/" target="_blank">4folios.com</a></small>
                </p>

            </div>
        </div>
    </div>
</footer>
<!-- END: footer -->

<script>
    var lang = '<?php echo $_SESSION['datos_usuario']->idioma; ?>';
</script>

<script src="js/vendor/jquery.min.js"></script>
<script src="js/scripts.min.js"></script>
<script src="js/main.min.js"></script>
<script src="js/vendor/jquery.magnific-popup.min.js"></script>
<script src="js/custom.js"></script>