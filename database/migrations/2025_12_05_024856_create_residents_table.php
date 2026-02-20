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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('condominium_id')->constrained('condominiums')->onDelete('cascade');
            
            // Unit Information
            $table->string('unit_number'); // e.g., "12A", "305", "B-1502"
            $table->string('floor')->nullable();
            
            // Residency Details
            $table->date('move_in_date')->nullable();
            $table->date('move_out_date')->nullable();
            $table->enum('residency_status', ['owner', 'tenant'])->default('owner');
            
            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            
            // Additional Info
            $table->integer('number_of_occupants')->default(1);
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // Ensure one user can't have duplicate units in same condo
            $table->unique(['user_id', 'condominium_id', 'unit_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};