<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bonaire_atalaya_db = "localhost";
$database_bonaire_atalaya_db = "bonaire_atalaya_db";
$username_bonaire_atalaya_db = "User_Bonaire_Db";
$password_bonaire_atalaya_db = "HgFGE^wZ7qwh";
mysqli_report(MYSQLI_REPORT_OFF); // PHP 8.1+ lanza excepciones por defecto
$bonaire_atalaya_db = mysqli_connect($hostname_bonaire_atalaya_db, $username_bonaire_atalaya_db, $password_bonaire_atalaya_db) or trigger_error(mysqli_connect_error(),E_USER_ERROR);

mysqli_set_charset($bonaire_atalaya_db, "utf8");
date_default_timezone_set('Europe/Madrid');

