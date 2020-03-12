<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountApprovedRequestPivotTable extends Migration
{
    public function up()
    {
        Schema::create('account_approved_request', function (Blueprint $table) {
            $table->unsignedInteger('approved_request_id');

            $table->foreign('approved_request_id', 'approved_request_id_fk_843369')->references('id')->on('approved_requests')->onDelete('cascade');

            $table->unsignedInteger('account_id');

            $table->foreign('account_id', 'account_id_fk_843369')->references('id')->on('accounts')->onDelete('cascade');
        });
    }
}
