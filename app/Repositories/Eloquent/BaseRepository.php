<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

/**
* Class BaseRepository
* @package App\Repositories
*/
class BaseRepository implements EloquentRepositoryInterface
{
    /**  
     * @var Model
     */     
    protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }
 
    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $model = $this->model->create($attributes);
        return $model->fresh();
    }

    /**
     * @param array $attributes
     *
     * @param $id
     * 
     * @return Model
     */
    public function update($id, array $attributes): bool
    {
        $model = $this->find($id);
        return $model->update();
    }

    /**
     * @param $id
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function find(int $id, array $columns = ['*'], array $relations = [], array $appends = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($id)->append($appends);
    }


    /**
     * @param $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }


    /**
     * @param $id
     * @param array $columns
     * @param array $relations
     * @return Builder
     */
    public function where($compared, $comparable, array $columns = ['*']): ?Builder
    {
        return $this->model->select($columns)->where($compared, $comparable);
    }

}
