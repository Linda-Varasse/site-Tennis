<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\ProductsModel;

class ProductsController extends AbstractController

{

    public function products()

    {
        $productM = new ProductsModel;
        $products = $productM->getAllProducts();
        var_dump($products[0]['id']);
        $this->render('products.phtml', ['products' => $products]);
    }
    public function productsDescription($id)
    {
        $productM = new ProductsModel;
        $product = $productM->getProductByID($id);
        $this->render('productDescription.phtml', ['product' => $product]);
    }
}
