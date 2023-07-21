<?php

class Allert
{

    public static function set(string $title, string $subtitle, $data = null)
    {
        $_SESSION['allert_message'] = [
            "title" => $title,
            "subtitle" => $subtitle,
            "data" => $data
        ];
    }

    public static function get()
    {
        if (isset($_SESSION['allert_message'])) {
            $message = $_SESSION['allert_message'];
            $title = $message['title'];
            $text = $message['subtitle'];
            $data = $message['data'] ?? "";
            echo "<script>
    (function toastSuccess(){
        Swal.fire({
            icon: 'success',
            title: '$title',
            text: '$text',
            html: '$data',
        })
    })()
    </script>";
            unset($_SESSION['allert_message']);
        }
    }
}
