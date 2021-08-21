@extends('layouts.panel')
@section('content')
  <div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nuevo departamento</h3>
            </div>
            <div class="col text-right">
              <a href="{{url('/specialties') }}" class="btn btn-sm btn-default">
                  Cancelar y volver
              </a>
            </div>
          </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach ($errors->all() as $error )
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

        <form action="{{ url('/specialties') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del departamento</label>
                <input type="text" name="name" class="form-control" value="{{old('name') }}" require>
            </div>
            <div class="form-group">
                <label for="description">Descripcion</label>
                <input type="text" name="description" class="form-control" value="{{old('description') }}" >
            </div>
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </form>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection