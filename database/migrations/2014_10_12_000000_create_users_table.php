<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->integer('region');
            $table->integer('province');
            $table->integer('city');
            $table->integer('barangay');
            $table->string('street');
            $table->string('role');
            $table->string('img')->nullable();
            $table->string('contact_no');
            $table->string('email')->nullable();
            $table->string('meter_no');
            $table->string('meter_brand');
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
