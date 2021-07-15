<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableDeptManager extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deptManager', function (Blueprint $table) {
            $table->id();
            $table->string('deptNo');
            $table->unsignedBigInteger('empNo');
            $table->date('fromDate');
            $table->date('toDate');
            $table->timestamps();

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
        Schema::dropIfExists('deptManager');
    }
}
