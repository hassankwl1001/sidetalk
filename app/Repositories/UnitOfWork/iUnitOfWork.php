<?php
namespace App\Repositories\UnitOfWork;

interface iUnitOfWork{

    public function gate($gate);
    public function response(array $data, $status = 200);
}