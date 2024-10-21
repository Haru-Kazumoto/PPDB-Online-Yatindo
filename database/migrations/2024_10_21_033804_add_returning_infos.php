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
            $table->integer('returning_current_step')->default(1)->nullable();
            $table->string('returning_step_name')->nullable();
            $table->string('returning_step_type')->nullable();
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
