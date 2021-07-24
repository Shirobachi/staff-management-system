<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  @if(count($data) > 0)
  <table class="salaries table">
    <thead>
      <tr>
        <th>{{__('salaries.fromDate')}}</th>
        <th>{{__('salaries.toDate')}}</th>
        <th>{{__('salaries.salary')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d)
      <tr>
        <td>{{$d->fromDate}}</td>
        <td>{{$d->toDate}}</td>
        <td>{{$d->salary}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
    {{__('employees.noSalaries')}}
  @endif
</body>
</html>