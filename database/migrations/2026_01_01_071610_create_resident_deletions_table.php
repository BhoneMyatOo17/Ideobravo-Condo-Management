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
        Schema::create('resident_deletions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('resident_id')->nullable(); // Nullable because resident will be deleted
            $table->foreignId('deleted_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('condominium_id')->constrained('condominiums')->onDelete('cascade');
            
            // Resident information (stored for records)
            $table->string('resident_name');
            $table->string('resident_email');
            $table->string('unit_number');
            $table->string('floor')->nullable();
            
            // Deletion details
            $table->text('deletion_reason');
            $table->boolean('email_sent')->default(false);
            $table->timestamp('email_sent_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_deletions');
    }
};