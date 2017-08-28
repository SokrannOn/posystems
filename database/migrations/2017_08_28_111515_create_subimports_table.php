<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubimportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subimports', function (Blueprint $table) {
            $table->increments('id');
            $table->date('subimportDate');
            $table->integer('purchaseorder_id');
            $table->integer('brand_id');
            $table->integer('supplier_id');
            $table->integer('imported_by');
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
        Schema::dropIfExists('subimports');
    }
}
