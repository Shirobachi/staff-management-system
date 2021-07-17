@extends('dashboard.common')

@section('title', 'Managers')

@section('table')

<table class="table table-success table-striped table-hover table-danger">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{__('managers.deptNo')}}</th>
      <th scope="col">{{__('managers.empNo')}}</th>
      <th scope="col">{{__('managers.fromDate')}}</th>
      <th scope="col">{{__('managers.toDate')}}</th>
      <th scope="col"><i class="bi bi-gear-fill"></i></th>
    </tr>
  </thead>
  <tbody>
    @foreach($data['body'] as $d)
    <tr>
      <td>{{$d->id}}</td>
      <td>{{$d->deptNo}}</td>
      <td>{{$d->empNo}}</td>
      <td>{{$d->fromDate}}</td>
      <td>{{$d->toDate}}</td>
      <td>
        <i class="modalLink bi bi-pencil" data-bs-toggle="modal" data-bs-target="#edit{{$d->id}}"></i>
        <a href="{{url()->current()}}/delete/{{$d->id}}">
          <i class="text-danger bi bi-trash"></i>
        </a>
      </td>
    </tr>
    @endforeach
    <tr>
      <td style="text-align: center;" colspan="7">
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
        <h5 class="modal-title">{{__('managers.new')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="newForm" method="POST" action="{{url()->current()}}/new">
        @csrf

        <select class="form-control mb-2" name="deptNo">
          @foreach($data['departments'] as $d)
            <option value="{{$d['value']}}">{{$d['name']}}</option>
          @endforeach
        </select>
        <select class="form-control mb-2" name="empNo">
          @foreach($data['employees'] as $e)
            <option value="{{$e['value']}}">{{$e['name']}}</option>
          @endforeach
        </select>
        <input class="form-control mb-2" type="date" name="fromDate" placeholder="{{__('managers.fromDate')}}">
        <input class="form-control mb-2" type="date" name="toDate" placeholder="{{__('managers.toDate')}}">
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
        <h5 class="modal-title">{{__('managers.edit')}} {{$d->firstName}} {{$d->lastName}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm{{$d->id}}" method="POST" action="{{url()->current()}}/edit/{{$d->id}}">
          @csrf

        <select class="form-control mb-2" name="deptNo">
          @foreach($data['departments'] as $e)
            <option {{$d->deptNo == $e['name'] ? 'selected' : '' }} value="{{$e['value']}}">{{$e['name']}}</option>
          @endforeach
        </select>
        <select class="form-control mb-2" name="empNo">
          @foreach($data['employees'] as $e)
            <option {{$d->empNo == $e['name'] ? 'selected' : '' }} value="{{$e['value']}}">{{$e['name']}}</option>
          @endforeach
        </select>
        <input value="{{$d->fromDate}}" class="form-control mb-2" type="date" name="fromDate" placeholder="{{__('managers.fromDate')}}">
        <input {{$d->toDate != __('managers.now') ? "value=" . $d->toDate : ""}} class="form-control mb-2" type="date" name="toDate" placeholder="{{__('managers.toDate')}}">
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