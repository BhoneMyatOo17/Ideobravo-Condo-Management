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
        Schema::create('condominiums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // Unique invitation code for residents to join
            $table->string('address');
            
            // Contact Information
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('line_id')->nullable(); // Popular in Thailand
            
            // Building Details
            $table->integer('total_floors')->nullable();
            $table->integer('total_units')->nullable();
            $table->year('built_year')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condominiums');
    }
};