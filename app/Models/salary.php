<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use DB;


class salary extends Model
{
    use HasFactory;

    protected $fillable = [ 'empNo', 'salary', 'fromDate', 'toDate' ];
    
    // https://stackoverflow.com/a/34715309
    protected $primaryKey = 'fromDate'; // or null

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'date';
  
    public static function _get(){
      return DB::table('salaries') 
      -> orderBy('fromDate')
      -> leftJoin('employees', 'employees.id', 'salaries.empNo') 
      -> select('firstName', 'lastName', 'salary', 'fromDate', 'toDate')
      -> where('salaries.toDate', '>=', Carbon::now())
      -> paginate(env('PAGINATE', 25));
    }
}
