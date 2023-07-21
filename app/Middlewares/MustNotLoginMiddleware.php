<?php

namespace app\Middlewares;

class MustNotLoginMiddleware implements Middleware{

    public function before():void
    {
        session_start();
        if(isset($_SESSION["auth_id"])){
            header("Location: /");
        }
    }
}