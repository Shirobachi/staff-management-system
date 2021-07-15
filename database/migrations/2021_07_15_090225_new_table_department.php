<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableDepartment extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->string('deptNo');
            $table->string('deptName');
            $table->timestamps();

            $table->primary('deptNo');
            $table->index('deptName');
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
