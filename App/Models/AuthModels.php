<?php
require_once "App/Core/Database.php";
require_once "App/Models/Functions.php";

class AuthModels {
    use Database;

    private $table = 'users';

    public function LoginForm($phoneNumber)
    {
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
        $query = "SELECT * FROM {$this->table} WHERE UserPhone = :UserPhone";
        $result = $this->get_row($query, ['UserPhone' => $phoneNumber]);
        echo $phoneNumber;
        if ($result) {
            // Telefon numarası doğrulandı, SMS gönderme işlemini başlat
            $functionsmodel = new Functions();
            $smsSent = $functionsmodel->LoginSmsSend($phoneNumber);

            if ($smsSent) {
                // SMS başarıyla gönderildi, oturum bilgilerini ayarla
                $_SESSION['id'] = $result->id;
                $_SESSION['UserFullName'] = $result->UserFullName;
                $_SESSION['UserPhone'] = $phoneNumber;
                $_SESSION['TwoFactor'] = true;
                header("Location: " . ROOT . "/Auth/TwoFactor");
                exit;
            } else {
                // SMS gönderme başarısız oldu
                echo "SMS gönderme işlemi başarısız.";
            }

        } else {
            // Geçersiz telefon numarası
            return false;
        }
    }
    public function RegisterForm($phoneNumber,$UserFullName)
    {
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
        $query = "SELECT * FROM {$this->table} WHERE UserPhone = :UserPhone";
        $result = $this->get_row($query, ['UserPhone' => $phoneNumber]);

        if ($result) {
            echo "Bu Telefon Numarası zaten sistemde kayıtlı!";

        } else {
            $query = "INSERT INTO users (UserPhone, UserFullName,UserRole) VALUES (?, ?, ?)";
            $data = [$phoneNumber, $UserFullName,'1'];
            $this->prepare($query, $data);
            header("Location: " . ROOT . "/Auth/Login");
            exit();
        }
    }

    public function TwoFactorForm($twofactorcode)
    {
        if ($_SESSION["TwoFactorCode"] == $twofactorcode) {
            $_SESSION['TwoFactor'] = false;
            header("Location: " . ROOT . "/Dashboard/Index");
            exit;
        }
        else {
            // Geçersiz telefon numarası
            return false;
        }
    }
}
