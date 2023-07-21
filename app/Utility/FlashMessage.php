<?php

namespace app\Utility;

class FlashMessage{
    
    public static function set(string $title, string $subtitle, array $data)
    {
        session_start();
        $_SESSION['flashmessage'] = [
            'title' => $title,
            'subtitle' => $subtitle,
            'data' => $data
        ];
    }

    public static function get()
    {
        session_start();
        if(isset($_SESSION['flashmessage'])){
            $data = $_SESSION['flashmessage'];
            require_once __DIR__ . "/FlashMessageView.php";
            session_destroy();
        }
    }
}