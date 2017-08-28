<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameDisplay');
            $table->string('name');
            $table->tinyInteger('sex');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('contactNum')->nullable();
            $table->integer('brand_id')->nullable();
            $table->boolean('is_log')->default(0);
            $table->unsignedInteger('position_id');
            $table->unsignedInteger('zone_id')->nullable();
            $table->boolean('userStatus')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
