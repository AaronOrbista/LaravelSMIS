<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->integer('quantity');

         // $table->float('price', 15, 2)->nullable();

            $table->string('item_category');

            $table->longText('description')->nullable();

            $table->string('unit')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
