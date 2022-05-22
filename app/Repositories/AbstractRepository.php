<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function save(array $data): void
    {
        $this->model->create($data);
    }

    public function getById(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function delete(int $id): void
    {
        $model = $this->getById($id);
        $model->delete();
    }

    public function update(int $id, array $updateData): void
    {
        $this->model->where('id', $id)->update($updateData);
    }
}
