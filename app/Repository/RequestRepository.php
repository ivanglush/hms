<?php
/**
 * Created by PhpStorm.
 * User: Vano
 * Date: 19.02.2018
 * Time: 21:23
 */

namespace App\Repository;


use App\Models\BaseModel;
use App\Models\Request;

class RequestRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Request::class);
    }

    public function getAllByState($state)
    {
        return $this->baseModel->where('request_state', $state)->paginate(10);
    }

    public function getAllByUserId($id)
    {
        return $this->baseModel->where('user_id', $id)->paginate(10);
    }

    public function updateFields(BaseModel $entity, array $values = null)
    {
        $entity->update($values);
    }
}