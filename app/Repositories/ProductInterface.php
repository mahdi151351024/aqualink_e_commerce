<?php
namespace App\Repositories;

interface ProductInterface
{

    public function create(array $data);
    public function get();
    public function update(array $data);
    public function delete($id);
    public function search($title);
}
