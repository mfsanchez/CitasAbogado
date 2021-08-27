<?php

use Illuminate\Database\Seeder;

use App\WorkDay;

class WorkDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<5; ++$i){
            WorkDay::create([
            'day' => $i,
            'active' =>($i==3) , //Thusday
            'morning_start' =>($i==3 ? '09:00:00' : '09:00:00'),
            'morning_end' => ($i==3 ? '14:00:00' : '09:00:00'),
            'user_id' => 3 //Medico Test (UsersTableSeeder)

            ]);
        }
    }
}
