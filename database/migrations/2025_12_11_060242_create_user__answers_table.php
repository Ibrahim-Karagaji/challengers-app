<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user__answers', function (Blueprint $table) {
            $table->id();
            $table->integer("points")->default(0);
            $table->boolean("is_correct");
            $table->string("answer");
            $table->integer("exam_order");
            $table->string("category");
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user__answers');
    }
};
