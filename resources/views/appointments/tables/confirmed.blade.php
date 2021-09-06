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
                @foreach ($confirmedAppointments as $appointment)
              <tr>
                <th scope="row">
                  {{$appointment->description}}
                </th>
                <td>
                {{$appointment->specialty->name}}
                </td>
                @if ($role == 'patient')
                <td>{{$appointment->patient->name}}</td>
                @elseif ($role == 'doctor')
                <td>{{$appointment->doctor->name}}</td>
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
                <a class="btn  btn-primary"  title="Ver cita" 
                    href="{{ url('/appointments/'.$appointment->id) }}">
                     Ver 
                 </a> 
                @endif               
                <a class="btn  btn-danger"  title="Cancelar cita" 
                    href="{{ url('/appointments/'.$appointment->id. '/cancel') }}">
                     Cancelar
                 </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
         <div class="card-body">
          {{ $confirmedAppointments->links() }}
        </div>