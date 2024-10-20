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
        Schema::create('staging', function (Blueprint $table) {
            $table->id();
            $table->string('staging_name');
            $table->integer('index');
            $table->string('grade');
            $table->string('registration_type');
            
            $table->foreignId('batch_id')->constrained('registration_batch')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staging');
    }
};
