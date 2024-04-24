<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table            = 'blogs';
    protected $primaryKey       = 'id_blog';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
   



    protected $allowedFields = [
        'title',
        'autor',
        'content',
        'deleted',
        'publication_date',
        'updated_at',
        'id_user'
    ];
}
