<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Implementation\UserHelper;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    public function create()
    {
        $data = $this->request->getJSON();
        $uHelper = new UserHelper($data);

        $responseH = $uHelper->validateData();
        if (!$responseH["response"]["success"]) {
            return $this->respond($responseH["response"], $responseH["status_code"]);
        }


        $responseH = $uHelper->insertData();
        if (!$responseH["response"]["success"]) {
            return $this->respond($responseH["response"], $responseH["status_code"]);
        }

        return $this->respond($responseH["response"], $responseH["status_code"]);
    }
}
