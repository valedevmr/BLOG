<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Implementation\Authentication;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    private $auth = null;

    public function __construct()
    {
        $this->auth  = new Authentication();
    }

    public function auth()
    {
        $data = $this->request->getJSON();



        $responseH = $this->auth->authUser($data);
        if (!$responseH["response"]["success"])
            return $this->respond($responseH["response"], $responseH["status_code"]);


        $responseH = $this->auth->gToken();
        if (!$responseH["response"]["success"])
            return $this->respond($responseH["response"], $responseH["status_code"]);

        return $this->respond($responseH["response"], $responseH["status_code"]);
    }
}
