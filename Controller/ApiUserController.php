<?php

require_once "Model/FeaturedModel.php";
require_once "View/ApiView.php";
require_once "Helpers/AuthApiHelper.php";

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class ApiUserController {
    //private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
       // $this->model = new FeaturedModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function obtenerToken($params = null) {
        // Obtener "Basic base64(user:pass)
        $basic = $this->authHelper->getAuthHeader();
        
        if(empty($basic)){
            $this->view->response('No autorizado', 401);
            return;
        }
        $basic = explode(" ",$basic); // ["Basic" "base64(user:pass)"]
        if($basic[0]!="Basic"){
            $this->view->response('La autenticación debe ser Basic', 401);
            return;
        }

        //validar usuario:contraseña
        $userpass = base64_decode($basic[1]); // user:pass
        $userpass = explode(":", $userpass);
        $user = $userpass[0];
        $pass = $userpass[1];
        if($user == "Luciano" && $pass == "ok"){
            //  crear un token
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => 1,
                'name' => "Luciano",
                'exp' => time()+3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac('SHA256', "$header.$payload", "Clave1234", true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
            $this->view->response($token, 200);
        }else{
            $this->view->response('No autorizado', 401);
        }
    }


}

  


