<?php

namespace ProjectInitiator\Http;

class Request
{
    public function method()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function path()
    {
        return str_contains($_SERVER["REQUEST_URI"], "?") ? explode("?", $_SERVER["REQUEST_URI"])[0] : $_SERVER["REQUEST_URI"];
    }
}
