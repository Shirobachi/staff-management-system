<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    protected $fillable = ['login', 'e-mail', 'password'];    

    public static function getUser($login){
      return user::where('login', $login) 
      -> orWhere('e-mail', $login) 
      -> first();
    }
}
