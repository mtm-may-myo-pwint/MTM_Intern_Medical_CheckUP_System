<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_checkups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->boolean('check_flg')->nullable()->comment('check = 1 , uncheck = 0');
            $table->boolean('vaccine_flg')->nullable()->comment('check = 1 , uncheck = 0');
            $table->date('last_vaccinated_date')->nullable();
            $table->string('optional_test')->nullable();
            $table->date('form_deadline_date')->nullable();
            $table->integer('status')->nullable()->comment('inform = 1, confirm = 2 , cancel = 3');
            $table->date('checkup_date')->nullable();
            $table->time('checkup_time')->nullable();
            $table->string('transportation_info')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_checkups');
    }
};
