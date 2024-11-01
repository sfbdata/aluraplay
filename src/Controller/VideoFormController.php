<?php

namespace aluraplay\Controller;

use aluraplay\Entity\Video;
use aluraplay\Repository\VideoRepository;

class VideoFormController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao():void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        /** @var ?Video $video */
        $video = null;

        if (!empty($id)) {
            $video = $this->videoRepository->find($id);
        }
        require_once __DIR__ . '/../../views/video-form.php';
    }

}