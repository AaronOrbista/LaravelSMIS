<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDeliveredStockDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_delivered_stock_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('delivered_stock');
            $table->integer('item_restocks_id');
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
        Schema::dropIfExists('table_delivered_stock_dates');
    }
}
