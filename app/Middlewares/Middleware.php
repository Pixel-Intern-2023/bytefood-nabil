<?php

namespace app\Middlewares;

interface Middleware{
    function before():void;
}