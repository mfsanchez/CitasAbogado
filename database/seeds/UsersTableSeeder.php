<?php

use Illuminate\Database\Seeder;
use App\User;

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
        'name' => 'Irina',
        'email' => 'irina@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123123'), // password
        'dni'=> '123456789',
        'address'=> '' ,
        'phone' =>'',
        'role'=> 'doctor'
        ]);
        User::create([
            'name' => 'German',
            'email' => 'German@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'), // password
            'dni'=> '123456789',
            'address'=> '' ,
            'phone' =>'',
            'role'=> 'patient'
            ]);


        factory(User::class, 50)->create();
    }
}
