<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('contactNo')->nullable();
            $table->string('homeNo')->nullable();
            $table->string('streetNo')->nullable();
            $table->integer('village_id');
            $table->integer('district_id');
            $table->integer('commune_id');
            $table->integer('province_id');
            $table->string('location')->nullable();
            $table->integer('channel_id')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('customers');
    }
}
