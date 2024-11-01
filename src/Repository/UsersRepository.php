<?php

namespace aluraplay\Repository;

use aluraplay\Entity\Users;

class UsersRepository
{
    public function __construct(\PDO $pdo)
    {
    }

    public function findUser(Users $usuario): bool
    {
        $sql = 'SELECT * FROM users WHERE email= ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $usuario->email);
        $stmt->execute();

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
        $corretPassword = password_verify($usuario->password, $userData['password'] ?? '');

        return $corretPassword;

    }

}