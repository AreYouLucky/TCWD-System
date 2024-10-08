<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('difficulties', function (Blueprint $table) {
            $table->id('difficulty_id');
            $table->string('name');
            $table->integer('score');
            $table->integer('round');
            $table->integer('time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('difficulties');
    }
};
