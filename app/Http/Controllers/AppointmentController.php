<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\Appointment;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;

class AppointmentController extends Controller
{
    public function create(ScheduleServiceInterface $scheduleService)
    {
        $specialties = Specialty::all();

        $specialtyId = old('specialty_id');
       
        if ($specialtyId){
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        }else {
            $doctors = collect();
        }
        
        $scheduledDate = old('scheduled_date');
        $doctorId = old('doctor_id');
        if($scheduledDate && $doctorId){
            $intervals = $scheduleService->getAvailableIntervals($date,$doctorId);
        }else {
            $intervals =  null;
        }

      

        return view('appointments.create', compact('specialties','doctors','intervals'));
    }
    public function store(Request $request)
    {

        $rules = [

            'description' => 'required',
            'specialty_id' => 'exists:specialties,id',
            'doctor_id'=> 'exists:users,id',
            'scheduled_time' => 'required'

        ];
        $messages = [

            'scheduled_time.required' => 'Por favor seleccione una hora valida para su cita.'

        ];

       $this->validate($request, $rules, $messages);

        $data = $request->only([
        
            'description',
            'specialty_id',
            'doctor_id',
            'scheduled_date',
            'scheduled_time',
            'type'

        ]);
        $data['patient_id'] = auth()->id();
        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');
        Appointment::create($data);

        $notification = 'La cita se ha registrado correctamente';
        return back()->with(compact('notification'));

    }
}
