<?php

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'position_name' => 'программист',
            'position_name_case' => 'программиста'
        ]);
        Position::create([
            'position_name' => 'директор',
            'position_name_case' => 'директора'
        ]);
    }
}
