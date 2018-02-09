<?php

use App\Enums\RequestState;
use App\Models\Request;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{

    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Factory::create("ru_RU");
        $users_count = User::count();
        for ($i = 0; $i < 10; $i ++) {
            $this->generateRequest($users_count);
        }
    }

    private function generateRequest($users_count)
    {
        $request = new Request();

        $firstDate = $this->faker->dateTimeBetween("2018-01-01", "2018-12-31");
        $secondDate = $this->faker->dateTimeBetween($firstDate, "2018-12-31");
        $request->start_date = $firstDate;
        $request->end_date = $secondDate;
        $request->comment = $this->faker->paragraph;
        $request->request_state = $this->faker->randomElement(RequestState::getAll());

        $user = User::find(rand(1, $users_count));

        $user->requests()->save($request);

        return $request;
    }
}
