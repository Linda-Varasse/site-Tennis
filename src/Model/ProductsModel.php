<?php

namespace App\Model;

use App\Model\DatabaseConnector;

class ProductsModel extends DatabaseConnector
{

    public function getAllProducts()
    {
        $q = $this->getConnection()->prepare("SELECT * FROM products");
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }
    public function getProductByID($id)
    {
        $q = $this->getConnection()->prepare(
            'SELECT *
            FROM products 
            WHERE id = :id'
        );
        $q->bindValue(':id', $id,);
        $q->execute();

        $product = $q->fetch();

        return $product;
    }
    public function getProductsBasket()
    {
        $ids = array_keys($_SESSION['panier']);

        if (empty($ids)) {
            return array(); // Panier vide, renvoie un tableau vide
        }
        $idsString = implode(',', $ids);

        $stmt = $this->getConnection()->prepare("SELECT * FROM products WHERE id IN ($idsString)");
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    public function updateProductQuantity($productId, $newQuantity)
    {
        $stmt = $this->getConnection()->prepare('UPDATE products SET quantity = :quantity WHERE id = :id');

        $stmt->execute([
            'quantity' => $newQuantity,
            'id' => $productId
        ]);
    }
}
