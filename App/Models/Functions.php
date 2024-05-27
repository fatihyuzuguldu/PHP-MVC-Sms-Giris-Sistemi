<?php
require_once "App/Core/Database.php";

class Functions
{
    public function TarihSaat()
    {
        $tarih_saat = date("d.m.Y H:i");
        return $tarih_saat;
    }
    public function PrivateRandomCode()
    {
        $kodsms = rand(111111, 999999);
        return $kodsms;
    }
    public function LoginSmsSend($phoneNumber)
    {
        $kodsms = $this->PrivateRandomCode();
        $tarih_saat = $this->TarihSaat();
        // Telefon numarası geçerli ise
        $curl = curl_init();
        $params = [
            'api_id' => 'xxxxxxxx', //APİ ID GİRİNİZ
            'api_key' => 'xxxxxxxx', //APİ KEY GİRİNİZ
            'sender' => 'xxxxx', //API Kullanıcısını giriniz
            'message_type' => 'turkce',
            'message_content_type' => 'bilgi',
            'phones' => [
                [
                    "phone" => $phoneNumber,
                    "message" => "Fayu Giriş Kodu: $kodsms \nfatihyuzuguldu.com\n $tarih_saat"
                ]
            ]
        ];

        $curl_options = [
            CURLOPT_URL => 'https://api.vatansms.net/api/v1/NtoN',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ]
        ];

        curl_setopt_array($curl, $curl_options);

        $response = curl_exec($curl);
        $_SESSION['TwoFactorCode'] = $kodsms;
        return $response;
    }

    public function Toaster($status, $message) {
        if ($status === 'success') {
            echo "<script>toastr.success('$message');</script>";
        } else {
            echo "<script>toastr.error('$message');</script>";
        }
    }

    public function AuthSessionsCheck()
    {
        // "TwoFactor" anahtarı tanımlı mı kontrol edelim
        if (array_key_exists('TwoFactor', $_SESSION)) {
            // Kullanıcı zaten TwoFactor sayfasında ise ekstra yönlendirme yapmayız
            if ($_SESSION['TwoFactor'] === true && strpos($_SERVER['REQUEST_URI'], '/Auth/TwoFactor') === false) {
                header("Location: " . ROOT . "/Auth/TwoFactor");
                exit;
            } elseif ($_SESSION['TwoFactor'] === false && strpos($_SERVER['REQUEST_URI'], '/Dashboard/Index') === false) {
                header("Location: " . ROOT . "/Dashboard/Index");
                exit;
            }
        } elseif ( !isset($_SESSION["TwoFactor"]) && strpos($_SERVER['REQUEST_URI'], '/Auth/Login') === false && strpos($_SERVER['REQUEST_URI'], '/Auth/Register') === false) {
            header("Location: " . ROOT . "/Auth/Login");
        }
    }
}