<?php

namespace aluraplay\Controller;

use aluraplay\Entity\Video;
use aluraplay\Repository\VideoRepository;

class EditVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        $title = filter_input(INPUT_POST, 'title');

        if(empty($id) || empty($url) || empty($title)) {
            header('Location: /?sucesso=0');
            exit();
        }

        $video = new Video($url, $title);
        $video->setId($id);

        $this->videoRepository->uploadImage($video);

        try {
            $this->videoRepository->update($video);
            header('Location: /?sucesso=1');

        } catch(\PDOException $e) {
            echo 'ERRO ao executar a consulta' . $e->getMessage();
            header('Location: /?sucesso=0');
        }

    }

    /**
     * @param Video $video
     * @return void
     */


}