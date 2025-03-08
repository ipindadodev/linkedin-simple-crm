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
            $table->string('firstname');
            $table->string('first_lastname')->nullable();
            $table->string('second_lastname')->nullable();
            $table->text('linkedin_profile_url');

            // Relación con prospect_locations

            // Relación con prospect_statuses

            // Relación con prospect_industries
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};
