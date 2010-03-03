<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract Controller class for RESTful controller mapping.
 *
 * @package    Controller
 * @author     Kohana Team
 * @copyright  (c) 2009 Kohana Team
 * @license    http://kohanaphp.com/license
 */
abstract class Controller_REST extends Controller {

    protected $_action_map = array
    (
        'GET'    => 'index',
        'PUT'    => 'create',
        'POST'   => 'update',
        'DELETE' => 'delete',
    );

    protected $_action_requested = '';

    /**
     * The HTTP pseudo method
     *
     * @var string
     * @static
     */
    protected $_http_method;

    public function before()
    {
        $this->_action_requested = $this->request->action;
        $this->_http_method      = $this->detect_http_method();

        if (!isset($this->_action_map[$this->_http_method])) {
            $this->request->action = 'invalid';
        } else {
            $this->request->action = $this->_action_map[$this->_http_method];
        }

        return parent::before();
    }

    public function action_invalid()
    {
        // Send the "Method Not Allowed" response
        $this->request->status = 405;
        $this->request->headers['Allow'] = implode(', ', array_keys($this->_action_map));
    }

    protected function detect_http_method()
    {
        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'];
        }

        return Request::$method;
    }

} // End REST
