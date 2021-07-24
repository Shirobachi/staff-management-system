@extends('dashboard.common')

@section('title', 'Salaries')

@section('table')

<table class="table table-info table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">{{__('salaries.empNo')}}</th>
      <th scope="col">{{__('salaries.salary')}}</th>
      <th scope="col">{{__('salaries.fromDate')}}</th>
      <th scope="col">{{__('salaries.toDate')}}</th>
      <th scope="col"><i class="bi bi-gear-fill"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $d)
    <tr>
      <td>{{$d->empNo}}</td>
      <td>{{$d->salary}}</td>
      <td>{{$d->fromDate}}</td>
      <td>{{$d->toDate}}</td>
      <td>
        <span data-bs-toggle="tooltip" data-bs-placement="left" title="{{__('salaries.edit', ['name' => $d->empNo])}}">
          <i class="modalLink bi bi-pencil" data-bs-toggle="modal" data-bs-target="#edit{{$d->fromDate}}"></i>
        </span>
        <a href="{{url()->current()}}/delete/{{$d->fromDate}}">
          <i class="text-danger bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="left" title="{{__('salaries.delete')}}"></i>
        </a>
      </td>
    </tr>
    @endforeach
    <tr>
      <td style="text-align: center;" colspan="5">
      <span data-bs-toggle="tooltip" title="{{__('salaries.new')}}">
        <i class="modalLink bi bi-plus-circle-dotted" data-bs-toggle="modal" data-bs-target="#new"></i>
      </span>
      </td>
    </tr>
  </tbody>
</table>

<!-- Modal new -->
<div class="modal fade" id="new" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('salaries.new')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="newForm" method="POST" action="{{url()->current()}}/new">
        @csrf
        <select class="form-select mb-2" name="empNo">
          @foreach($data['employees'] as $d)
            <option value="{{$d['value']}}">{{$d['name']}}</option>
          @endforeach
        </select>
        <input class="form-control mb-2" type="number" min="1" name="salary" placeholder="{{__('salaries.salary')}}" >
        <input class="form-control mb-2" type="date" data-bs-toggle="tooltip" title="{{__('salaries.fromDate')}}" name="fromDate" placeholder="{{__('salaries.fromDate')}}" >
        <input class="form-control mb-2" type="date" data-bs-toggle="tooltip" title="{{__('salaries.toDate')}}" name="toDate" placeholder="{{__('salaries.toDate')}}" >
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
@foreach($data as $d)
<div class="modal fade" id="edit{{$d->fromDate}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('salaries.edit', ['name' => $d->empNo])}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm{{$d->fromDate}}" method="POST" action="{{url()->current()}}/edit/{{$d->fromDate}}">
        @csrf
        <select class="form-select mb-2" name="empNo">
          @foreach($data['employees'] as $e)
            <option {{$d->empNo == $e['name'] ? 'selected' : ''}} value="{{$e['value']}}">{{$e['name']}}</option>
          @endforeach
        </select>
        <input class="form-control mb-2" type="number" min="1" name="salary" placeholder="{{__('salaries.salary')}}" value="{{$d->salary}}">
        <input class="form-control mb-2" type="date" data-bs-toggle="tooltip" title="{{__('salaries.fromDate')}}" name="fromDate" placeholder="{{__('salaries.fromDate')}}" value="{{$d->fromDate}}">
        <input class="form-control mb-2" type="date" data-bs-toggle="tooltip" title="{{__('salaries.toDate')}}" name="toDate" placeholder="{{__('salaries.toDate')}}" value="{{$d->toDate}}">
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.close')}}</button>
        <button form="editForm{{$d->fromDate}}" type="submit" class="btn btn-primary">{{__('common.edit')}}</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection