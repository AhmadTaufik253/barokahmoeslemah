<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categories_id');
            $table->string('titles');
            $table->string('slug');
            $table->longText('description');
            $table->string('berat');
            $table->enum('recomend',['y','n']);
            $table->string('price_s',20);
            $table->string('price_m',20);
            $table->string('price_l',20);
            $table->string('price_xl',20);
            $table->string('price_xxl',20);
            $table->string('stock_s',5);
            $table->string('stock_m',5);
            $table->string('stock_l',5);
            $table->string('stock_xl',5);
            $table->string('stock_xxl',5);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
        Schema::table('products', function ($table) {
            $table->foreign('categories_id')->references('id')->on('categories');
        });
    }
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
