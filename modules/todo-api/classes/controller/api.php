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
        // convert Database_Result objects to arrays
        if (is_object($var) && is_a($var, 'Database_Result')) {
            $var = $var->as_array();
        }

        // convert ORM result collections to arrays
        if (is_array($var) && is_object($var[0]) && is_a($var[0], 'ORM')) {
            $var = array_map(create_function('$obj', 'return $obj->as_array();'), $var);
        }

        return json_encode($var);
    }
}
