<?php
error_reporting(-1);
ini_set('display_errors', 1);

require_once '../config.php';
require_once '../../src/Config/Config.php';
require_once '../../src/Contracts/RequestInterface.php';
require_once '../../src/Contracts/ResponseInterface.php';
require_once '../../src/Exception/ArmtekException.php';
require_once '../../src/ArmtekRestClient.php';
require_once '../../src/Request.php';
require_once '../../src/Response.php';

use ArmtekRestClient\Http\Exception\ArmtekException as ArmtekException; 
use ArmtekRestClient\Http\Config\Config as ArmtekRestClientConfig;
use ArmtekRestClient\Http\ArmtekRestClient as ArmtekRestClient; 

try {

    // init configuration 
    $armtek_client_config = new ArmtekRestClientConfig($user_settings);  

    // init client
    $armtek_client = new ArmtekRestClient($armtek_client_config);


    $params = [
        'KEY'         => ''       
    ];

    // requeest params for send
    $request_params = [

        'url' => 'user/getPriceStatusByKey',
        'params' => [
            'KEY'         => !empty($params['KEY'])?$params['KEY']:''       
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

// 
echo "<h1>Сервис получения данных по задаче</h1>";
echo "<h2>Входные параметры</h2>";
echo "<pre>"; print_r( $request_params ); echo "</pre>"; 
echo "<h2>Ответ</h2>";
echo "<pre>"; print_r( $json_responce_data ); echo "</pre>";
?>
