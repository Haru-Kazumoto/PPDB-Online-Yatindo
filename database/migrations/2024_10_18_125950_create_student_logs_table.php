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
        Schema::create('student_logs', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('major_estimation')->nullable();
            $table->string('major_fix')->nullable();
            $table->string('remark')->nullable();
            $table->string('registration_type')->nullable();
            

            
            // $table->foreignId('staging_id')->constrained('staging')->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained('registration_batch')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('student')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_logs');
    }
};
