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
        if (!Schema::hasTable('volunteer_rewards')) {
            Schema::create('volunteer_rewards', function (Blueprint $table) {
                $table->id();
                $table->uuid('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('number_of_hours');
                $table->unsignedBigInteger('reward_id');
                $table->foreign('reward_id')->references('id')->on('rewards');
                $table->date('request_date')->format('d F Y')->nullable();
                $table->boolean('request_status')->default(1);
                $table->boolean('claim_status')->default(0);
                $table->date('claim_date')->format('d F Y')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('volunteer_rewards')) {
            Schema::dropIfExists('volunteer_rewards');
        }
    }
};
