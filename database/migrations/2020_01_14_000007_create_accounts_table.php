<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('id_number')->unique();

            $table->string('first_name');

            $table->string('middle_name')->nullable();

            $table->string('last_name');

            $table->string('designation');

            $table->timestamps();

            $table->softDeletes();

        });
    }
}
