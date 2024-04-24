<?php

namespace App\Implementation;

use App\Interfaces\AuthI;
use App\Interfaces\UserHelpI;
use App\Models\UserlModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserHelper implements UserHelpI
{
    private $data = [];
    private $correoValido = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/';

    //inicializamos la data que se recibida, para que cualquier metodo pudiera obtenerla
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function validateData(): array
    {
        if (!isset($this->data->email)) {
            return ["response" => ["success" => false, "message" => "El correo es requerido"], "status_code" => 400];
        }

        if (preg_match('/\s+$/', $this->data->email)) {
            return ["response" => ["success" => false, "message" => "El correo no debe contener espacios en blanco al inico o final"], "status_code" => 400];
        }

        if (!$this->data->email) {
            return ["response" => ["success" => false, "message" => "El email no puede ir vacio"], "status_code" => 400];
        }

        if (!preg_match($this->correoValido, $this->data->email)) {
            return ["response" => ["success" => false, "message" => "Correo invalido, solo debe tener numeros, letras, signo($) o _"], "status_code" => 400];
        }

        try {
            $usuario = model(UserModel::class)->select('*')
                ->where('email', $this->data->email)
                ->first();
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrrio un problema, intenta mas tarde FCU-GCU-TC"], "status_code" => 409];
        }

        if ($usuario) {
            return ["response" => ["success" => false, "message" => "El correo ya existe"], "status_code" => 409];
        }



        if (!isset($this->data->password)) {
            return ["response" => ["success" => false, "message" => "El password es requerido"], "status_code" => 400];
        }
        if (!$this->data->password) {
            return ["response" => ["success" => false, "message" => "El password es requerido"], "status_code" => 400];
        }

        if (strlen($this->data->password) < 10) {
            return ["response" => ["success" => false, "message" => "El password debe tener al menos 10 caracteres"], "status_code" => 400];
        }

        if (strlen($this->data->password) > 16) {
            return ["response" => ["success" => false, "message" => "El password no debe tener mas de 16 caracteres"], "status_code" => 400];
        }
        if (!preg_match("/^[^=.%]+$/", $this->data->password)) {
            return ["response" => ["success" => false, "message" => "El password no debe tener signos especiales"], "status_code" => 400];
        }

        return ["response" => ["success" => true, "message" => "Datos correctos"], "status_code" => 201];
    }
    public function insertData(): array
    {

        try {
            $user = new UserModel();
            $user->save([
                'email' => $this->data->email,
                'password' => password_hash($this->data->password, PASSWORD_BCRYPT),

            ]);
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrion un problema, intenta más tarde FID-CU-TC"], "status_code" => 409];
        }


        return ["response" => ["success" => true, "message" => "Usuario creado con exito"], "status_code" => 201];
    }
}
