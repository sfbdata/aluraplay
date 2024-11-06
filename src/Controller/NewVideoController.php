<?php

namespace aluraplay\Controller;

use aluraplay\Entity\Video;
use aluraplay\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao():void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'title');

        if(empty($url) || empty($title)){
            header('Location: /?sucesso=0');
            return;
        }


        $video = new Video($url, $title);

        $this->videoRepository->uploadImage($video);

        try {
            $this->videoRepository->add($video);
            header('Location: /?sucesso=1');
        }catch(\PDOException $e) {
            echo 'ERRO ao executar a consulta' . $e->getMessage();
            header('Location: /?sucesso=0');
        }
    }
}