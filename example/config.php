<?php

/**
* настройка подключения к веб-сервисам
* 
* @var array
*/
$user_settings = array(
    'user_login'         => '{ЛОГИН}',   // логин
    'user_password'     => '{ПАРОЛЬ}'  // пароль
);

/**
* настройки по умолчанию
* 
* @param VKORG - сбытовая организация.
* @param KUNNR_RG - код покупателя
* @param KUNNR_WE - код грузополучателя
* @param KUNNR_ZA - код адреса доставки
* @param INCOTERMS - самовывоз
* @param PARNR - код контактного лица
* @param VBELN - номер договора
* 
* @var array
*/
$ws_default_settings = array(
    
    'VKORG'         => ''        
    ,'KUNNR_RG'     => ''
    ,'KUNNR_WE'     => ''
    ,'KUNNR_ZA'     => ''
    ,'INCOTERMS'    => ''
    ,'PARNR'        => ''
    ,'VBELN'        => ''
    ,'format'       => 'json'
  
);

