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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('second_last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('web')->nullable();
            $table->text('linkedin_url');
        
            // Foreign keys
            // Relationship with the prospect_locations table
            $table->foreignId('location_id')->constrained('prospect_locations')->cascadeOnDelete();
            // Relationship with the prospect_statuses table
            $table->foreignId('status_id')->constrained('prospect_statuses')->cascadeOnDelete();
            // Relationship with the prospect_industries table
            $table->foreignId('industry_id')->constrained('prospect_industries')->cascadeOnDelete();
        
            $table->timestamps();
        });

        Schema::table('interactions', function (Blueprint $table) {
            $table->foreign('prospect_id')->references('id')->on('prospects')->cascadeOnDelete();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');

        Schema::table('interactions', function (Blueprint $table) {
            $table->dropForeign(['prospect_id']);
        });
    }
};
