<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Appointment;
use App\User;

$factory->define(App\Appointment::class, function (Faker $faker) {
    
    $doctorIds = User::doctors()->pluck('id');
    $patientIds = User::patients()->pluck('id');
    
    $date = $faker->dateTimeBetween('-1 years','now');
    $schedule_date = $date->format('Y-m-d');
    $schedule_time = $date->format('H:i:s');

    $types = ['Padron','Registro','Abogado'];
    $statuses = ['Atendida','Cancelada'];
    
    return [
        'description' => $faker->sentence(5) ,
        'specialty_id'=>$faker->numberBetWeen(1, 3),
        'doctor_id' => $faker->randomElement($doctorIds),
        'patient_id' =>$faker->randomElement($patientIds),
        'scheduled_date' => $schedule_date, 
        'scheduled_time' => $schedule_time,
        'type' => $faker->randomElement($type),
        'status' =>$faker->randomElement($statuses)

    ];
});
