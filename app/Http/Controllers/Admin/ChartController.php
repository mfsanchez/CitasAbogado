<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Appointment;
use DB;

use App\User;

class ChartController extends Controller
{
    public function appointments()
    {
        
             $monthlyCounts = Appointment::select(
                DB::raw('MONTH(created_at) as month'), 
                DB::raw('COUNT(1) as count'))
                ->groupBy('month')->get()->toArray();

                $counts = array_fill(0,12,0);   //posicion, cuantos valores, valor para usar
                foreach ($monthlyCounts as $monthlyCounts)
                {
                    $index = $monthlyCounts['month']-1;
                    $counts[$index] = $monthlyCounts['count'];
                }

            
            return view('charts.appointments', compact('counts'));
    }
    public function doctors()
    {
        return view ('charts.doctors');
    }
    public function doctorsJson()
    {

        $user = User::doctors()
            ->select('id','name')
            ->withCount([
                'attendedAppointments',
                'asDoctorAppointments'
            ])
            ->orderBy('attendedAppointments', 'desc')
            ->take(3)
            ->get(); 


        $data = [];
        $data ['categories'] = $doctors->pluck('name');
        
        $series = [];
         //Atendidas

        $series1['name'] = 'Citas atendidas';
        $series1['data'] = $doctors->pluck('attended_appointments_count'); 
         //Canceladas
        $series2['name'] = 'Citas canceladas';
        $series2['data'] = $doctors->pluck('cancelled_appointments_count');   
       
        $series[] = $series1;
        $series[] = $series2;
        
        $data['series'] = $series;

        return $data;
        
    }
}
