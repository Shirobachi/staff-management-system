@extends('common')

@section('content')

  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-md-3">
        <a href="{{route('employees')}}">
          <button type="button" class="btn {{$path=='employees' ? 'btn-success' : 'btn-outline-success'}} form-control mb-2">{{__('common.employees')}}</button>
        </a>
        <a href="{{route('managers')}}">
          <button type="button" class="btn {{$path=='managers' ? 'btn-danger' : 'btn-outline-danger'}} form-control mb-2">{{__('common.managers')}}</button>
        </a>
        <a href="{{route('departments')}}">
          <button type="button" class="btn {{$path=='departments' ? 'btn-success' : 'btn-outline-success'}} form-control mb-2">{{__('common.departments')}}</button>
        </a>
        <a href="{{route('titles')}}">
          <button type="button" class="btn {{$path=='titles' ? 'btn-info' : 'btn-outline-info'}} form-control mb-2">{{__('common.titles')}}</button>
        </a>
        <a href="{{route('salaries')}}">
          <button type="button" class="btn {{$path=='salaries' ? 'btn-warning' : 'btn-outline-warning'}} form-control mb-2">{{__('common.salaries')}}</button>
        </a>
      </div>
      <div class="col-12 col-md-9">
        @yield('table')
      </div>
    </div>
  </div>

@endsection