@extends('layouts.panel')
@section('content')
  <div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Nueva médico</h3>
            </div>
            <div class="col text-right">
              <a href="{{url('/doctors') }}" class="btn btn-sm btn-default">
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

        <form action="{{ url('doctors') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nombre del médico</label>
                <input type="text" name="name" class="form-control" value="{{old('name') }}" require>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" class="form-control" value="{{old('description') }}" >
            </div>
            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" name="dni" class="form-control" value="{{old('description') }}" >
            </div>
            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" class="form-control" value="{{old('description') }}" >
            </div>
            <div class="form-group">
                <label for="phone">Teléfono / móvil</label>
                <input type="text" name="phone" class="form-control" value="{{old('description') }}" >
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