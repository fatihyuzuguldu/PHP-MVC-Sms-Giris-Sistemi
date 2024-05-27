<?php
session_start();

// Tüm oturum değişkenlerini sıfırla veya sil
$_SESSION = array();
session_unset();
session_destroy();

header("location: Auth/Login");