<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone',15);
            $table->string('address');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('subdistrict_id');
            $table->string('postcode',6);
            $table->string('ekspedisi');
            $table->string('type');
            $table->string('notes')->nullable();
            $table->string('st');
            $table->string('photo');
            $table->string('resi',20)->nullable();
            $table->string('ongkir')->nullable();
            $table->string('total',20)->nullable();
            $table->timestamps();
        });
        Schema::table('orders', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->foreign('city_id')->references('city_id')->on('city');
            $table->foreign('subdistrict_id')->references('subdistrict_id')->on('subdistricts');
        });
    }
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
