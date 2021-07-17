@extends('dashboard.common')

@section('title', 'departments')

@section('table')

<table class="table table-success table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{__('departments.deptName')}}</th>
      <th scope="col"><i class="bi bi-gear-fill"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $d)
    <tr>
      <td>{{$d->deptNo}}</td>
      <td>{{$d->deptName}}</td>
      <td>
        <i class="modalLink bi bi-pencil" data-bs-toggle="modal" data-bs-target="#edit{{$d->deptNo}}"></i>
        <a href="{{url()->current()}}/delete/{{$d->deptNo}}">
          <i class="text-danger bi bi-trash"></i>
        </a>
      </td>
    </tr>
    @endforeach
    <tr>
      <td style="text-align: center;" colspan="3">
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
        <h5 class="modal-title">{{__('department.new')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="newForm" method="POST" action="{{url()->current()}}/new">
        @csrf
        <input class="form-control mb-2" type="text" name="deptNo" placeholder="{{__('departments.deptNo')}}">
        <input class="form-control mb-2" type="text" name="deptName" placeholder="{{__('departments.deptName')}}">
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
<div class="modal fade" id="edit{{$d->deptNo}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('departments.edit')}} {{$d->deptName}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm{{$d->deptNo}}" method="POST" action="{{url()->current()}}/edit/{{$d->deptNo}}">
        @csrf
        <input class="form-control mb-2" type="text" name="deptNo" placeholder="{{__('departments.deptNo')}}" value="{{$d->deptNo}}" >
        <input class="form-control mb-2" type="text" name="deptName" placeholder="{{__('departments.deptName')}}" value="{{$d->deptName}}" >
      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.close')}}</button>
        <button form="editForm{{$d->deptNo}}" type="submit" class="btn btn-primary">{{__('common.edit')}}</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection