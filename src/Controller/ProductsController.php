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

        $this->render('products.phtml', ['products' => $products]);
    }
    public function productsDescription($id)
    {
        $productM = new ProductsModel;
        $product = $productM->getProductByID($id);
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

    public function addBasket($id)
    {
        $productM = new ProductsModel;
        $product = $productM->getProductByID($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = $_POST['quantity'];
            $size = isset($_POST['size']) ? $_POST['size'] : '';

            // Vérifiez si le produit existe déjà dans le panier
            if (isset($_SESSION['panier'][$id])) {
                $_SESSION['panier'][$id]['quantity'] += $quantity;
                if ($size !== '') {
                    $_SESSION['panier'][$id]['size'] = $size;
                }
            } else {
                $_SESSION['panier'][$id] = [
                    'quantity' => $quantity,
                    'size' => $size
                ];
            }

            // Mettre à jour la quantité disponible du produit
            $newQuantity = $product['quantity'] - $quantity;
            $productM->updateProductQuantity($id, $newQuantity);
        }
        $this->render('productDescription.phtml', ['product' => $product]);
    }

    public function deleteProduct($id)
    {
        $productM = new ProductsModel();
        $product = $productM->getProductByID($id);

        if (isset($_SESSION['panier'][$id])) {
            if ($_SESSION['panier'][$id]['quantity'] > 1) {
                $_SESSION['panier'][$id]['quantity']--;

                $newQuantity = $product['quantity'] + 1;
                $productM->updateProductQuantity($id, $newQuantity);
            } else {
                unset($_SESSION['panier'][$id]);

                $newQuantity = $product['quantity'] + 1;
                $productM->updateProductQuantity($id, $newQuantity);
            }
        }

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
