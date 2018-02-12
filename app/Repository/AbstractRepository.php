<?php

namespace App\Repository;


use App\Models\BaseModel;

class AbstractRepository
{
    protected $baseModel;

    public function __construct($baseModel)
    {
        $this->baseModel = app($baseModel);
    }

    public function save(BaseModel $entity)
    {
        $entity->push();
    }

    public function update(BaseModel $entity)
    {
        $entity->update();
    }

    public function get($id)
    {
        return $this->baseModel->query()->find($id);
    }

    public function delete($id)
    {
        $this->baseModel->destroy($id);
    }

    public function getAll()
    {
        return $this->baseModel->query()->get();
    }
}