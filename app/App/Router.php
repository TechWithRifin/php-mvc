<?php

namespace TechWithRifin\Belajar\PHP\MVC\App;

class Router
{
    private static array $routes = [];

    // melakukan url mapping
    public static function add(string $method, string $path, string $controller, string $function, array $middlewares = []): void
    {
        // menambahkan semua value yang di inputkan ke dalam parameter kedalam static array property $routes (kita bisa menggunakan array_push() atau seperti dibawah juga boleh (karena fungsinya sama))
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middlewares' => $middlewares
        ];
    }

    // menjalankan router
    public static function run(): void
    {
        $path = '/'; //default path jika urlnya tidak ada path_info nya
        // mengecek apakah ada path infonya
        if (isset($_SERVER['PATH_INFO'])) {
            // kalau ada kita akan mengganti value dari variable $path dengan value path info yang ada di URL
            $path = $_SERVER['PATH_INFO'];
        }
        $method = $_SERVER['REQUEST_METHOD']; //mengambil method dari URL yang dikirim (misal GET, POST, PUT atau DELETE)

        // melakukan perulangan dengan data yang ada di array $routes
        foreach (self::$routes as $route) {

            // membuat pattern untuk path url nya
            $pattern = "#^" . $route['path'] . "$#";

            // mengecek apakah path yang ada di value path_info dan method yang ada di value request_method yang sama dengan value path dan method yang ada didalam array $routes
            // if ($path == $route['path'] && $method == $route['method']) {

            // mencocokkan pattern path url yang ada didalam array $routes dengan path_info dari url yang dikirim dan mencocokkan method yang ada didalam array routes dengan request methods dari url yang dikirim
            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {
                // jika ada kita akan melakukan print out nama controller dan functionnya
                // echo "CONTROLLER : " . $route['controller'] . ", FUNCTION : " . $route['function'];

                foreach ($route['middlewares'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                $function = $route['function'];

                $controller = new $route['controller']; //pada php kita bisa membuat object menggunakan namaNamespaceController yang berupa string asalkan namaNamespace tersebut ditampung dulu didalam sebuah variable (tidak bisa langsung new 'namaNamespace'. contohnya  new 'TechWithRifin\Belajar\PHP\MVC\Controller\HomeController'; <- ini akan error) <-pejelasan detailnya ada di bawah
                // $controller->$function(); // php juga bisa memanggil sebuah function dengan nama functionnya berupa string asalkan nama functionnya dimasukkan kedalam variable terlebih dahulu sebelum dipanggil (tidak bisa langsung $controller->'namaFunction'(). misalnya $controller->'index'()) <- jika kita melakukan ini maka akan terjadi eror

                array_shift($variables); //menghapus value dari index ke 0 dari array $variables

                call_user_func_array([$controller, $function], $variables); //penjelasan ada dibawah

                return;
            }
        }
        // jika tidak ada yang sama maka akan mengeluarkan http error code 404 dan print out controller not found
        http_response_code(404);
        echo "CONTROLLER NOT FOUND";
    }
}

/** 
 * * URL Mapping *
 * saat kita membuat Router, kita perlu untuk memberitahu Router tentang pasangan antara PATH_INFO mana, HTTP method mana dan nanti akan dipasangkan ke controller mana yang akan dieksekusi termasuk function di controller nya
 * selain itu kita juga perlu untuk memberitahu HTTP method mana yang dibolehkan untuk mengakses PATH_INFO tersebut 
 */

/**
 * * Memilih Controller dari PATH_INFO *
 * Setelah kita menambahkan semua URL mapping ke dalam router, maka kita dengan mudah bisa mendapatkan controller mana yang perlu dieksekusi ketika ada request terhadap PATH_INFO
 */

// contoh membuat object dengan string class dan memanggil function dari string

// yang benar
// $className = 'TechWIthRifin\Belajar\PHP\MVC\Controller\HomeController';
// $functionName = 'index';

// membuat object dengan class namespace berupa string dan memanggil fuction dari string dengan cara ini dibolehkan di PHP
// $controller = new $className;
// $controller->$functionName();

// namun membuat object dengan class namespace berupa string dan memanggil fuction dari string dengan cara ini ditidak dibolehkan di PHP 

// $controller = new 'TechWIthRifin\Belajar\PHP\MVC\Controller\HomeController';

// $controller->'index'();

// gampangnya stringnya disimpan dulu divariable baru dapat di buat object atau dipanggil functionnya

/**
 * * Mengirim Variable ke Controller
 * setelah menggunakan regex untuk melakukan pengecekan path, kita juga bisa mengirim variable  hasil regex tersebut ke parameter function di dalam controller
 * cara mengirim variable hasil regex ke dalam paratamer function adalah dengan call_user_func_array([$namaController, $namaFunctin], $variables)
 * dengan melakukan hal tersebut secara otomatis data didalam array $variables akan diekstrak kemudian di masukkan ke dalam parameter function satu persatu. misalnya didalam array $variables terdapat 2 nilai yaitu ['idproduk','idcategory'] maka nilai array tersebut akan dikirim ke dalam function dengan format pemanggilan namaFunction(nilaiArrayIndexke0, nilaiArrayIndexke1,dst); <-jika didalam array $variables ternyata tidak ada datanya maka tidak akan mengirim nilai ke dalam parameter function nya (format pemanggilannya akan menjadi namaFunction())
 */