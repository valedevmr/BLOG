<?php

namespace App\Interfaces;

use CodeIgniter\HTTP\RequestInterface;

interface BlogHI
{
    public function validateData(): array;
    public function insertBlog(): array;
    public function listBlogs(int $page,string $title,string $autor,string $content): array;
    public function showBlog(int $id_blog): array;
    public function validateBlog(int $id_blog): array;
    public function updateBlog(int $id_blog): array;
    public function deleteBlog(int $id_blog): array;
}
