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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_number',20);
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->date('entry_date');
            $table->date('resign_date')->nullable();
            $table->integer('position')->comment('JE:1,SE:2,SL:3,L:4,PM:5}');
            $table->date('dob')->nullable();
            $table->boolean('member_type')->comment('new=True, old=False');
            $table->boolean('is_admin')->comment('admin=True, not_admin=False');
            $table->string('gender',20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
