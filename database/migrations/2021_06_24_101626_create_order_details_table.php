<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('type',3);
            $table->string('titles');
            $table->string('price',20);
            $table->string('qty',5);
            $table->string('subtotal',20);
        });
        Schema::table('order_details', function ($table) {
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
