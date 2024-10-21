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
        Schema::table('student_info', function (Blueprint $table) {
            $table->unsignedBigInteger('batch_id')->after('step_type')->nullable();
            // $table->foreignId('batch_id')->after('step_type')->constrained('registration_batch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_info', function (Blueprint $table) {
            //
        });
    }
};
