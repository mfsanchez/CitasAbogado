<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    protected $fillable = [

        'description',
        'specialty_id',
        'doctor_id',
        'patient_id',
        'scheduled_date',
        'scheduled_time',
        'specialty_id',
        'type'

    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Specialty::class);
    }
    public function patient()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function cancellation()
    {
        return $this->hasOne(CancelledAppointment::class);
    }

    //accesor
    // $appointment->scheduled_time_12

    public function getScheduledTime12Attribute()
    {
        return (new Carbon($this->scheduled_time))
            ->format('g:i A');
    }

}
