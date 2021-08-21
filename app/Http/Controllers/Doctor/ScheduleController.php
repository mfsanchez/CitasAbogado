<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\WordDay;


class ScheduleController extends Controller
{
    public function edit()
    {
        $days = [
            'Lunes', 'Martes','Miercoles',
            'Jueves','Viernes'
        ];
        return view('schedule', compact('days'));
    }

    public function store(Request $request)
    {
        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        
        
       for ($i=0; $i<5; ++$i)
       WorkDay::updateOrCreate(
            [
                'day' => $i ,
                'user_id' => auth()->id()
            ],[
                'active'=> in_array($i, $active),

                'morning_start' => $morning_start[$i],
                'morning_end'=> $morning_end[$i],
            ]
           
        );
        return back();
    }
}
