<div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Descripcion</th>
                <th scope="col">Departamento</th>
                @if ($role == 'patient')
                <th scope="col">Funcionario</th>
                @elseif($role == 'doctor')
                <th scope="col">Ciudadano</th>
                @endif
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Tipo</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($pendingAppointments as $appointment)
              <tr>
                <th scope="row">
                  {{$appointment->description}}
                </th>
                <td>
                {{$appointment->specialty->name}}
                </td>
                 @if ($role == 'patient')
                <td>{{$appointment->doctor->name}}</td>
                @elseif ($role == 'doctor')
                <td>{{$appointment->patient->name}}</td>
                @endif
                <td>
                    {{$appointment->scheduled_date}}
                </td>
                <td>
                    {{$appointment->scheduled_time_12}}
                </td>
                <td>
                    {{$appointment->type}}
                </td>
                <td>
                    @if ($role == 'admin')
                        <a class="btn btn-sm  btn-primary"  title="Ver cita" 
                        href="{{ url('/appointments/'.$appointment->id) }}">
                         Ver 
                            </a> 
                    @endif 
                    
                    @if ($role == 'doctor' || $role == 'admin')
                        <form action="{{url('/appointments/'.$appointment->id. '/confirm')}}"
                            method="POST" class="d-inline-block">
                            @csrf
                            <button class="btn btn-sm btn-success" data-toggle="tooltip" type="submit" title="Confirmar cita">
                            <i class="ni ni-check-bold"></i>
                        </form>
                        <a href="{{url('/appointments/'.$appointment->id. '/cancel') }}"
                            class="btn btn-sm btn-danger">
                            <i class="ni ni-fat-delete"></i>       
                        </a>
                        @else {{---patient---}}
                        <form action="{{url('/appointments/'.$appointment->id. '/cancel') }}" 
                        method="POST" class="d-inline-block" >
                        @csrf
                       
                       <button class="btn btn-sm btn-danger" data-toggle="tooltip" type="submit" title="Cancelar cita">
                        <i class="ni ni-fat-delete"></i>
                       </button>
                 </form>
                    @endif
                
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-body">
          {{$pendingAppointments->links()}}
        </div>