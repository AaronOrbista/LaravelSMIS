<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToApprovedRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('approved_requests', function (Blueprint $table) {
           /* $table->unsignedInteger('price_id')->nullable();

            $table->foreign('price_id', 'price_fk_843523')->references('id')->on('items');
        */
        });
    }
}
