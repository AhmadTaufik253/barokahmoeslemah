<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username',30)->unique();
            $table->string('email')->unique();
            $table->string('phone',15)->unique();
            $table->string('photo')->nullable();
            $table->enum('role',['Admin','Customer']);
            $table->longText('address')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('subdistrict_id')->nullable();
            $table->string('postcode',6)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function ($table) {
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->foreign('city_id')->references('city_id')->on('city');
            $table->foreign('subdistrict_id')->references('subdistrict_id')->on('subdistricts');
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
