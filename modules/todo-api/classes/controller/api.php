<?php

abstract class Controller_API extends Controller_REST
{
    public $response;

    public function after()
    {
//        $this->request->headers['Content-Type'] = 'application/json';
        $this->request->response = json_encode($this->response);
        return parent::after();
    }
}
