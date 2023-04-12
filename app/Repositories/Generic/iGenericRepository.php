<?php
namespace app\Repositories\Generic;


interface iGenericRepository{

    public function getModel();
    
    public function getAll();

    public function find(array $conditions, $get, $first);

    public function getById($id);

    public function getCustom(array $relations = array(), array $columns = ['*'], array $conditions = array(), $limit = null);

    public function getByIdWithRelations(array $relations = array(), $id);
    
    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id); 
}