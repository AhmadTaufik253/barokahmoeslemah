<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unsignedBigInteger('product_id')->default(0);
            $table->string('type',3);
            $table->string('qty',5)->default(0);
            $table->timestamps();
        });
        Schema::table('carts', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
