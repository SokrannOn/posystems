<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePricelists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricelists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->double('fobprice');
            $table->double('margin');
            $table->double('landingprice');
            $table->double('sellingprice');
            $table->date('startdate');
            $table->date('enddate');
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
        Schema::dropIfExists('pricelists');
    }
}
