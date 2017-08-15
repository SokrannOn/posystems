<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePurchaseOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('poDate');
            $table->date('dueDate')->nullable();
            $table->double('totalAmount');
            $table->double('discount')->default(0);
            $table->double('vat')->nullable();
            $table->double('diposit')->nullable();
            $table->integer('user_id');
            $table->integer('printedBy')->default(0);
            $table->integer('customer_id')->nullable();
            $table->double('cod')->default(0);
            $table->double('rate')->default(0);
            $table->tinyInteger('isGenerate')->default(0);
            $table->tinyInteger('isPayment')->default(0);
            $table->tinyInteger('isDelivery')->default(0);
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
        Schema::dropIfExists('purchase_order');
    }
}
