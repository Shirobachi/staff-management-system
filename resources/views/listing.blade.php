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
        
          <table class="table table-{{env(strtoupper($name) . '_COLOR', 'primary')}} table-striped table-hover">
            <thead>
              <tr>
                @foreach (array_keys(get_object_vars($data[0])) as $headCol)
                  <th scope="col">{{__($name . '.' . $headCol)}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($data as $row)
              <tr>
                @foreach ($row as $col)
                  <td>{{$col}}</td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination justify-content-center">
            {{$data -> links()}}
          </div>

      </div>
    </div>
  </div>

@endsection