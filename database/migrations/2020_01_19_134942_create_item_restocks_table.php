<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRestocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_restocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('quantity');
            $table->enum('status',['pending','delivered','cancelled'])->default('pending');
            $table->timestamps();
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
        Schema::dropIfExists('item_restocks');
    }
}
