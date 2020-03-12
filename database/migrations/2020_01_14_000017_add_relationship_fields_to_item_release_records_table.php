<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToItemReleaseRecordsTable extends Migration
{
    public function up()
    {
        Schema::table('item_release_records', function (Blueprint $table) {
            $table->unsignedInteger('control_number_id');

            $table->foreign('control_number_id', 'control_number_fk_843554')->references('id')->on('approved_requests');

            $table->unsignedInteger('date_requested_id');

            $table->foreign('date_requested_id', 'date_requested_fk_843555')->references('id')->on('approved_requests');
        });
    }
}
