<?php

namespace ArmtekRestClient\Http;

use \ArmtekRestClient\Http\Config;
use \ArmtekRestClient\Http\Exception;


/**
* ArmtekRestClient.
*
* @since 1.0.0
*/
class ArmtekRestClient
{
    /**
    * ArmtekRestClient configuration
    * 
    * @var null|object
    */
    private $_config = null;
    
    public function __construct(\ArmtekRestClient\Http\Config\Config $config)
    {
        $this->_config = $config;    
    }
    
    
    /**
    * @param string|array $request
    *
    * @return bool
    */
    protected function valid($request_params)
    {
        return (boolean) array_key_exists('url', $request_params);
    }

    private function requestInstance($request)
    {
        return new Request($request, $this->_config);
    }

    public function __call($method, $arguments)
    {
        $request_params = array_pop($arguments);
        
        if (!is_array($request_params)) {
            $request_params = ['url' => $request_params];
        }

        if ($this->valid($request_params)) {
        
            $request_params['method'] = Request::method($method);
            $this->request = $this->requestInstance($request_params);
        
            return $this->request->send();
        }
        
        throw new \ArmtekRestClient\Http\Exception\ArmtekException('Ошибка! Запрос не может быть создан');
    }
}