<?php

namespace App\Repositories\GroupRepository;

use Illuminate\Http\Request;

interface iGroupRepository {
    public function store(Request $request);
    public function list();
    public function join(Request $request);
    public function leave(Request $request);
    public function allGroups();
}
