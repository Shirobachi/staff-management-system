<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class deptManager extends Model
{
    protected $table = "deptManager";
    protected $fillable = [ 'empNo', 'deptNo', 'fromDate', 'toDate' ];

    use HasFactory;

    public static function _get(){
      return DB::table('deptManagers') 
      -> leftJoin('employees', 'employees.id', 'deptManagers.empNo') 
      -> leftJoin('departments', 'departments.deptNo', 'deptManagers.deptNo') 
      -> orderBy('employees.lastName')
      -> orderBy('employees.firstName')
      -> select('firstName', 'lastName', 'deptName', 'fromDate', 'toDate')
      -> paginate(env('PAGINATE', 25));
    }
}
