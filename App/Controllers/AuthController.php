<?php
require_once 'App/Models/AuthModels.php';
require_once 'App/Models/Functions.php';

class AuthController
{
    use Controller;
    public function __construct()
    {
        // URL'den alınan istek metni
        $request_url = $_SERVER['REQUEST_URI'];

        // Eğer Logout metodu çağrılmıyorsa AuthSessionsCheck fonksiyonunu çağır
        if (strpos($request_url, 'Logout') === false) {
            $functionsModel = new Functions();
            $functionsModel->AuthSessionsCheck();
        }
    }
    public function Login()
    {
        $data = ['error' => '', 'title' => 'Kayıt Ol'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Formdan gelen PhoneNumber'ı al
            $phoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : '';

            // Auth modeline gönder ve işlemi gerçekleştir
            $authModel = new AuthModels();
            $result = $authModel->LoginForm($phoneNumber);
            if ($result) {
                $this->View('Auth', 'TwoFactor', $data);
            } else {
                $data['error'] = "Telefon numarası bulunamadı. Lütfen geçerli bir numara girin.";
                echo $data['error'];
            }
        }
        $this->View('Auth', 'Login', $data);
    }


    public function Register()
    {
        $data = ['error' => '', 'title' => 'Kayıt Ol'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Formdan gelen PhoneNumber'ı al
            $phoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : '';
            $UserFullName = isset($_POST['UserFullName']) ? $_POST['UserFullName'] : '';

            // Auth modeline gönder ve işlemi gerçekleştir
            $authModel = new AuthModels();
            $result = $authModel->RegisterForm($phoneNumber,$UserFullName);
            if ($result) {
                $this->view('Auth', 'Login', $data);
                return;
            }
        }
        $this->view('Auth', 'Register', $data);
    }

    public function TwoFactor()
    {
        $data = ['error' => '', 'title' => 'Kayıt Ol'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Formdan gelen PhoneNumber'ı al
            $code1 = isset($_POST['code1']) ? $_POST['code1'] : '';
            $code2 = isset($_POST['code2']) ? $_POST['code2'] : '';
            $code3 = isset($_POST['code3']) ? $_POST['code3'] : '';
            $code4 = isset($_POST['code4']) ? $_POST['code4'] : '';
            $code5 = isset($_POST['code5']) ? $_POST['code5'] : '';
            $code6 = isset($_POST['code6']) ? $_POST['code6'] : '';
            $twofactorcode = $code1 . $code2 . $code3 . $code4 . $code5 . $code6;

            // Auth modeline gönder ve işlemi gerçekleştir
            $authModel = new AuthModels();
            $result = $authModel->TwoFactorForm($twofactorcode);
            if ($result) {
                $this->View('Auth', 'TwoFactor',$data);
            } else {
                $data['error'] = "Kod Hatalı.";
                echo $data['error'];
            }
        }
        $this->View('Auth', 'TwoFactor',$data);
    }

}

