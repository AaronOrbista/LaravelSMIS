<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovedRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('approved_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('item_id')->nullable();

            $table->string('control_number')->unique();

            $table->integer('quantity')->nullable();

            $table->longText('purpose')->nullable();

            $table->string('unit')->nullable();

            $table->date('date_requested')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
