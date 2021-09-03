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
           
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'), // password
            'dni'=> '123456789',
            'address'=> '' ,
            'phone' =>'',
            'role'=> 'admin'

        ]);

        //2
        User::create([
        'name' => 'Abogado ',
        'email' => 'abogado@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123123'), // password
        'dni'=> '123456789',
        'address'=> '' ,
        'phone' =>'',
        'role'=> 'doctor'
        ]);
         User::create([
        'name' => 'Padron',
        'email' => 'padron@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123123'), // password
        'dni'=> '123456789',
        'address'=> '' ,
        'phone' =>'',
        'role'=> 'doctor'
        ]);
        
        //3
        User::create([
            'name' => 'Ciudadano',
            'email' => 'ciudadano@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'), // password
            'dni'=> '123456789',
            'address'=> '' ,
            'phone' =>'',
            'role'=> 'patient'
            ]);


        factory(User::class, 0)->create();
    }
}
