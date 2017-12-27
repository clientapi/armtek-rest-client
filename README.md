# Armtek HTTP Client

Armtek HTTP клиент для работы с веб-сервисами (JSON или XML).

*P.S. Это перепакованная версия [официального клиента](http://ws.armtek.ru/?page=material&alias=rest-examples), для работы с [composer](https://getcomposer.org/)*


## Установка

Установить [Composer](http://getcomposer.org/) если он не был установлен ранее.

Запустите команду

```
composer require clientapi/armtek-rest-client "~1.0.0"
```

или

```
"clientapi/armtek-rest-client": "~1.0.0"
```

или добавьте в файл ```composer.json```


## Пример

Авторизация

```php
use ArmtekRestClient\Http\Config\Config as ArmtekRestClientConfig;

// Настройка подключения
$armtek_client_config = new ArmtekRestClientConfig([
	'user_login' =>     '{ЛОГИН}',
	'user_password' =>  '{ПАРОЛЬ}',
]);  
```

Пример поискового запроса
```php
use ArmtekRestClient\Http\Exception\ArmtekException as ArmtekException;
use ArmtekRestClient\Http\ArmtekRestClient as ArmtekRestClient; 

try {
    // init client
    $armtek_client = new ArmtekRestClient($armtek_client_config);


    $params = [
        'VKORG'         => ''       
        ,'KUNNR_RG'     => ''
        ,'PIN'          => 'oc47'
        ,'BRAND'        => 'KNECHT'
        ,'QUERY_TYPE'   => ''
        ,'KUNNR_ZA'     => ''
        ,'INCOTERMS'    => ''
        ,'VBELN'        => ''
    ];

    // requeest params for send
    $request_params = [

        'url' => 'search/search',
        'params' => [
            'VKORG'         => !empty($params['VKORG'])?$params['VKORG']:(isset($ws_default_settings['VKORG'])?$ws_default_settings['VKORG']:'')       
            ,'KUNNR_RG'     => isset($params['KUNNR_RG'])?$params['KUNNR_RG']:(isset($ws_default_settings['KUNNR_RG'])?$ws_default_settings['KUNNR_RG']:'')
            ,'PIN'          => isset($params['PIN'])?$params['PIN']:''
            ,'BRAND'        => isset($params['BRAND'])?$params['BRAND']:''
            ,'QUERY_TYPE'   => isset($params['QUERY_TYPE'])?$params['QUERY_TYPE']:''
            ,'KUNNR_ZA'     => isset($params['KUNNR_ZA'])?$params['KUNNR_ZA']:(isset($ws_default_settings['KUNNR_ZA'])?$ws_default_settings['KUNNR_ZA']:'')
            ,'INCOTERMS'    => isset($params['INCOTERMS'])?$params['INCOTERMS']:(isset($ws_default_settings['INCOTERMS'])?$ws_default_settings['INCOTERMS']:'')
            ,'VBELN'        => isset($params['VBELN'])?$params['VBELN']:(isset($ws_default_settings['VBELN'])?$ws_default_settings['VBELN']:'')
            ,'format'       => 'json'
        ]

    ];

    // send data
    $response = $armtek_client->post($request_params);

    // in case of json
    $json_responce_data = $response->json();

} catch (ArmtekException $e) {
    $json_responce_data = $e -> getMessage(); 
}
```

Больше примеров в папке `example`.

## Документация

http://ws.armtek.ru/
