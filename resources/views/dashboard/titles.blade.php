@extends('dashboard.common')

@section('title', 'Titles')

@section('table')

<table class="table table-info table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">{{__('titles.employee')}}</th>
      <th scope="col">{{__('titles.title')}}</th>
      <th scope="col">{{__('titles.fromDate')}}</th>
      <th scope="col">{{__('titles.toDate')}}</th>
      <th scope="col"><i class="bi bi-gear-fill"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($data['body'] as $d)
    <tr>
      <td>{{$d->empNo}}</td>
      <td>{{$d->title}}</td>
      <td>{{$d->fromDate}}</td>
      <td>{{$d->toDate}}</td>
      <td>
        <i class="modalLink bi bi-pencil" data-bs-toggle="modal" data-bs-target="#edit{{str_replace(' ', '', $d->empNo)}}"></i>
        <a href="{{url()->current()}}/delete/{{$d->title}}/{{$d->fromDate}}">
          <i class="text-danger bi bi-trash"></i>
        </a>
      </td>
    </tr>
    @endforeach
    <tr>
      <td style="text-align: center;" colspan="5">
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
        <h5 class="modal-title">{{__('titles.new')}}</h5>
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
        <input class="form-control mb-2" type="text" name="title" placeholder="{{__('titles.title')}}" >
        <input class="form-control mb-2" type="date" name="fromDate" placeholder="{{__('titles.fromDate')}}" >
        <input class="form-control mb-2" type="date" name="toDate" placeholder="{{__('titles.toDate')}}" >
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
<div class="modal fade" id="edit{{str_replace(' ', '', $d->empNo)}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('titles.edit')}} {{$d->deptName}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm{{str_replace(' ', '', $d->empNo)}}" method="POST" action="{{url()->current()}}/edit/{{$d->title}}/{{$d->fromDate}}">
        @csrf
        <select class="form-select mb-2" name="empNo">
          @foreach($data['employees'] as $e)
            <option {{$d->empNo == $e['name'] ? 'selected' : ''}} value="{{$e['value']}}">{{$e['name']}}</option>
          @endforeach
        </select>
        <input class="form-control mb-2" type="text" name="title" placeholder="{{__('titles.title')}}" value="{{$d->title}}" >
        <input class="form-control mb-2" type="date" name="fromDate" placeholder="{{__('titles.fromDate')}}" value="{{$d->fromDate}}" >
        <input class="form-control mb-2" type="date" name="toDate" placeholder="{{__('titles.toDate')}}" value="{{$d->toDate}}" >
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.close')}}</button>
        <button form="editForm{{str_replace(' ', '', $d->empNo)}}" type="submit" class="btn btn-primary">{{__('common.edit')}}</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection