<?php

namespace ProjectInitiator;

use ProjectInitiator\Http\Request;
use ProjectInitiator\Http\Response;
use ProjectInitiator\Http\Route;

class Application
{
    protected Request $request;
    protected Response $response;
    protected Route $route;
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
    }

    public function run()
    {
        $this->route->resolve();
    }
}
