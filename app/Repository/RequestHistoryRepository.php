<?php
/**
 * Created by PhpStorm.
 * User: Vano
 * Date: 19.02.2018
 * Time: 21:22
 */

namespace App\Repository;


use App\Models\RequestHistory;

class RequestHistoryRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(RequestHistory::class);
    }
}