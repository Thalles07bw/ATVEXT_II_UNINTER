<?php

namespace App\Classes\Mysql;

class ConnectSQL{
    public function getConnection(){
        $servername = "br434.hostgator.com.br";
        $username = "loja1409";
        $password = "9ur9Z7l0mQ";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=loja1409_bdradio", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }
}
?>