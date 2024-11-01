<?php

namespace aluraplay\Controller;

use aluraplay\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (empty($id)) {
            header ('Location: /?sucesso=0');
            throw new \InvalidArgumentException('O valor do ID é inválido. Deve ser um número inteiro.');
        }

        try {
            $this->videoRepository->remove($id);
            header('Location: /?sucesso=1');
        } catch (\PDOException $e) {
            echo "Erro ao executar a Query" . $e->getMessage();
            header('Location: /?sucesso=0');
        }
    }

}