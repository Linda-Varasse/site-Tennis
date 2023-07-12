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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['productId'];
            if (isset($_SESSION['panier'][$productId])) {
                $_SESSION['panier'][$productId]++;
            } else {
                // Ajouter le produit à la session du panier
                $_SESSION['panier'][$productId] = 1;
            }
        }
        $this->render('products.phtml', ['products' => $products]);
    }
    public function productsDescription($id)
    {
        $productM = new ProductsModel;
        $product = $productM->getProductByID($id);
        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $productId = $_POST['productId'];
        //     if (isset($_SESSION['panier'][$productId])) {
        //         $_SESSION['panier'][$productId]++;
        //     } else {
        //         // Ajouter le produit à la session du panier
        //         $_SESSION['panier'][$productId] = 1;
        //     }
        // }

        // $productM = new ProductsModel;
        // $products = $productM->getAllProducts();
        $this->render('productDescription.phtml', ['product' => $product]);
    }
    public function basket()
    {
        if (!isset($_SESSION)) {
            session_start();
        };
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }

        if (empty($_SESSION['panier'])) {
            $products = array();
        } else {
            $productM = new ProductsModel;
            $products = $productM->getProductsBasket();
        }
        $this->render('basket.phtml', ['products' => $products]);
    }

    public function deleteProduct($id)
    {
        unset($_SESSION['panier'][$id]);
        $productM = new ProductsModel();
        $products = $productM->getProductsBasket();

        $this->render('basket.phtml', ['products' => $products]);
    }
    public function total()
    {
        $total = 0;
        if (empty($_SESSION['panier'])) {
            $products = array();
        } else {
            $productM = new ProductsModel;
            $products = $productM->getProductsBasket();
        }
        foreach ($products as $product) {
            $total += $product->$product['prix'];
        }
        return $total;
    }
}
