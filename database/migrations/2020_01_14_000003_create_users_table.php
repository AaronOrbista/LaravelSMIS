<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->string('username')->nullable()->unique();

            $table->string('password')->nullable();

            $table->string('remember_token')->nullable();

            $table->string('middle_name')->nullable();

            $table->string('last_name')->nullable();

            $table->string('gender')->nullable();

            $table->string('position')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
