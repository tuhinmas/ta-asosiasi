<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHash3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hash_3', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('address');
            $table->uuid('product_id_1');
            $table->uuid('product_id_2');
            $table->uuid('product_id_3');
            $table->string('link');
            $table->timestamps();
            $table->foreign('product_id_1')
                  ->references('id')
                  ->on('products');
            $table->foreign('product_id_2')
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
        Schema::dropIfExists('hash_3');
    }
}
