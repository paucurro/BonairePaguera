<!-- START: header -->
<header role="banner" class="probootstrap-header">
    <!-- <div class="container"> -->
    <div class="row">
        <!-- width="120" height="33" -->
        <a href="index.php" class="probootstrap-logo visible-xs"><img src="pictures/logo/logo_2.png" class="hires" alt=""></a>

        <a href="#" class="probootstrap-burger-menu visible-xs"><i>Menu</i></a>
        <div class="mobile-menu-overlay"></div>

        <nav role="navigation" class="probootstrap-nav hidden-xs">
            <ul class="probootstrap-main-nav">
                <li class="<?php echo pon_seleccionado($_SERVER['PHP_SELF'], ["index"], 'active'); ?>"><a href="index.php"><?php echo trans('txt_menu.home'); ?></a></li>
                <li class="<?php echo pon_seleccionado($_SERVER['PHP_SELF'], ["pictures"], 'active'); ?>"><a href="pictures.php"><?php echo trans('txt_menu.pictures'); ?></a></li>
                <li class="<?php echo pon_seleccionado($_SERVER['PHP_SELF'], ["location"], 'active'); ?>"><a href="location.php"><?php echo trans('txt_menu.location'); ?></a></li>
                <!-- width="181" height="50" -->
                <li class="hidden-xs probootstrap-logo-center"><a href="index.php"><img src="pictures/logo/logo_2.png" class="hires" alt=""></a></li>
                <li class="<?php echo pon_seleccionado($_SERVER['PHP_SELF'], ["rooms"], 'active'); ?>"><a href="rooms.php"><?php echo trans('txt_menu.rooms'); ?></a></li>
                <li class="<?php echo pon_seleccionado($_SERVER['PHP_SELF'], ["blog"], 'active'); ?>"><a href="blog.php"><?php echo trans('txt_menu.blog'); ?></a></li>
                <li class="<?php echo pon_seleccionado($_SERVER['PHP_SELF'], ["contact"], 'active'); ?>"><a href="contact.php"><?php echo trans('txt_menu.contact'); ?></a></li>
                <li><a class="ibe btn btn-primary" href="#" target="_blank" data-region="emea" data-channelcode="bonaireapartmentsdirect" style="padding: 2px 6px;"><?php echo trans('txt_menu.book_room') ?></a></li>
                <li>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?lang=en" class="flag-icon flag flag-icon-background flag-icon-gb"></a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?lang=es" class="flag-icon flag flag-icon-background flag-icon-es"></a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?lang=de" class="flag-icon flag flag-icon-background flag-icon-de"></a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- </div> -->
</header>
<!-- END: header -->

