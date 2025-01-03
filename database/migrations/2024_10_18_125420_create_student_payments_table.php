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
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->string('payment_method');
            $table->string('payment_image');
            $table->string("status")->default('PENDING');

            $table->foreignId('student_id')->constrained('student')->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained('registration_batch')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_payments');
    }
};
