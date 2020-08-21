<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHash1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hash_1', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('address');
            $table->uuid('product_id');
            $table->string('link');
            $table->timestamps();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products');
            $table->foreign('link')
                  ->references('invoice')
                  ->on('transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hash_1');
    }
}
