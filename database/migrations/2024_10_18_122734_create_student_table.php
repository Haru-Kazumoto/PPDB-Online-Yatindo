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
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->string('nisn')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('birth_place')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->string('grade');
            $table->string('family_card')->nullable();
            $table->string('birth_card')->nullable();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
