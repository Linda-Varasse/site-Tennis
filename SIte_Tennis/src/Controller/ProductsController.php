<?php

namespace App\Controller;

class ProductsController extends AbstractController
{
    public function products()
    {
        $this->render('products.phtml');
    }
}
