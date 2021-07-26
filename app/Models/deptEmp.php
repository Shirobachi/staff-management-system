<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class deptEmp extends Model
{
    use HasFactory;

    protected $table = 'deptEmp';

    protected $fillable = [ 'empNo', 'deptNo', 'fromDate', 'toDate' ];

    public static function _get(){
      return DB::table('deptEmp') 
      -> leftJoin('employees', 'employees.id', 'deptEmp.empNo') 
      -> leftJoin('departments', 'departments.deptNo', 'deptEmp.deptNo') 
      -> select('firstName', 'lastName', 'deptName', 'fromDate', 'toDate')
      -> where('deptEmp.toDate', '>=', Carbon::now())
      -> paginate(env('PAGINATE', 25));
    }
}
