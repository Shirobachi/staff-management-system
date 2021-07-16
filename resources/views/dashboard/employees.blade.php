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
        <td style="text-align: center;" colspan="6">
          <i class="modalLink bi bi-plus-circle-dotted" data-bs-toggle="modal" data-bs-target="#newEmployee"></i>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Modal -->
  <div class="modal fade" id="newEmployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newEmployee">{{__('employee.new')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="add" method="POST" action="{{url()->current()}}/new">
          @csrf
          <input class="form-control mb-2" type="date" name="birthDate" placeholder="{{__('employee.birthDate')}}">
          <input class="form-control mb-2" type="text" name="firstName" placeholder="{{__('employee.firstName')}}">
          <input class="form-control mb-2" type="text" name="lastName" placeholder="{{__('employee.lastName')}}">
          <select class="form-control mb-2" name="gender">
            <option value="M">{{__('employee.male')}}</option>
            <option value="F">{{__('employee.female')}}</option>
          </select>
          <input class="form-control mb-2" type="date" name="hireDate" placeholder="{{__('employee.hireDate')}}">
        </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.close')}}</button>
          <button form="add" type="submit" class="btn btn-primary">{{__('common.add')}}</button>
        </div>
      </div>
    </div>
  </div>


@endsection