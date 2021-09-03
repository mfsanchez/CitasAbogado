<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;
use App\Appointment;
use App\CancelledAppointment;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;


class AppointmentController extends Controller
{
    public function index()
    {

        $role = auth()->user()->role;

        if ($role == 'admin')  
        {
        
        $pendingAppointments = Appointment::where('status', 'Reservada')
                ->paginate(10);
        $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->paginate(10);
        $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->paginate(10);            


        }elseif ($role == 'doctor')
        {

        $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('doctor_id', auth()->id())
                ->paginate(10);
        $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('doctor_id', auth()->id())
                ->paginate(10);
        $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('doctor_id', auth()->id())
                ->paginate(10);            

        }elseif ($role == 'patient')
        {

        $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('patient_id', auth()->id())
                ->paginate(10);
        $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('patient_id', auth()->id())
                ->paginate(10);
        $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('patient_id', auth()->id())
                ->paginate(10);
        }
           
        return view('appointments.index', 
            compact(
                'pendingAppointments', 'confirmedAppointments', 'oldAppointments'
                ,'role')
        );
    }

    public function show (Appointment $appointment)
    {
       $role = auth()->user()->role;
       return view('appointments.show', compact('appointment', 'role'));
    }

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
        
        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if($date && $doctorId){
            $intervals = $scheduleService->getAvailableIntervals($date,$doctorId);
        }else {
            $intervals =  null;
        }

        return view('appointments.create', compact('specialties','doctors','intervals'));
    }
    public function store(Request $request, ScheduleServiceInterface $scheduleService)
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

    public function showCancelForm(Appointment $appointment)
    {
        if ($appointment->status == 'Confirmada'){

            $role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment','role'));
        }
        

        return redirect('/appointments');
    }

    public function postCancel(Appointment $appointment, Request $request)
    {
        if ($request->has('justification')){

            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by = auth()->id();


            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'Cancelada';
        $appointment->save();

        $notificacion = 'La cita se ha cancelado correctamente.';
        return redirect('/appointments')->with(compact('notificacion'));
    }
     public function postConfirm(Appointment $appointment)
    {
        

        $appointment->status = 'Confirmada';
        $appointment->save();

        $notificacion = 'La cita se ha confirmado correctamente.';
        return redirect('/appointments')->with(compact('notificacion'));
    }
}
