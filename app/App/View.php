<?php

namespace app\App;

class View{
    
    public static function returnView(string $name, array $model = [], array $layouts = ["/../layouts/header.php", "/../layouts/footer.php"]){
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
        $domain = $_SERVER['HTTP_HOST'];
        $mainURL = $protocol . $domain;
        // require_once __DIR__ . "/../Views/layouts/header.php";
        require_once __DIR__ . "/../Views" . $name . ".php";
        // require_once __DIR__ . "/../Views/layouts/footer.php";
    }

    public static function redirect(string $value){
        header("Location: $value");
    }
}