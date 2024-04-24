<?php

namespace App\Interfaces;

use CodeIgniter\HTTP\RequestInterface;

interface UserHelpI
{
    public function validateData():array;
    public function insertData():array;
}