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
        Schema::create('workout_ebook_downloads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_ebook_id');
            $table->boolean('accepted_terms')->default(0);
            $table->string('email');
            $table->timestamps();

            $table->foreign('workout_ebook_id')->references('id')->on('workouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workout_ebook_downloads');
    }
};
