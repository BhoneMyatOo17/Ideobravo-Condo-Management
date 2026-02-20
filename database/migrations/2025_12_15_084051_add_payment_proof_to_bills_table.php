<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->string('payment_proof')->nullable()->after('payment_reference');
            $table->text('payment_notes')->nullable()->after('payment_proof');
            $table->timestamp('payment_submitted_at')->nullable()->after('payment_notes');
        });
    }

    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn(['payment_proof', 'payment_notes', 'payment_submitted_at']);
        });
    }
};