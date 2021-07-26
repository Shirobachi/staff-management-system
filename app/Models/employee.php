<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class employee extends Model
{
  use HasFactory;

  protected $fillable = ['birthDate', 'firstName', 'lastName', 'gender', 'hireDate'];
      
  public static function _get($gender = false, $salaryMin = false, $salaryMax = false, $dept = false) {
    return DB::table('employees') 
      -> leftJoin('titles', 'titles.empNo', 'employees.id')
      -> leftJoin('deptEmp', 'deptEmp.empNo', 'employees.id')
      -> leftJoin('departments', 'departments.deptNo', 'deptEmp.deptNo')
      -> leftJoin('salaries', 'salaries.empNo', 'employees.id')
      -> orderBy('employees.id')
      -> select('employees.id', 'firstName', 'lastName', 'birthDate', 'gender', 'title', 'deptName', 'salary', 'hireDate') 
      -> where('deptEmp.toDate', '>=', Carbon::now())
      -> where('salaries.toDate', '>=', Carbon::now())
      -> where('titles.toDate', '>=', Carbon::now())
      -> when($gender, function ($query, $gender) {
          return $query->where('employees.gender', $gender);
        })
      -> when($salaryMin, function ($query, $salaryMin) {
          return $query->where('salaries.salary', '>=', $salaryMin);
        })
        -> when($salaryMax, function ($query, $salaryMax) {
          return $query->where('salaries.salary', '<=', $salaryMax);
        })
        -> when($dept, function ($query, $dept) {
          return $query->where('deptEmp.deptNo', $dept);
        })
      ->paginate(env('PAGINATE', env('PAGINATE', 25)));
  }

  public static function export($id) {
    return employee::where('employees.id', $id)
    -> leftJoin('titles', 'titles.empNo', 'employees.id')
    -> leftJoin('deptEmp', 'deptEmp.empNo', 'employees.id')
    -> leftJoin('departments', 'departments.deptNo', 'deptEmp.deptNo')
    -> where('deptEmp.toDate', '>=', Carbon::now())
    -> where('titles.toDate', '>=', Carbon::now())
    -> select('firstName', 'lastName', 'deptName', 'title')
    -> first();
  }
}
