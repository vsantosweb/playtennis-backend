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
        Schema::create('gym_products', function (Blueprint $table) {
            
            $table->unsignedBigInteger('gym_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('indoor');
            $table->integer('outdoor');

            $table->primary(['gym_id', 'product_id']);
            $table->foreign('gym_id')->references('id')->on('gyms')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gym_products');
    }
};
