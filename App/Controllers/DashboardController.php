<?php


require_once 'App/Models/Functions.php';
class DashboardController
{
    use Controller;
    public function __construct()
    {
        $functionsModel = new Functions();
        $functionsModel->AuthSessionsCheck();
    }

    public function Index()
    {
        $this->View('Dashboard', 'Index');
    }
}
