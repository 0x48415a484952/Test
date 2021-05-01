<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{

    /**
     * Get all models.
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Update existing model.
     * 
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Update existing model.
     *
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool;


    /**
     * Delete model by id.
     *
     * @param int $idd
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * find existing model.
     * 
     * @param int $id
     * @return Model
     */
    
    public function find(int $id, array $columns = ['*'], array $relations = [], array $appends = []): ?Model;


    /**
     * find existing model with where filtering.
     * 
     * @param int $id
     * @return Builder
     */
    public function where($compared, $comparable, array $columns = ['*']): ?Builder;

}
