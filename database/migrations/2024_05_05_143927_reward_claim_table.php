<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        if (!Schema::hasTable('reward_claim')) {
            Schema::create('reward_claim', function (Blueprint $table) {
                $table->id();
                $table->uuid('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('total_hours')->nullable(false)->default(0);
                $table->integer('total_claimed_hours')->nullable(false)->default(0);
                $table->integer('claimable_hours')->nullable(false)->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('reward_claim')) {
            Schema::dropIfExists('reward_claim');
        }
    }
};
