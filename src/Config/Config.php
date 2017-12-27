<?php

namespace ArmtekRestClient\Http\Config;

// для пользователей РФ
define('ARMTEL_LIB_WS_HOST_RU', 'ws.armtek.ru');
// для пользователей РБ
define('ARMTEL_LIB_WS_HOST_BY', 'ws.armtek.by');

/**
* Config.
*
* настройки подключения
*
* @since 1.0.0
*/
class Config                          
{
    /**
    * constant lib version
    */
    const LIB_ARC_VERSION                   = '1.0.0';
    
    /**
    *
    */
    const DEFAULT_COMPONENT_NAME            = 'ping';
    
    /**
    * 
    */
    const DEFAULT_COMPONENT_METHOD_NAME     = 'index';
    
    const LIB_WS_HOST_POSTFIX               = 'api';
    
    const COMPONENT_PREFIX                  = 'ws_';
    
    const DEFAULT_HOST                      = ARMTEL_LIB_WS_HOST_RU;
    
    /**
    * url for connect
    * 
    * @var string
    */
    private $_url               = ARMTEL_LIB_WS_HOST_RU;
    
    /**
    * user login
    * 
    * @var string
    */
    private $_user_login        = '{ENTER_USER_LOGIN_HERE}';
    
    /**
    * user password
    * 
    * @var string
    */
    private $_user_password     = '{ENTER_USER_PASSWORD_HERE}';
    
    
    
    public function __construct(array $config_params=array())
    {
        if (! empty($config_params)) {
            
            foreach ($config_params as $param => $value) {   
                
                $this -> $param = $value;    
            
            }
        }
        
    }
    
    public function __get($param_name)
    {
        return $this -> {'_' . $param_name};    
    }

    public function __set($param_name, $param_value = false)
    {
        $param_name = '_'.$param_name;
                                                   
        if (property_exists($this, $param_name)) {
            
            if ($param_name == '_url') {
                
                $arr_param_value = parse_url($param_value);
                $this -> _url = !empty($arr_param_value['host'])?$arr_param_value['host']:self::DEFAULT_HOST;
                    
            } else {
            
                $this -> $param_name = $param_value;
                
            }
            
                 
        }
        
    }
    
    /**
    * get service Url 
    * 
    * @param string $url_data
    * @return string $url
    */
    public function genUrl($url_data)
    {
        $component_name = '';
        $component_method_name = '';
        $url_data = (string) $url_data;
        
        $arr_url_info = parse_url($url_data);
        $arr_path = explode('/',!empty($arr_url_info['path'])?$arr_url_info['path']:'');
        
        if (! empty($arr_path)) {
            foreach ($arr_path as $val) {
                $val = strtolower($val);
                if ($val != self::LIB_WS_HOST_POSTFIX) {
                    if (empty($component_name)) {
                        $component_name = trim(preg_replace('/^'.self::COMPONENT_PREFIX.'/i','',$val)); 
                    } else {
                        $component_method_name = trim($val);
                        break;     
                    }
                      
                }
            }
        } 
        
        if (empty($component_name)) 
            $component_name = self::DEFAULT_COMPONENT_NAME;    
        if (empty($component_method_name)) 
            $component_method_name = self::DEFAULT_COMPONENT_METHOD_NAME;    
        
        return "http://" . $this -> _url . '/' . self::LIB_WS_HOST_POSTFIX .'/'. self::COMPONENT_PREFIX . $component_name .'/'. $component_method_name; 
        
    }
    
    /**
    * 
    * @return string $user_login
    */
    public function getUserLogin()
    {
        return (string) $this -> _user_login;    
    }
    
    /**
    * 
    * @return string $user_password
    */
    public function getUserPassword()
    {
        return (string) $this -> _user_password;     
    }
    
    /**
    * 
    * @return string library version
    */
    public function getVersion()
    {
        return (string) self::LIB_ARC_VERSION;     
    }
    
}