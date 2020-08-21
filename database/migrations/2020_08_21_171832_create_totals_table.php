<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('invoice');
            $table->float('total');
            $table->timestamps();
            $table->foreign('invoice')
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
        Schema::dropIfExists('total');
    }
}
