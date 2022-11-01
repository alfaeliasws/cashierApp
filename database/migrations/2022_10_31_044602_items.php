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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('item');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->string('status')->default("Ready");
            $table->softDeletes();
        });
    }


    // insert into users (name, employeeid, password, is_cashier) value ("Michael", "MIC", "$2a$12$2q9KOEYzabe1Vr4Nv.V9qOMZVs2lKZfB8htDlrFrHAC3v3RzKp1am",1);

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');    }
};
