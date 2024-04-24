<?php

namespace App\Implementation;

use App\Interfaces\AuthI;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Authentication implements AuthI
{
    protected $usuario =  null;

    public function authUser($data): array
    {
        if (!isset($data->email)) {
            return ["response" => ["success" => false, "message" => "El email es requerido"], "status_code" => 400];
        }
        if (!$data->email) {
            return ["response" => ["success" => false, "message" => "El email es requerido"], "status_code" => 400];
        }


        try {
            $userModel = new UserModel();
            $this->usuario = $userModel->where('email', $data->email)->first();
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrio un problema, intenta más tarde"], "status_code" => 409];
        }


        if (!isset($data->password)) {
            return ["response" => ["success" => false, "message" => "El password es requerido"], "status_code" => 400];
        }
        if (!$data->password) {
            return ["response" => ["success" => false, "message" => "El password es requerido"], "status_code" => 400];
        }

        if (strlen($data->password) < 10) {
            return ["response" => ["success" => false, "message" => "El password debe tener al menos 10 caracteres"], "status_code" => 400];
        }

        if (strlen($data->password) > 16) {
            return ["response" => ["success" => false, "message" => "El password no debe tener mas de 16 caracteres"], "status_code" => 400];
        }
        if (!preg_match("/^[^=.%]+$/", $data->password)) {
            return ["response" => ["success" => false, "message" => "El password no debe tener signos especiales"], "status_code" => 400];
        }

        if (!password_verify($data->password, $this->usuario["password"])) {
            return ["response" => ["success" => false, "message" => "Contraseña invalida"],"status_code" => 401] ;
        }
      

        return ["response" => ["success" => true, "message" => "bien"], "status_code" => 200];
    }

    public function gToken(): array
    {

        try {
            $key_jwt = getenv('KEY_SECRET_JWT');

            $payload = [
                'email' => $this->usuario["email"],
                'id_user' => $this->usuario["id_user"],
                'iat' => time(),
                'exp' => time() + 60 * 60,
            ];

            $jwt = JWT::encode($payload, $key_jwt, 'HS256');
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrio un problema, GTK-TC"], "status_code" => 409];
        }
        return ["response" => ["success" => true, "message" => "Inicio de sesion con exito", "jwt" => $jwt], "status_code" => 200];
    }

    public function vToken(RequestInterface $request)
    {
        $response = service('response');

        $authHeader = $request->getHeader('Authorization');
        if (!$authHeader) {
            return ["response" => ["success" => false, "message" => "Usuario invalido, sin autorización"], "status_code" => 401];
        }
        $token = null;
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        $key_jwt = getenv('KEY_SECRET_JWT');

        try {

            $decoded = JWT::decode($token, new Key($key_jwt, 'HS256'));
        } catch (\Exception $ex) {

            return ["response" => ["success" => false, "message" => "Usuario invalido, sin autorización"], "status_code" => 401];
        }

        return ["response" => ["success" => true], "decoded" => $decoded, "status_code" => 200];
    }
}
