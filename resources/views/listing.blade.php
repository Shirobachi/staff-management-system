@extends('common')

@section('title', $title == null ? ucfirst($name) : $title)

@section('content')

  <div class="container-fluid mt-5">
    <div class="row mb-5">
      <div class="col-12 col-md-3">
        <a href="{{route('employees')}}">
          <button type="button" class="btn {{$name=='employees' ? 'btn-' . env('EMPLOYEES_COLOR' , 'primary') : 'btn-outline-' . env('EMPLOYEES_COLOR' , 'primary')}} form-control mb-2">{{__('common.employees')}}</button>
        </a>
        <a href="{{route('deptManagers')}}">
          <button type="button" class="btn {{$name=='deptManagers' ? 'btn-' . env('DEPTMANAGERS_COLOR' , 'primary') : 'btn-outline-' . env('DEPTMANAGERS_COLOR' , 'primary')}} form-control mb-2">{{__('common.deptManagers')}}</button>
        </a>
        <a href="{{route('departments')}}">
          <button type="button" class="btn {{$name=='departments' ? 'btn-' . env('DEPARTMENTS_COLOR' , 'primary') : 'btn-outline-' . env('DEPARTMENTS_COLOR' , 'primary')}} form-control mb-2">{{__('common.departments')}}</button>
        </a>
        <a href="{{route('titles')}}">
          <button type="button" class="btn {{$name=='titles' ? 'btn-' . env('TITLES_COLOR' , 'primary') : 'btn-outline-' . env('TITLES_COLOR' , 'primary')}} form-control mb-2">{{__('common.titles')}}</button>
        </a>
        <a href="{{route('salaries')}}">
          <button type="button" class="btn {{$name=='salaries' ? 'btn-' . env('SALARIES_COLOR' , 'primary') : 'btn-outline-' . env('SALARIES_COLOR' , 'primary')}} form-control mb-2">{{__('common.salaries')}}</button>
        </a>
        <a href="{{route('deptEmp')}}">
          <button type="button" class="btn {{$name=='deptEmp' ? 'btn-' . env('DEPTEMP_COLOR' , 'primary') : 'btn-outline-' . env('DEPTEMP_COLOR' , 'primary')}} form-control mb-2">{{__('common.dept-emp')}}</button>
        </a>
      </div>
      <div class="col-12 col-md-9">
        
          @if ($name == 'employees')
          
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-expanded="false">
                Filter
              </button>
            </h2>
            <div id="filter" class="accordion-collapse collapse" aria-labelledby="filter">
              <div class="accordion-body">
                <form method="POST">
                @csrf
                  <!-- Gender of employee -->
                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-3 pt-0">{{__('employees.gender')}}:</legend>
                    <div class="col-sm-9">
                      
                    <div class="form-check form-switch">
                      <label class="d-block">
                        <input class="form-check-input" type="checkbox" name="male" value="M" checked>
                        {{__('employees.M')}}
                      </label>
                      <label class="d-block">
                        <input class="form-check-input" type="checkbox" name="female" value="F" checked>
                        {{__('employees.F')}}
                      </label>
                    </div>
                  </fieldset>

                  <!-- Employee's salary -->
                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-3 pt-0">{{__('employees.salary')}}:</legend>
                    <div class="col-sm-9">
                      
                    <div class="input-group">
                      <input class="form-control d-flex" type="number" min="0" name="salaryMin" placeholder="{{__('employees.salaryMin')}}">
                      <span class="input-group-text"> - </span>
                      <input class="form-control d-flex" type="number" min="0" name="salaryMax" placeholder="{{__('employees.salaryMax')}}">
                    </div>

                  </fieldset>

                  <!-- Employee's dept -->
                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-3 pt-0">{{__('employees.dept')}}:</legend>
                    <div class="col-sm-9">
                      
                    <select class="form-select mb-2" name="deptNo">
                      <option value="NULL">{{__('employees.noFilterByDept')}}</option>
                      @foreach($data['dept'] as $e)
                        <option value="{{$e->deptNo}}">{{$e->deptName}}</option>
                      @endforeach
                    </select>

                  </fieldset>

                  <button type="submit" class="btn btn-success mb-2 form-control">{{__('employees.search')}}</button>

                </form>
              </div>
            </div>
          </div>

          @endif

          <table class="table table-{{env(strtoupper($name) . '_COLOR', 'primary')}} table-striped table-hover">
            <thead>
              <tr>
                @foreach (array_keys(get_object_vars($data['body'][0])) as $headCol)
                  <th scope="col">{{__($name . '.' . $headCol)}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($data['body'] as $row)
              <tr>
                @foreach ($row as $col)
                  <td>{{$col}}</td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination justify-content-center">
            {{$data['body'] -> links()}}
          </div>

      </div>
    </div>
  </div>

@endsection