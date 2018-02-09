<?php

use App\Enums\Roles;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
        for ($i = 0; $i < 5; $i++) {
            $user = $this->generateUser();
            $user->save();
        }

    }

    private function generateUser($email = null, $role = null, $position_id = null)
    {
        $user = new User();
        $user->email = isset($email) ? $email : $this->faker->unique()->email;
        $user->password = "password";
        $user->full_name = $this->faker->name;
        $user->full_name_case = $user->full_name . 'а';
        $user->address = $this->faker->address;
        $user->position_id = isset($position_id) ? $position_id : rand(1, 2);
        $user->role = isset($role) ? $role : Roles::EMPLOYEE;
        return $user;
    }
}
