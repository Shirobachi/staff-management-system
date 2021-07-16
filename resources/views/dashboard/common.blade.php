@extends('common')

@section('content')

  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-md-3">
        <a href="{{route('dashboard')}}">
          <button type="button" class="btn {{$path=='employees' ? 'btn-success' : 'btn-outline-success'}} form-control mb-2">Employees</button>
        </a>
        <a href="{{route('managers')}}">
          <button type="button" class="btn {{$path=='managers' ? 'btn-danger' : 'btn-outline-danger'}} form-control mb-2">Managers</button>
        </a>
        <a href="{{route('departments')}}">
          <button type="button" class="btn {{$path=='departments' ? 'btn-dark' : 'btn-outline-dark'}} form-control mb-2">Departments</button>
        </a>
        <a href="{{route('titles')}}">
          <button type="button" class="btn {{$path=='titles' ? 'btn-info' : 'btn-outline-info'}} form-control mb-2">Titles</button>
        </a>
        <a href="{{route('salaries')}}">
          <button type="button" class="btn {{$path=='salaries' ? 'btn-warning' : 'btn-outline-warning'}} form-control mb-2">Salaries</button>
        </a>
      </div>
      <div class="col-12 col-md-9">
        @yield('table')
      </div>
    </div>
  </div>

@endsection