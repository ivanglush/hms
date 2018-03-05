<?php

namespace App\Console\Commands;

use App\Enums\RequestState;
use App\Enums\Roles;
use App\Mail\ShortHolidayDuration;
use App\Models\Request;
use App\Models\RequestHistory;
use App\Models\SystemParameters;
use App\Repository\SystemParametersRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckHolidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:holidays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for checking the total duration of holidays';

    private $userRepository;
    private $systemParametersRepository;
    /**
     * Create a new command instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, SystemParametersRepository $systemParametersRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->systemParametersRepository = $systemParametersRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->userRepository->getNotBlocked();
        $leaders = $this->userRepository->getLeaders();
        $minHolidayDuration = $this->systemParametersRepository->getMinHolidayDuration();
        foreach ($users as $user) {
            $usedDays = $this->userRepository->getUsedDaysForYear($user, Carbon::today()->year);
            if ($usedDays < $minHolidayDuration) {
                $url = route('statistics', ['id' => $user->id]);
                //Mail::to($user)->send(new ShortHolidayDuration($url,  Roles::EMPLOYEE));
                //Mail::to($leaders)->send(new ShortHolidayDuration($url,  Roles::LEADER));//?
                $this->info($usedDays.' '.$url);
            }
        }
    }
}
