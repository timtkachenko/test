<?php

namespace TT;

/**
 * Description of Response
 *
 * @author tt
 */
class Request implements Injectable {

    private $params = [];
    private $headers = [];

    public function __construct(Locator $sl) {
        $this->server = $_SERVER;
        $this->headers = $this->getHeaderList();
        $this->method = strtolower($this->server['REQUEST_METHOD']);

        switch ($this->method) {
            case 'get':
            case 'post':
            case 'delete':
                $this->params = array_merge($_POST, $_GET);
                break;
            case 'put':
                parse_str(file_get_contents('php://input'), $this->params);
                break;
            default:
                break;
        }
    }

    private static $instance;

    public static function instance(Locator $sl) {
        if (null === static::$instance) {
            static::$instance = new static($sl);
        }
        return static::$instance;
    }

    public function getHeaderList() {
        foreach ($this->server as $key => $value) {
            if (0 === strpos($key, 'HTTP_')) {
                $headers[substr($key, 5)] = $value;
            }
        }
        return $headers;
    }

    public function getHeader($name) {
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }

    public function getParams() {
        return $this->params;
    }

    public function get($name, $filter = FILTER_DEFAULT) {
        $param = isset($this->params[$name]) ? $this->params[$name] : null;
        return filter_var($param, $filter);
    }

    public function set($name, $val, $filter = FILTER_DEFAULT) {
        $this->params[$name] = filter_var($val, $filter);
    }

}
