<?php

namespace App\Implementation;

use App\Interfaces\AuthI;
use App\Interfaces\BlogHI;
use App\Interfaces\UserHelpI;
use App\Models\BlogModel;
use App\Models\UserlModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class BlogHelp implements BlogHI
{
    private $data = [];


    //inicializamos la data que se recibida, para que cualquier metodo pudiera obtenerla
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function validateData(): array
    {
        if (!isset($this->data->title)) {
            return ["response" => ["success" => false, "message" => "El titulo es requerido"], "status_code" => 400];
        }
        if (!$this->data->title) {
            return ["response" => ["success" => false, "message" => "El titulo es requerido"], "status_code" => 400];
        }

        if (!isset($this->data->autor)) {
            return ["response" => ["success" => false, "message" => "El autor es requerido"], "status_code" => 400];
        }
        if (!$this->data->autor) {
            return ["response" => ["success" => false, "message" => "El autor es requerido"], "status_code" => 400];
        }

        if (!isset($this->data->content)) {
            return ["response" => ["success" => false, "message" => "El content es requerido"], "status_code" => 400];
        }
        if (!$this->data->content) {
            return ["response" => ["success" => false, "message" => "El content es requerido"], "status_code" => 400];
        }


        return ["response" => ["success" => true, "message" => "Blog creado con exito"], "status_code" => 201];
    }



    public function insertBlog(): array
    {

        try {
            $user = new BlogModel();
            $user->save([
                'title' => $this->data->title,
                'autor' => $this->data->autor,
                'content' => $this->data->content,
                'id_user' => $this->data->id_user,

            ]);
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrion un problema, intenta más tarde FH-IB-TC"], "status_code" => 409];
        }


        return ["response" => ["success" => true, "message" => "Blog creado con exito"], "status_code" => 201];
    }





    public function updateBlog(int $id_blog): array
    {

        try {
            model(BlogModel::class)->where('id_blog', $id_blog)->set([
                'title' => $this->data->title,
                'autor' => $this->data->autor,
                'content' => $this->data->content,
                'id_user' => $this->data->id_user,
            ])->update();
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrió un problema, intenta más tarde FH-UB-TC"], "status_code" => 409];
        }

        return ["response" => ["success" => true, "message" => "Blog actualizado con exito"], "status_code" => 200];
    }



    ///////////////////////////////////////////////////////////////////////////////////////



    public function deleteBlog(int $id_blog): array
    {
        try {
            model(BlogModel::class)
                ->where('id_blog', $id_blog)
                ->set([
                    'deleted' => 1
                ])->update();
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrió un problema, intenta más tarde FH-DB-TC"], "status_code" => 409];
        }

        return ["response" => ["success" => true, "message" => "Se elimino con exito el blog"], "status_code" => 200];
    }



    //////////////////////////////////////////////////////////////////////////////////////////////77



    public function validateBlog(int $id_blog): array
    {

        if (!$id_blog) {
            return ["response" => ["success" => false, "message" => "El blog es requerida"], "status_code" => 409];
        }
        if (!is_numeric($id_blog)) {
            return ["response" => ["success" => false, "message" => "El blog es debe ser de tipo numerico"], "status_code" => 409];
        }

        try {
            $usuario = model(BlogModel::class)->select('*')
                ->where('id_blog', $id_blog)
                ->where("deleted", 0)
                ->first();
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrrio un problema, intenta mas tarde VH-VB-TC"], "status_code" => 409];
        }

        if (!$usuario) {
            return ["response" => ["success" => false, "message" => "El blog no existe"], "status_code" => 404];
        }

        return ["response" => ["success" => true, "message" => "El blog existe"], "status_code" => 200];
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////




    public function listBlogs(int $current_page = 1, string $title, string $autor, string $content): array
    {




        $per_page = 10;
        $offset = ($current_page - 1) * $per_page;
        $db = \Config\Database::connect();  // Conecta a la base de datos

        try {
            $query = $db->table('blogs')
                ->select('id_blog,title, autor, SUBSTRING(content, 1, 70) AS content ,publication_date')
                ->where("deleted", 0)

                ->where("id_user",  $this->data->id_user)
                ->orderBy('publication_date', 'DESC')
                ->limit($per_page, $offset);  // Limitar resultados por página



            if ($title) {
                $query->like('title', $title);
            } else if ($autor) {
                $query->like('autor', $autor);
            } else if ($content) {
                $query->like('content', $content);
            }

            $result_set = $query->get();
            $results = $result_set->getResult();
            $query_base = $db->table('blogs')
                ->where("deleted", 0)
                ->where("id_user",  $this->data->id_user);

            // Añadir condiciones adicionales según sea necesario
            if ($title) {
                $query_base->like('title', $title);
            } else if ($autor) {
                $query_base->like('autor', $autor);
            } else if ($content) {
                $query_base->like('content', $content);
            }

            // Contar el total de filas
            $total_rows = $query_base->countAllResults();
          

            // Obtener el número total de resultados
            
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrió un problema, intenta más tarde, FH-LB-TC"], "status_code" => 409];
        }

        return [
            "response" => [
                "success" => true,
                "message" => "Blogs existentes",
                "data" => $results,
                "pagination" => [
                    "total_rows" => $total_rows,  // Número total de resultados
                    "per_page" => $per_page,  // Resultados por página
                    "current_page" => $current_page,  // Página actual
                    "total_pages" => ceil($total_rows / $per_page),  // Total de páginas
                    "previous_page" => $current_page == 1 ? 1 : $current_page - 1,
                    "next_page" => ceil($total_rows / $per_page) == $current_page ? $current_page : $current_page + 1
                ],
            ],
            "status_code" => 200,
        ];
    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    public function showBlog(int $id_blog): array
    {

        try {

            $blog = model(BlogModel::class)->select('*')
                ->where('id_user', $this->data->id_user)
                ->where('deleted', 0)
                ->where('id_blog', $id_blog)
                ->first();
        } catch (\Throwable $th) {
            return ["response" => ["success" => false, "message" => "Ocurrió un problema, intenta más tarde FH-SB-TC"], "status_code" => 409];
        }

        if (!$blog) {
            return ["response" => ["success" => false, "message" => "El blog no existe"], "status_code" => 404];
        }
        return ["response" => ["success" => true, "message" => "Blog encontrado", "data" => $blog], "status_code" => 200];
    }
}
