<?php

abstract class Controller_API extends Controller_REST
{
    /*
     * Used by child controllers to set the response value.
     */
    protected $_raw_response;

    public function after()
    {
        $this->response->headers('Content-Type', 'application/json');
        $this->response->body($this->encode_response($this->_raw_response));

        return parent::after();
    }

    private function encode_response($var)
    {
        if (is_object($var) && method_exists($var, 'as_array'))
        {
            $var = $var->as_array();
        }

        if (is_array($var)) 
        {
            $var = $this->as_array_recursive($var);
        }

        return json_encode($var);
    }

    private function as_array_recursive($var)
    {
        foreach ($var as $k => $v)
        {
            if (is_array($v))
            {
                $var[$k] = $this->as_array_recursive($v);
            }

            if (is_object($v) && method_exists($v, 'as_array'))
            {
                $var[$k] = $v->as_array();
            }
        }

        return $var;
    }

    /**
     * Retrieves the raw input data.
     *
     * @return mixed
     */
    public function input()
    {
        switch (Request::$method)
        {
            case 'POST':
                $input = file_get_contents('php://input', 'r');
                break;
            case 'PUT':
                $stream = fopen('php://input', 'rb');
                $input  = '';
                while ($data = fread($stream, 1024))
                {
                    $input .= $data;
                }
                fclose($stream);
                break;
            default:
                throw new Kohana_Exception('Unsupported request method :method', array(':method' => Request::$method));
        }

        return json_decode($input);
    }
}
