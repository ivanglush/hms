<?php
/**
 * Created by PhpStorm.
 * User: Vano
 * Date: 10.02.2018
 * Time: 15:39
 */

namespace App\Repository;


use App\Models\SystemParameters;

class SystemParametersRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(SystemParameters::class);
    }
}