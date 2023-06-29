<?php

namespace App\Model;

use App\Model\DatabaseConnector;

class UserModel extends DatabaseConnector
{
    public function insert(array $form): void
    {
        $q = $this->getConnection()->prepare(
            'INSERT INTO user(pseudo, email, password, created_at)
        VALUES (:pseudo, :mail, :mdp, NOW())'
        );
        $q->execute(
            [
                ':pseudo' => $form['pseudo'],
                ':mail' => $form['mail'],
                ':mdp'  => password_hash($form['pwd'], PASSWORD_DEFAULT)
            ]
        );
    }
    public function findByEmail(string $email): bool|array
    {
        $q = $this->getConnection()->prepare(
            'SELECT id_user, pseudo, email, password, created_at, role_id FROM user WHERE email = :mail'
        );
        $q->execute(
            [':mail' => $email]
        );
        return $q->fetch();
    }
    public function update(int $userId, string $password): void
    {
        $q = $this->getConnection()->prepare(
            'UPDATE user SET password = :pass WHERE id_user = :userId'
        );
        $q->execute(
            [
                ':userId'   => $userId,
                ':pass'     => password_hash($password, PASSWORD_DEFAULT)
            ]
        );
    }
}
