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
        Schema::create('event_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('gym_id');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->timestamp('registration_start_date')->comment('Data de abertura para inscrições');
            $table->timestamp('registration_end_date')->comment('Data de fechamento para inscrições');
            $table->integer('vacancies')->default(0);

            $table->foreign('gym_id')->references('id')->on('gyms')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events');

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
        Schema::dropIfExists('event_schedules');
    }
};
