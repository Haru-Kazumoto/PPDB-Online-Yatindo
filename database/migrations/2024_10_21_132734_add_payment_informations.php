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
        Schema::table('student_payments', function (Blueprint $table) {
            $table->string('bank_name')->after('payment_method')->nullable();
            $table->string('bank_number')->after('payment_method')->nullable();
            $table->string('account_user_bank')->after('payment_method')->nullable();
            $table->float('nominal')->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_payments', function (Blueprint $table) {
            $table->dropColumn(['bank_name','bank_number','account_user_bank','nominal']);
        });
    }
};
