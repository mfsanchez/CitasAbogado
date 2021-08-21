<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;


class PatientController extends Controller
{
   
    public function index()
    {
        $patients = User::patients()->paginate(8);
        return view('patients.index', compact('patients'));
    }

   
    public function create()
    {
        return view('patients.create');
    }

    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email'=> 'required|email',
            'dni' => 'nullable|digits:8',
            'address'=> 'nullable|min:5',
            'phone'=> 'nullable|min:6'
        ];
        $this->validate($request, $rules);
       
        User::create(
            $request->only('name','email','dni','address','phone')
            + [
                'role'=> 'patient',
                'password'=> bcrypt($request->input('password'))
            ]
        );
        $notification = ' El ciudadano se ha registrado correctametne.  ';
        return redirect('/patients')->with(compact('notification'));
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit(User $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email'=> 'required|email',
            'dni' => 'nullable|digits:8',
            'address'=> 'nullable|min:5',
            'phone'=> 'nullable|min:6'
        ];
        $this->validate($request, $rules);
       
        $user = User::patients()->findOrFail($id);

        $data = $request->only('name','email','dni','address','phone');
        $password = $request->input('password');
        if($password)
            $data['password']=bcrypt($password);

        $user->fill($data);
        $user->save();

        $notification = ' La informacion del ciudadano se ha actualizado correctametne.  ';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();

        $notification = " El ciudadano $patientName se ha eliminado correctamente. ";
        return redirect('/patients')->with(compact('notification'));

    }
}
