<?php

namespace aluraplay\Controller;

use aluraplay\Entity\Users;
use aluraplay\Repository\VideoRepository;

class LoginController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if(empty($email) || empty($password)) {
            header('Location: /?sucesso=0');
            exit();
        }
        $user = new Users($email, $password);
        $corretPassword = $this->videoRepository->findUser($user);


        if($corretPassword) {

            $_SESSION['logado'] = true;
            header('Location: /');
        }else {
            header('Location: /login?sucesso=0');
        }
    }
}