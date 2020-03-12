<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovedRequestItemPivotTable extends Migration
{
    public function up()
    {
        Schema::create('approved_request_item', function (Blueprint $table) {
            $table->unsignedInteger('approved_request_id');

            $table->foreign('approved_request_id', 'approved_request_id_fk_843370')->references('id')->on('approved_requests')->onDelete('cascade');

            $table->unsignedInteger('item_id');

            $table->foreign('item_id', 'item_id_fk_843370')->references('id')->on('items')->onDelete('cascade');
        });
    }
}
