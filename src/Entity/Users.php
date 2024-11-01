<?php

namespace aluraplay\Entity;

class Users
{
    public readonly string $email;
    public function __construct(
        string $email,
        public readonly string $password,
    )
    {
        $this->setEmail($email);
    }

    public function setEmail(string $email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            throw new \InvalidArgumentException();
        }
        $this->email = $email;

    }



}