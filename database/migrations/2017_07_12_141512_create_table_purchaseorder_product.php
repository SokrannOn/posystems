<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePurchaseorderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorder_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchaseorder_id');
            $table->integer('product_id');
            $table->integer('qty');
            $table->double('unitPrice');
            $table->double('amount');
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
        Schema::dropIfExists('purchaseorder_product');
    }
}
