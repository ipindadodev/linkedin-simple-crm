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
        Schema::create('secuence_points', function (Blueprint $table) {
            $table->id();
            // Relación con la secuencia

            // Campos
            $table->integer('order');
            $table->text('message');
            $table->enum('time_type', ['daily', 'weekly', 'monthly', 'quarterly', 'dynamic']);
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])->nullable();
            $table->enum('day_of_month', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'])->nullable();
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
        Schema::dropIfExists('secuence_points');
    }
};
