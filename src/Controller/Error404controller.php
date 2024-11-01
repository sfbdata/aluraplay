<?php

namespace aluraplay\Controller;

class Error404controller implements Controller
{
    public function processaRequisicao():void
    {
        http_response_code(404);
    }

}