<?php
    header('Content-Type: application/json');

    require_once '../vendor/autoload.php';

    if ($_GET['url']){
        $url = explode('/', $_GET['url']); //Quebra url em palavras e index
        
        if ($url[0] === 'api'){
            array_shift($url);//Remova a posição [0], nesse caso, 'api'
            $service = 'App\Services\\'.ucfirst($url[0]).'Service';//Service recebe a prox / após shift (/api/user)

            array_shift($url);//Tira /user

            $method = strtolower($_SERVER['REQUEST_METHOD']);//Requisição direta de var global, em framwork é método Req,Res
            
            try{
                $response = call_user_func_array(array(new $service, $method), $url);
            
                echo json_encode(array('status' => 'sucess', 'data: '.'\n' => $response), JSON_UNESCAPED_UNICODE);
                    http_response_code(200);
                exit;
            } catch (\Exception $e){
                echo json_encode(array('status' => 'error', 'data: '.'\n' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
                 http_response_code(500);
                exit;
            }
        
        }
    }
    
