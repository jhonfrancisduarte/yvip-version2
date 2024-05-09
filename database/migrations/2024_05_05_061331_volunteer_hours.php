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
        if (!Schema::hasTable('volunteer_hours')) {
            Schema::create('volunteer_hours', function (Blueprint $table) {
                $table->id();
                $table->uuid('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unsignedBigInteger('event_id');
                $table->foreign('event_id')->references('id')->on('volunteer_events_and_trainings');
                $table->integer('volunteering_hours')->nullable(false)->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('volunteer_hours')) {
            Schema::dropIfExists('volunteer_hours');
        }
    }
};