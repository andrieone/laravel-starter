<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {   
        Schema::create('weeklys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('sunday');
            $table->date('monday');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weeklys', function (Blueprint $table) {
            //
        });
    }
}
