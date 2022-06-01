<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('city_id');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('locality')->nullable();
            $table->string('geolocation');
            $table->string('city');
            $table->string('state');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_school')->nullable();
            $table->boolean('is_main')->default(0);
            $table->text('thumbnail')->nullable();
            $table->text('cover')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gyms');
    }
};
