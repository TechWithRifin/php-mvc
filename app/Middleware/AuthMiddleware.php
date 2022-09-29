<?php

namespace TechWithRifin\Belajar\PHP\MVC\Middleware;

class AuthMiddleware implements Middleware
{
    public function before():void
    {
        session_start();
        if(!isset($_SESSION['user'])){
            header('location:/login');
            exit(); //menghentikan proses php (menghentikan semua proses php dibawahnya)
        }
    }
}