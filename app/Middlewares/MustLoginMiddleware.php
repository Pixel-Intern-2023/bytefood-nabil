<?php

namespace app\Middlewares;

class MustLoginMiddleware implements Middleware{

    public function before():void
    {
        session_start();
        if(!isset($_SESSION["auth_id"])){
            header("Location: /login");
        }
    }
}