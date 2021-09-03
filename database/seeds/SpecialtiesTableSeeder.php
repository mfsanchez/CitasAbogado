<?php

use Illuminate\Database\Seeder;
use App\Specialty;
use App\User;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            
            'Padron',
            'Agobado',
            
        ];
       foreach ($specialties as $specialtyName) {
            $specialty = Specialty::create([
                'name' => $specialtyName
            ]);
            
            $specialty->users()->saveMany(
                factory(User::class, 2)->states('doctor')->make()
            );
        }
        // Médico Test
        User::find(2)->specialties()->save($specialty);
       
    }
}
