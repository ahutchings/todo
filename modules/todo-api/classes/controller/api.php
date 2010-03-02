<?php

abstract class Controller_API extends Controller_REST
{
    public $response;

    public function after()
    {
        $this->request->headers['Content-Type'] = 'application/json';
        $this->request->response = $this->encode($this->response);
        return parent::after();
    }

    private function encode($var)
    {
        if (is_object($var) && method_exists($var, 'as_array')) {
            $var = $var->as_array();
        }

        if (is_array($var)) {
            $var = $this->as_array_recursive($var);
        }

        return json_encode($var);
    }

    private function as_array_recursive($var)
    {
        foreach ($var as $k => $v) {
            if (is_array($v)) {
                $var[$k] = $this->as_array_recursive($v);
            }

            if (is_object($v) && method_exists($v, 'as_array')) {
                $var[$k] = $v->as_array();
            }
        }

        return $var;
    }
}
