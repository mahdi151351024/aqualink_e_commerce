<?php
namespace App\Repositories;

interface AuthInterface {

    public function loginUser(array $data);
}