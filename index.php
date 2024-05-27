<?php
ob_start();
session_start();

define('BASEPATH', __DIR__);

// Gerekli dosyaları dahil et
require_once 'App/Router.php';
require_once 'App/Core/Controller.php';

// URL'yi al
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Router'ı kullanarak yönlendir
Router::route($url);
