<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLogHistory extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(){
        Schema::create('admin_log_history', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(){
        Schema::dropIfExists('admin_log_history');
    }
}
