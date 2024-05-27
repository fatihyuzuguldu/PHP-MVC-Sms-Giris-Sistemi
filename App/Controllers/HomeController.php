<?php

class HomeController
{
    use Controller;

    public function Index()
    {
        $this->View('Home', 'index');
    }
}
