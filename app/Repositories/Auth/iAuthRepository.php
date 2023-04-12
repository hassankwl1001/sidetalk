<?php

namespace App\Repositories\Auth;

interface iAuthRepository{
    
    public function login(array $attributes, $user);
    public function logout();
}