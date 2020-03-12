<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandItemPivotTable extends Migration
{
    public function up()
    {
        Schema::create('brand_item', function (Blueprint $table) {
            $table->unsignedInteger('item_id');

            $table->foreign('item_id', 'item_id_fk_843353')->references('id')->on('items')->onDelete('cascade');

            $table->unsignedInteger('brand_id');

            $table->foreign('brand_id', 'brand_id_fk_843353')->references('id')->on('brands')->onDelete('cascade');
        });
    }
}
