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
        Schema::create('student_info', function (Blueprint $table) {
            $table->id();
            $table->string('school_origin');
            $table->string('profile_picture')->nullable();
            $table->string('status')->default('NOT_REGISTERED');
            $table->integer('current_step')->default(1);
            $table->string('step_name')->nullable();
            $table->string('step_type')->nullable();
            $table->unsignedBigInteger('return_batch_id')->nullable();
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->boolean('purchase_step_status')->default(false);
            $table->boolean('returning_step_status')->default(false);
            $table->dateTime("purchase_registration_date")->nullable();
            $table->dateTime('returning_registration_date')->nullable();
            $table->string('form_number')->nullable();$table->integer('returning_current_step')->default(1)->nullable();
            $table->string('returning_step_name')->nullable();
            $table->string('returning_step_type')->nullable();$table->string('father_name')->nullable();
            

            $table->foreignId('student_id')->constrained('student')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_info');
    }
};
