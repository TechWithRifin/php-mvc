<?php

namespace TechWithRifin\Belajar\PHP\MVC\Controller;

use TechWithRifin\Belajar\PHP\MVC\App\View;

class HomeController
{
    function index(): void
    {
        // data dibawah ini bisa disebut model
        $model = [
            "title" => "Belajar PHP MVC",
            "content" => "Selamat Belajar PHP MVC dari Tech With Rifin"
        ];
        View::render('Home/index', $model);
    }

    function hello(): void
    {
        echo "HomeController.hello()";
    }

    function world(): void
    {
        echo "HomeController.world()";
    }

    function about(): void
    {
        echo "author : ahmad arifin";
    }

    function login(): void
    {
        // data dibawah ini bisa disebut model request
        $request = [
            "username" => $_GET['username'],
            "password" => $_GET['password']
        ];

        // data dibawah ini bisa disebut model response
        $response = [
            "message" => "anda berhasil login"
        ];
        // data response diatas nanti kita bisa kirimkan ke view
    }
}