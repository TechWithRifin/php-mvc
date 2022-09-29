<?php

namespace TechWithRifin\Belajar\PHP\MVC\Controller;

class ProductController
{
    public function categories(string $idProduct, string $idCategories): void
    {
        echo "id product : $idProduct , id categories : $idCategories";
    }
}