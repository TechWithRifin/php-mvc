<?php

namespace TechWithRifin\Belajar\PHP\MVC;

use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testRegex()
    {
        $path = "/products/12345/categories/abcde";

        $pattern = "#^/products/([0-9a-zA-Z]*)/([0-9a-zA-Z]*)$#";

        $result = preg_match($pattern, $path, $variables); //$variables adalah reference variable

        // variable $variables akan menampung data regex dalam bentuk array (pada kasus diatas isi dari $variables adalah /products/12345/categories/abcde (value dari $path) , 1234 (value dari regex pertama) dan abcde (value dari regex kedua))

        $this->assertEquals(1, $result);

        var_dump($variables);

        array_shift($variables); //menghapus data array index ke 0
        var_dump($variables);
    }
}

/**
 * * Penjelasan isi dari variable $pattern *
 * tanda # di awal dan akhir itu untuk menandai bahwa itu adalah sebuah pattern (tanda bisa diganti dengan karakter apapun asalkan tanda itu terletak di awal dan akhir dari pattern)
 * tanda ^ diawal itu untuk menandakan awal dari pattern
 * tanda diakhir $ untuk menandakan akhir dari pattern
 * tanda ^ dan $ wajib ada pada sebuah pattern
 * tanda () untuk mendakan sebuah regex (dalam kasus ini didalam variable $pattern terdapat 2 buah regex)
 * tanda [] didalam () untuk menampung karakter apa saja yang dibolehkan ada didalam regex tersebut
 * pada regex pertama kita membolehkan karakter angka (0-9), huruf kecil (a-z) dan huruf besar (A-Z)
 * tanda * didalam () untuk menandakan regex tersebut boleh di isi lebih dari 1 karakter
 */

/**
 * * reference variable
 * reference variable adalah suatu kondisi dimana saat kita mengganti nilai dari suatu variable didalam sebuah function, maka variable yang ada diluar function tersebut akan ikut berganti juga
 * misal pada awalnya nilai dari $variables diluar yang ada diluar function preg_match adalah 0 lalu didalam function preg_match kita mengganti nilai dari variable $variables nya menjadi 3 maka secara otomatis nilai dari variable $variables yang ada diluar function preg_match juga ikut bernilai 3
 */