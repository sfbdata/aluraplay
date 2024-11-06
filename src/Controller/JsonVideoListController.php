<?php

namespace aluraplay\Controller;

use aluraplay\Entity\Video;
use aluraplay\Repository\VideoRepository;

class JsonVideoListController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $videoList = array_map(function(Video $video): array {
            return [
                'url' => $video->url,
                'title' => $video->title,
                'file_path' => '/img/uploads/' . $video->getFilepath()
            ];
        }, $this->videoRepository->all());
        echo json_encode($videoList);
    }
}