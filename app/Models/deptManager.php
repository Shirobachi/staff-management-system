<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deptManager extends Model
{
    protected $table = "deptManager";
    protected $fillable = [ 'empNo', 'deptNo', 'fromDate', 'toDate' ];

    use HasFactory;
}
