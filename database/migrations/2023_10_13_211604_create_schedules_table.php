<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id(); // Unique identifier for the schedule.
            $table->time('opening'); // Opening time of the schedule.
            $table->time('closing'); // Closing time of the schedule.
            $table->integer('day'); // Day of the week (1 = Monday, 2 = Tuesday, ..., 7 = Sunday).
            $table->foreignId('substore_id')->constrained('sub_stores'); // Foreign key to the related substore.
            $table->timestamps(); // Timestamps for record creation and modification
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules'); // Drop the 'schedules' table when rolling back the migration.
    }
};
