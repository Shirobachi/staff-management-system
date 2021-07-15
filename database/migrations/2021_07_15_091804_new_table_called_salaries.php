<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableCalledSalaries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->unsignedBigInteger('empNo');
            $table->integer('salary');
            $table->date('fromDate');
            $table->date('toDate');
            $table->timestamps();

            $table->primary('fromDate');
            $table->index('empNo');

            $table->foreign('empNo') -> references('id') -> on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salarries');
    }
}
