<?php
namespace app\Repositories\Generic;

use App\Repositories\Generic\iGenericRepository;
use Illuminate\Database\Eloquent\Model;


class GenericRepository implements iGenericRepository{

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function getCustom(array $relations = array(), array $columns = ['*'], array $conditions = array(), $get = 100){

        return $this->model->with($relations)->select($columns)->where($conditions)->orderBy('id', 'desc')->paginate($get);
        
    }

    public function getByIdWithRelations(array $relations = array(), $id){

        return $this->model->with($relations)->find( $id);
    }

    public function find(array $conditions, $get = 10, $first = null){
        if($first == null){
            return $this->model->where($conditions)->paginate($get);
        }else{
            return $this->model->where($conditions)->first();
        }
        
    }

    public function getById($id){

        return $this->model->find($id);
    }

    public function create(array $attributes){
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes){
        $model = $this->model->find($id)->update($attributes);
        return $model;
    }

    public function delete($id){
        $entity = $this->getById($id);
        if($entity->delete()){
            return true;
        }else{
            return false;
        }
    }

}