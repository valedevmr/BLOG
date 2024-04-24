<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Implementation\BlogHelp;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Blog extends ResourceController
{
    public function index()
    {
        $data = $this->request->getJSON();
        $blogh = new BlogHelp($data);

        $current_page = $this->request->getGet('page') ?? 1;
        $search_title = $this->request->getGet('title') ?? '';  // Filtro para el título
        $search_author = $this->request->getGet('autor') ?? '';  // Filtro para el autor
        $search_content = $this->request->getGet('content') ?? '';
      
        $response = $blogh->listBlogs($current_page,$search_title,$search_author,$search_content);
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);


        return $this->respond($response["response"], $response["status_code"]);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////





    public function show($id_blog = null)
    {
        $data = $this->request->getJSON();
        $blogh = new BlogHelp($data);

        $response = $blogh->validateBlog($id_blog);
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);


        $response = $blogh->showBlog($id_blog);
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);


        return $this->respond($response["response"], $response["status_code"]);
    }






    ///////////////////////////////////////////////////////////////////////////////////////////




    //Ceacion de un blog
    public function create()
    {

        $data = $this->request->getJSON();
        $blogh = new BlogHelp($data);

        $response = $blogh->validateData();
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);

        $response = $blogh->insertBlog();
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);

        return $this->respond($response["response"], $response["status_code"]);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////






    //Actualizaciond e un blog mediante su id, todos los campos son obligatorios
    public function update($id_blog = null)
    {
        $data = $this->request->getJSON();
        $blogh = new BlogHelp($data);

        $response = $blogh->validateBlog($id_blog);
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);

        $response = $blogh->validateData();
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);

        $response = $blogh->updateBlog($id_blog);
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);

        return $this->respond($response["response"], $response["status_code"]);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////


    //eliminacion de un blog mediante de su id 
    public function delete($id_blog = null)
    {
        $data = $this->request->getJSON();
        $blogh = new BlogHelp($data);


        $response = $blogh->validateBlog($id_blog);
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);


        $response = $blogh->deleteBlog($id_blog);
        if (!$response["response"]["success"])
            return $this->respond($response["response"], $response["status_code"]);
        return $this->respond($response["response"], $response["status_code"]);
    }
}
