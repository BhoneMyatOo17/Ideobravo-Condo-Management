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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('condominium_id')->constrained('condominiums')->onDelete('cascade');
            
            // Employment Details
            $table->string('position'); // e.g., "Juristic Manager", "Security Guard", "Maintenance"
            $table->string('department')->nullable(); // e.g., "Management", "Security", "Maintenance"
            $table->string('employee_id')->unique()->nullable(); // Staff ID number
            
            // Work Schedule
            $table->date('hire_date')->nullable();
            $table->enum('employment_type', ['full-time', 'part-time', 'contract'])->default('full-time');
            
            // Contact (can be different from user email/phone)
            $table->string('work_phone')->nullable();
            $table->string('work_email')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // One user can only be staff at one condo (can modify if needed for multi-condo staff)
            $table->unique(['user_id', 'condominium_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};