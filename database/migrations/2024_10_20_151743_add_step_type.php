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
            $table->string('step_name')->nullable()->after('current_step');
            $table->string('step_type')->nullable()->after('step_name');
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
