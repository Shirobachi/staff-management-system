@extends('dashboard.common')

@section('title', 'Employees')

@section('table')

<div class="accordion-item">
  <h2 class="accordion-header">
    <button class="accordion-button collapsed" aria-expanded="true" type="button" data-bs-toggle="collapse" data-bs-target="#filter">
      Filters
    </button>
  </h2>
  <div id="filter" class="accordion-collapse collapse">
    <div class="accordion-body">

      <form method="POST">
        @csrf
        <!-- Type of employee -->
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-3 pt-0">{{__('employees.employeeType')}}:</legend>
          <div class="col-sm-9">
            
          <div class="form-check form-switch">
            <label class="d-block">
              <input class="form-check-input" type="checkbox" name="currentEmployee" checked>
              {{__('employees.currentEmployee')}}
            </label>
            <label class="d-block">
              <input class="form-check-input" type="checkbox" name="pastEmployee" checked>
              {{__('employees.pastEmployee')}}
            </label>
          </div>
        </fieldset>

        <!-- Gender of employee -->
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-3 pt-0">{{__('employees.gender')}}:</legend>
          <div class="col-sm-9">
            
          <div class="form-check form-switch">
            <label class="d-block">
              <input class="form-check-input" type="checkbox" name="male" value="M" checked>
              {{__('employees.male')}}
            </label>
            <label class="d-block">
              <input class="form-check-input" type="checkbox" name="female" value="F" checked>
              {{__('employees.female')}}
            </label>
          </div>
        </fieldset>

        <!-- Employee's salary -->
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-3 pt-0">{{__('employees.salary')}}:</legend>
          <div class="col-sm-9">
            
          <div class="input-group">
            <input class="form-control d-flex" type="number" min="1" name="salaryMin" placeholder="{{__('employees.salaryMin')}}">
            <span class="input-group-text"> - </span>
            <input class="form-control d-flex" type="number" min="1" name="salaryMax" placeholder="{{__('employees.salaryMax')}}">
          </div>

        </fieldset>

        <!-- Employee's dept -->
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-3 pt-0">{{__('employees.dept')}}:</legend>
          <div class="col-sm-9">
            
          <select class="form-select mb-2" name="deptNo">
            <option value="NULL">{{__('employees.noFilterByDept')}}</option>
            @foreach($data['departments'] as $e)
              <option value="{{$e['value']}}">{{$e['name']}}</option>
            @endforeach
          </select>

        </fieldset>

        <button type="submit" class="btn btn-success mb-2 form-control">{{__('employees.search')}}</button>
      </form>

    </div>
  </div>
</div>

  <table class="table table-primary table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('employees.birthDate')}}</th>
        <th scope="col">{{__('employees.firstName')}}</th>
        <th scope="col">{{__('employees.lastName')}}</th>
        <th scope="col">{{__('employees.gender')}}</th>
        <th scope="col">{{__('employees.hireDate')}}</th>
        <th scope="col">{{__('employees.dept')}}</th>
        <th scope="col">{{__('employees.title')}}</th>
        <th scope="col">{{__('employees.salary')}}</th>
        <th scope="col"><i class="bi bi-gear-fill"></i></th>
      </tr>
    </thead>
    <tbody>
      @foreach($data['body'] as $d)
      <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->birthDate}}</td>
        <td>{{$d->firstName}}</td>
        <td>{{$d->lastName}}</td>
        <td>{{$d->gender == "M" ? __('employees.male') : __('employees.female')}}</td>
        <td>{{$d->hireDate}}</td>
        <td>{{$d->dept}}</td>
        <td>{{$d->title}}</td>
        <td>{{$d->salary}}</td>
        <td>
          <i class="modalLink bi bi-pencil" data-bs-toggle="modal" data-bs-target="#edit{{$d->id}}"></i>
          <a class="iconNoDecoration" href="{{url()->current()}}/delete/{{$d->id}}">
            <i class="text-danger bi bi-trash"></i>
          </a>
          <a class="iconNoDecoration" href="{{url()->current()}}/show/{{$d->id}}">
            <i class="text-success bi bi-eye" data-bs-toggle="tooltip" data-bs-placement="left" title="{{__('employees.show')}}"></i>
          </a>
          <a class="iconNoDecoration" href="{{url()->current()}}/download/{{$d->id}}">
            <i class="text-secondary bi bi-file-earmark-arrow-down" data-bs-toggle="tooltip" data-bs-placement="left" title="{{__('employees.download')}}"></i>
          </a>
        </td>
      </tr>
      @endforeach
      <tr>
        <td style="text-align: center;" colspan="10">
          <i class="modalLink bi bi-plus-circle-dotted" data-bs-toggle="modal" data-bs-target="#new"></i>
        </td>
      </tr>
    </tbody>
  </table>

  <!-- Modal new -->
  <div class="modal fade" id="new" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{__('employees.new')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="newForm" method="POST" action="{{url()->current()}}/new">
          @csrf
          <input class="form-control mb-2" type="date" name="birthDate" placeholder="{{__('employees.birthDate')}}">
          <input class="form-control mb-2" type="text" name="firstName" placeholder="{{__('employees.firstName')}}">
          <input class="form-control mb-2" type="text" name="lastName" placeholder="{{__('employees.lastName')}}">
          <select class="form-select mb-2" name="gender">
            <option value="M">{{__('employees.male')}}</option>
            <option value="F">{{__('employees.female')}}</option>
          </select>
          <input class="form-control mb-2" type="date" name="hireDate" placeholder="{{__('employees.hireDate')}}">
        </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.close')}}</button>
          <button form="newForm" type="submit" class="btn btn-primary">{{__('common.add')}}</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modals edit -->
  @foreach($data['body'] as $d)
  <div class="modal fade" id="edit{{$d->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{__('employees.edit')}} {{$d->firstName}} {{$d->lastName}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm{{$d->id}}" method="POST" action="{{url()->current()}}/edit/{{$d->id}}">
            @csrf
            <input class="form-control mb-2" type="date" name="birthDate" placeholder="{{__('employees.birthDate')}}" value="{{$d->birthDate}}">
            <input class="form-control mb-2" type="text" name="firstName" placeholder="{{__('employees.firstName')}}" value="{{$d->firstName}}">
            <input class="form-control mb-2" type="text" name="lastName" placeholder="{{__('employees.lastName')}}" value="{{$d->lastName}}">
            <select class="form-select mb-2" name="gender">
              <option {{$d->gender == "M" ? 'selected' : ''}} value="M">{{__('employees.male')}}</option>
              <option {{$d->gender == "F" ? 'selected' : ''}} value="F">{{__('employees.female')}}</option>
            </select>
            <input class="form-control mb-2" type="date" name="hireDate" placeholder="{{__('employees.hireDate')}}" value="{{$d->hireDate}}">
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.close')}}</button>
          <button form="editForm{{$d->id}}" type="submit" class="btn btn-primary">{{__('common.edit')}}</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

@endsection