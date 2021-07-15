<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableDepartmentsEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deptEmp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empNo');
            $table->string('deptNo');
            $table->date('fromDate');
            $table->date('toDate');

            $table->index('empNo');
            $table->index('deptNo');

            $table->foreign('empNo') -> references('id') -> on('employees');
            $table->foreign('deptNo') -> references('deptNo') -> on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deptEmp');
    }
}
