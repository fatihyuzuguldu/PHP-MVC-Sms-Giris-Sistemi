<?php
require_once "Config.php";
Trait Database {
    private function connect()
    {
        $string = "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8mb4";
        try {
            $con = new PDO($string, DBUSER, DBPASS);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        try {
            $check = $stm->execute($data);
            if ($check) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                if (is_array($result) && count($result)) {
                    return $result;
                }
            }
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }

        return false;
    }

    public function get_row($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);

        try {
            $check = $stm->execute($data);
            if ($check) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                if (is_array($result) && count($result)) {
                    return $result[0];
                }
            }
        } catch (PDOException $e) {
            die("Query execution failed: " . $e->getMessage());
        }

        return false;
    }

    public function prepare($query, $data = []) {
        $con = $this->connect();
        $stm = $con->prepare($query);

        try {
            $check = $stm->execute($data);
            if (!$check) {
                // Sorgu başarısız olduysa hata mesajı yazdır
                die("Query execution failed");
            }
        } catch (PDOException $e) {
            // İstisna durumunda hata mesajı yazdır
            die("Query execution failed: " . $e->getMessage());
        }
    }

}


