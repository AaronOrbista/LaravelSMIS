<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountDepartmentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('account_department', function (Blueprint $table) {
           
            $table->unsignedInteger('account_id');

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');

            $table->unsignedInteger('department_id');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            

        });
    }
}
