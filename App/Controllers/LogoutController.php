<?php
class LogoutController
{
    use Controller;

    public function Index()
    {
        $_SESSION = array();
        session_unset();
        session_destroy();
        $this->View('Logout', 'Index');
    }
}
