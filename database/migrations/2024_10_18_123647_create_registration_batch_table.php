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
        Schema::create('registration_batch', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('max_quota');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('bank_name');
            $table->string('bank_username');
            $table->string('bank_number_account');
            $table->float('registration_price');

            $table->foreignId('registration_path_id')->constrained('registration_paths')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_batch');
    }
};
