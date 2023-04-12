<?php

namespace App\Repositories\Post;

use App\Repositories\Generic\iGenericRepository;

interface iPostRepository extends iGenericRepository {

    public function getFullPost($id);
    public function jobs($search=null,$city=null);
}
