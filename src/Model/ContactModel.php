<?php

namespace App\Model;

use App\Model\DatabaseConnector;

class ContactModel extends DatabaseConnector
{
    /**
     * Insert
     *
     * @param array $form
     * @return void
     */
    public function insert(array $form): void
    {
        $q = $this->getConnection()->prepare(
            'INSERT INTO post( pseudo, email, object, message, created_at)
            VALUES (:pseudo, :mail, :objet, :message, NOW())'
        );
        $q->execute(
            [
                ':pseudo'       => htmlspecialchars($form['pseudo']),
                ':mail'         => $form['mail'],
                ':objet'        => htmlspecialchars($form['sujet']),
                ':message'      => htmlspecialchars($form['message'])
            ]
        );
    }

    public function findAllMessages(): bool|array
    {
        $q = $this->getConnection()->query('SELECT id, pseudo, email, content, created_at FROM post ORDER BY created_at DESC');
        return $q->fetchAll();
    }
}
