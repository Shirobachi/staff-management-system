<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePrimaryKeyToTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('titles', function (Blueprint $table) {
            $table->dropPrimary(['title', 'fromDate']);
            $table->primary(['empNo', 'title', 'fromDate']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('titles', function (Blueprint $table) {
          $table->primary(['title', 'fromDate']);
          $table->dropPrimary(['empNo', 'title', 'fromDate']);
        });
    }
}
