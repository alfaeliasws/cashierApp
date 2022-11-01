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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('waiter');
            $table->string('order_number');
            $table->string('status')->default("active");
            $table->longText('description')->nullable();
            $table->string('cashier')->nullable();
            $table->string('item');
            $table->integer('table_number')->nullable();
            $table->integer('item_amount');
            $table->integer('price');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');    }
};
