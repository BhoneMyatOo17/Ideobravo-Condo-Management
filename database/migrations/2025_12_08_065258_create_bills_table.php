<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condominium_id')->constrained('condominiums')->onDelete('cascade');
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade');
            $table->foreignId('generated_by')->constrained('users')->onDelete('cascade'); // Staff/Admin who generated
            
            // Bill Details
            $table->string('bill_number')->unique(); // Auto-generated: BILL-2024-12-001
            $table->string('unit_number');
            
            $table->enum('bill_type', [
                'common_area', 
                'water', 
                'electricity', 
                'insurance', 
                'parking',
                'other'
            ]);
            
            // Amounts
            $table->decimal('amount', 10, 2);
            
            // Dates
            $table->date('issue_date');
            $table->date('due_date');
            $table->date('paid_date')->nullable();
            
            // Status
            $table->enum('status', ['pending', 'paid', 'overdue', 'cancelled'])->default('pending');
            
            // Payment Info
            $table->string('payment_method')->nullable(); // "Bank Transfer", "QR Code", "Cash"
            $table->string('payment_reference')->nullable(); // Transaction reference number
            
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Indexes for common queries
            $table->index(['condominium_id', 'status']);
            $table->index(['resident_id', 'status']);
            $table->index(['due_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};