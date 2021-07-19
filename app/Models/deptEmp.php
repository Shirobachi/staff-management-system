<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deptEmp extends Model
{
    use HasFactory;

    protected $table = 'deptEmp';

    protected $fillable = [ 'empNo', 'deptNo', 'fromDate', 'toDate' ];

}
