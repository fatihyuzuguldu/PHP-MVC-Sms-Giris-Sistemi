<?php

class Router
{
    public static function route($url)
    {
        // URL'yi parçalarına ayır
        $urlArray = explode('/', trim($url, '/'));

        // Kontrolör adı
        $controller = !empty($urlArray[0]) ? ucfirst($urlArray[0]) . 'Controller' : 'HomeController';
        array_shift($urlArray);

        // Metod adı
        $method = !empty($urlArray[0]) ? $urlArray[0] : 'index';
        array_shift($urlArray);

        // Parametreler
        $params = !empty($urlArray) ? $urlArray : [];

        // Kontrolör dosyasını dahil et ve sınıfı başlat
        $controllerFile = "App/Controllers/$controller.php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controller)) {
                $controllerInstance = new $controller;

                // Metodu çağır ve parametreleri geç
                if (method_exists($controllerInstance, $method)) {
                    call_user_func_array([$controllerInstance, $method], $params);
                } else {
                    echo "Method $method not found in controller $controller";
                }
            } else {
                echo "Controller class $controller not found";
            }
        } else {
            echo "Controller file $controllerFile not found";
        }
    }
}
