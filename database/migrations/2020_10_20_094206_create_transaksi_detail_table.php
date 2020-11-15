<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('customer_id');
            $table->string('invoice');
            $table->integer('jumlah_item');
            $table->uuid('payment_method');
            $table->integer('sub_total');
            $table->integer('diskon');
            $table->integer('total');
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers');
            $table->foreign('payment_method')
                  ->references('id')
                  ->on('payment_methods');
            $table->foreign('invoice')
                  ->references('invoice')
                  ->on('transaksi')
                  ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_detail');
    }
}
