<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condominium_id')->constrained('condominiums')->onDelete('cascade');
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade');
            $table->foreignId('received_by')->constrained('users')->onDelete('cascade'); // Staff who received
            $table->foreignId('picked_up_by')->nullable()->constrained('residents')->onDelete('set null'); // Resident who picked up
            
            // Parcel Details
            $table->string('tracking_number')->unique();
            $table->string('recipient_name');
            $table->string('unit_number');
            $table->string('courier_service'); // "DHL", "Kerry Express", "Thailand Post"
            
            $table->enum('parcel_size', ['small', 'medium', 'large', 'extra_large'])->default('medium');
            
            // Status & Dates
            $table->enum('status', ['pending', 'notified', 'picked_up'])->default('pending');
            $table->datetime('received_date');
            $table->datetime('picked_up_date')->nullable();
            
            // Additional Info
            $table->text('notes')->nullable();
            $table->string('image')->nullable(); // Photo of parcel
            
            $table->timestamps();
            
            // Index for faster queries
            $table->index(['condominium_id', 'status']);
            $table->index(['resident_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};