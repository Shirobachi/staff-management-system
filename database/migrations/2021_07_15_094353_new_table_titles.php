<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewTableTitles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->unsignedBigInteger('empNo');
            $table->string('title');
            $table->date('fromDate');
            $table->date('toDate');
            $table->timestamps();

            $table->primary(['title', 'fromDate']);
            $table->index('empNo');

            $table->foreign('empNo')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('titles');
    }
}
