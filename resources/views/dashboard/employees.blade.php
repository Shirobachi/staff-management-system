@extends('dashboard.common')

@section('title', 'Employees')

@section('table')

  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('employee.birthDate')}}</th>
        <th scope="col">{{__('employee.firstName')}}</th>
        <th scope="col">{{__('employee.lastName')}}</th>
        <th scope="col">{{__('employee.gender')}}</th>
        <th scope="col">{{__('employee.hireDate')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d)
      <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->birthDate}}</td>
        <td>{{$d->firstName}}</td>
        <td>{{$d->lastName}}</td>
        <td>{{$d->gender == "M" ? __('employee.male') : __('employee.female')}}</td>
        <td>{{$d->hireDate}}</td>
      </tr>
      @endforeach
      <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
      </tr>
      <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
        <td>1</td>
      </tr>
    </tbody>
  </table>

@endsection