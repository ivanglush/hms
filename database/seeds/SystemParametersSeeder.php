<?php

use App\Enums\SystemParameters;
use Illuminate\Database\Seeder;

class SystemParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\SystemParameters::create([
            'name' => SystemParameters::ORGANISATION_NAME,
            'value' => "ООО \"Дженерал Софт\""
        ]);
        App\Models\SystemParameters::create([
            'name' => SystemParameters::DIRECTOR_FULL_NAME,
            'value' => "Пальчик А. В"
        ]);
        App\Models\SystemParameters::create([
            'name' => SystemParameters::MAX_HOLIDAY_DURATION,
            'value' => 40
        ]);
        App\Models\SystemParameters::create([
            'name' => SystemParameters::MIN_HOLIDAY_DURATION,
            'value' => 20
        ]);
    }
}
