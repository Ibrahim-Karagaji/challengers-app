<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->enum("category", ["React", "Nodejs", "Laravel", "Front end", "Back end", "public"]);
            $table->string("question");
            $table->string("op1");
            $table->string("op2");
            $table->string("op3");
            $table->string("op4");
            $table->string("answer");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
