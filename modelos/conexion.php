<?php
    class Conexion{
        static public function conectar(){
            #PDO("nombreDelServidor; nombreBD", "UserName", "UserPassword")

            $link = new PDO('mysql:host=localhost;dbname=prueba','root','');

            $link->exec("set names utf8");
            
            return $link;
        }
    }
?>