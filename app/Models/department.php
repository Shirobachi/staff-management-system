<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class department extends Model
{
    use HasFactory;

    protected $fillable = [ 'deptNo', 'deptName' ];

    protected $primaryKey = 'deptNo'; // or null

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    public static function _get(){
      return DB::table('departments') 
      -> orderBy('deptNo')
      -> select('deptNo', 'deptName') 
      -> paginate(env('PAGINATE', 25));
    }
}
