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
        Schema::create('badge_earned', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('badge_id');
            $table->foreign('badge_id')->references('badge_id')->on('badges')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('img');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badge_earned');
    }
};
