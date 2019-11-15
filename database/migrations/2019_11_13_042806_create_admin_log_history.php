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
            $table->unsignedBigInteger('admins_id')->nullable();
            $table->foreign('admins_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('set null');
            $table->string('activity', 100);
            $table->text('detail');
            $table->string('ip', 50);
            $table->dateTime('last_access');
            $table->string('not_exist_user', 50);
            $table->dateTime('failed_login_at');
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
