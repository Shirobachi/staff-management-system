<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    use HasFactory;

    protected $fillable = [ 'empNo', 'salary', 'fromDate', 'toDate' ];
    
    // https://stackoverflow.com/a/34715309
    protected $primaryKey = 'fromDate'; // or null

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'date';
  
}
