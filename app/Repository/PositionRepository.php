<?php
/**
 * Created by PhpStorm.
 * User: Vano
 * Date: 19.02.2018
 * Time: 21:24
 */

namespace App\Repository;


use App\Models\Position;

class PositionRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Position::class);
    }
}