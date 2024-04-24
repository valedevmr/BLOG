<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';



    protected $allowedFields = [
        'email',
        'password',
        'active',
        'created_at',
        'updated_at'
    ];
}
