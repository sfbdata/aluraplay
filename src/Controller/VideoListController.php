<?php

namespace aluraplay\Controller;

use aluraplay\Repository\VideoRepository;

class VideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {

        $videolist = $this->videoRepository->all();
        require_once __DIR__ . '/../../views/video-list.php';
    }

}