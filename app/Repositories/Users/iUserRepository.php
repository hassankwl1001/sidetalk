<?php
namespace App\Repositories\Users;

use App\Repositories\Generic\iGenericRepository;

interface iUserRepository extends iGenericRepository{

    public function validateUser($email);
    
}