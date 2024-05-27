<?php

trait Controller
{
    public function View($controller, $name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        $filename = "App/Views/" . $controller . "/" . $name . ".php";
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "App/Views/404.php";
            require $filename;
        }
    }
}
