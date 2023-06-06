<?php

namespace app\core;

class Response
{

    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }

}