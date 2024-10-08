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
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->text('question')->nullable();
            $table->unsignedBigInteger('difficulty_id');
            $table->foreign('difficulty_id')->references('difficulty_id')->on('difficulties')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('with_img')->default(0);
            $table->string('img_dir')->nullable();
            $table->string('correct_ans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
