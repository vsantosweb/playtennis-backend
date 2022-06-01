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
        Schema::create('subscriptions_classifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classification_id');
            $table->unsignedBigInteger('subscription_id');
            $table->timestamps();

            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('subscription_id')->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions_classifications');
    }
};
