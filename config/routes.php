<?php


return [
    'GET|/' => \aluraplay\Controller\VideoListController::class,
    'GET|/novo-video' => \aluraplay\Controller\VideoFormController::class,
    'POST|/novo-video' => \aluraplay\Controller\NewVideoController::class,
    'GET|/editar-video' => \aluraplay\Controller\VideoFormController::class,
    'POST|/editar-video' => \aluraplay\Controller\EditVideoController::class,
    'GET|/remover-video' => \aluraplay\Controller\DeleteVideoController::class,
    'GET|/login' => \aluraplay\Controller\LoginFormController::class,
    'POST|/login' => \aluraplay\Controller\LoginController::class,
    'GET|/logout' => \aluraplay\Controller\LogoutController::class,
    'GET|/remover-capa' => \aluraplay\Controller\RemoverCapaController::class

];