<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condominium_id')->constrained('condominiums')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Staff/Admin who created
            
            // Content
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            
            // Categorization
            $table->enum('category', [
                'important', 
                'event', 
                'maintenance', 
                'update', 
                'new', 
                'eco', 
                'security', 
                'community'
            ])->default('update');
            
            $table->enum('priority', ['normal', 'high', 'urgent'])->default('normal');
            
            // Scheduling
            $table->date('start_date');
            $table->date('end_date')->nullable();
            
            // Notification settings
            $table->boolean('send_email')->default(false);
            $table->boolean('send_push')->default(false);
            
            // Target audience (for future filtering)
            $table->string('target_audience')->default('all'); // 'all', 'owners', 'tenants', etc.
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};