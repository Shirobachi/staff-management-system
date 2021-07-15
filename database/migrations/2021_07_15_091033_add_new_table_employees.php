<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableEmployees extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->date('birthDate');
            $table->string('firstName');
            $table->string('lastName');
            $table->enum('gender', ['M', 'F']);
            $table->date('hireDate');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
