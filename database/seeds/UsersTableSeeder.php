<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Specialty;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           
            'name' => 'Manuel Felipe',
            'email' => 'hola@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'), // password
            'dni'=> '123456789',
            'address'=> '' ,
            'phone' =>'',
            'role'=> 'admin'

        ]);

        User::create([
        'name' => 'Funcianaria 1',
        'email' => 'irina@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123123'), // password
        'dni'=> '123456789',
        'address'=> '' ,
        'phone' =>'',
        'role'=> 'doctor'
        ]);
        User::create([
            'name' => 'Ciudadano 1',
            'email' => 'German@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'), // password
            'dni'=> '123456789',
            'address'=> '' ,
            'phone' =>'',
            'role'=> 'patient'
            ]);


        factory(User::class, 10)->create();
    }
}
