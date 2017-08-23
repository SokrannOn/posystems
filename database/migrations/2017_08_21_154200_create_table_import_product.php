<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImportProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('importId');
            $table->integer('productId');
            $table->integer('qty');
            $table->float('landingPrice');
            $table->date('mfd');
            $table->date('expd');
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
        Schema::dropIfExists('import_product');
    }
}
