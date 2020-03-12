<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovedRequestBrandPivotTable extends Migration
{
    public function up()
    {
        Schema::create('approved_request_brand', function (Blueprint $table) {
            $table->unsignedInteger('approved_request_id');

            $table->foreign('approved_request_id', 'approved_request_id_fk_843520')->references('id')->on('approved_requests')->onDelete('cascade');

            $table->unsignedInteger('brand_id');

            $table->foreign('brand_id', 'brand_id_fk_843520')->references('id')->on('brands')->onDelete('cascade');
        });
    }
}
