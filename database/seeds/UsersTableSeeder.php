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
        //1
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

        //2
        User::create([
        'name' => 'Funcianaria Test',
        'email' => 'irina@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123123'), // password
        'dni'=> '123456789',
        'address'=> '' ,
        'phone' =>'',
        'role'=> 'doctor'
        ]);
        
        //3
        User::create([
            'name' => 'Ciudadano Test',
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
