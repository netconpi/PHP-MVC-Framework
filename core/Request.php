<?php

namespace app\core;

class Request
{
    public function getPath(): string
    {
        return parse_url(['REQUEST_URI'] ?? '/')['path'];
    }

    public function getMethod()
    {}

    public function getBody()
    {}
}