<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PositionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RequestSeeder::class);
        $this->call(SystemParametersSeeder::class);

    }
}
