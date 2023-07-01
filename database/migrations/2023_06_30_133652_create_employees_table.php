<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique();
            $table->string('employee_name');
            $table->string('employee_email')->unique();
            $table->string('employee_phone')->unique();
            $table->string('employee_address')->nullable();
            $table->string('employee_photo')->nullable();
            $table->string('position')->nullable();
            $table->string('experience')->nullable();
            $table->string('salary')->nullable();
            $table->string('vacation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
