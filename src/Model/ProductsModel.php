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
    public function productsBasket()
    {
        $ids = array_keys($_SESSION['panier']);
        $q = $this->getConnection()->prepare("SELECT * FROM products WHERE id IN (" . implode(',', $ids) . ")");
        $q->execute();
        $result = $q->fetchAll();
        return $result;
    }
}
