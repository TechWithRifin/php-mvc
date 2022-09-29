<?php

// mencoba PATH_INFO
// if (isset($_SERVER['PATH_INFO'])) {
//     echo $_SERVER['PATH_INFO'];
// } else {
//     echo "tidak ada path info";
// }

// routing sederhana dengan PATH_INFO
// $path = '/index'; //default path jika urlnya tidak ada path_info nya

// if (isset($_SERVER['PATH_INFO'])) { //mengecek ada tidaknya path infonya
// $path = $_SERVER['PATH_INFO'];
// }

// require __DIR__ . '/../app/View' . $path . '.php';//meload file yang ada difolder app/View sesuai isi yang ada didalam path info

// menggunakan class router sudah dibuat

require_once __DIR__ . '/../vendor/autoload.php';

use TechWithRifin\Belajar\PHP\MVC\App\Router;
use TechWithRifin\Belajar\PHP\MVC\Controller\HomeController;
use TechWithRifin\Belajar\PHP\MVC\Controller\ProductController;
use TechWithRifin\Belajar\PHP\MVC\Middleware\AuthMiddleware;

// meregistrasikan router

//tanpa controller asli (hanya router saja)
// Router::add('GET', '/', 'HomeController', 'index');
// Router::add('GET', '/login', 'UserController', 'login');
// Router::add('GET', '/register', 'UserController', 'register');

// dengan controller asli
Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);
Router::add('GET', '/about', HomeController::class, 'about');

// registrasi router dengan path variables (menambahkan regex ke dalam path)
Router::add('GET', '/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)', ProductController::class, 'categories');

// !note: jika kita menambahkan regex ke dalam path saat meregistrasikan router, maka kita wajib menambahkan parameter pada function dengan jumlah yang sama dengan jumlah regex yang kita tambahkan. misalnya pada path terdapat 2 regex maka functionya harus memiliki 2 parameter 

// jika mengisi parameter tipe string dengan NamaController::class maka yang dikirim sebenarnya adalah namespace dari class tersebut

// menjalankan router nya
Router::run();