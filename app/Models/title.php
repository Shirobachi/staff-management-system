<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class title extends Model
{
    use HasFactory;

    protected $fillable = [ 'empNo', 'title', 'fromDate', 'toDate' ];

    // https://stackoverflow.com/a/34715309
    protected $primaryKey = [ 'title', 'fromDate' ]; // or null

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = [ 'string', 'date' ];
    
}
