<?php
/**
 * Created by PhpStorm.
 * User: Vano
 * Date: 19.02.2018
 * Time: 21:20
 */

namespace App\Repository;

use App\Enums\RequestState;
use App\Enums\Roles;
use App\Models\BaseModel;
use App\Models\User;
use Carbon\Carbon;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function updateFields(BaseModel $entity, array $values = null)
    {
        $entity->update($values);
    }

    public function getLeadersCount()
    {
        return $this->baseModel->where('role', '=', 'leader')->count();
    }

    public function orderBy($field)
    {
        return $this->baseModel->orderBy($field)->paginate(10);
    }

    public function getUsedDaysForYear(User $user, $year)
    {
        $requests = $user->requests()->where('request_state', '=', RequestState::ACCEPTED)->whereYear('start_date', $year)->get();
        $usedDays = 0;
        foreach ($requests as $request) {
            $usedDays += Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date));
        }

        return $usedDays;
    }

    public function getNotBlocked()
    {
        return $this->baseModel->where('is_blocked', 0)->get();
    }

    public function getLeaders()
    {
        return $this->baseModel->where('role', Roles::LEADER)->get();
    }

}