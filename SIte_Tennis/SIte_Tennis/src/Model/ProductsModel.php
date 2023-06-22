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
}
