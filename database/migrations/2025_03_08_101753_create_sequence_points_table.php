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
        Schema::create('sequence_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sequence_id')->constrained('sequences')->cascadeOnDelete();
        
            $table->integer('order');
            $table->text('message');
            $table->enum('time_type', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly', 'dynamic']);
            $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->nullable();
            $table->tinyInteger('day_of_month')->nullable();
            $table->integer('days_after_start')->nullable();
            $table->integer('days_after_previous')->nullable();
            $table->string('goal')->nullable();
        
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sequence_points');
    }
};
