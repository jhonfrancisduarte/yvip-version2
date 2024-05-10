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
        if (!Schema::hasTable('ip_post_program_obligations')) {
            Schema::create('ip_post_program_obligations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('event_id');
                $table->foreign('event_id')->references('id')->on('ip_events')->onDelete('cascade');
                $table->uuid('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('post_program_eval_report', 1000)->nullable();
                $table->string('policy_brief', 1000)->nullable();
                $table->string('group_terminal_report', 1000)->nullable();
                $table->string('volunteer_work', 1000)->nullable();
                $table->string('advocacy_plan', 1000)->nullable();
                $table->string('files_link', 1000)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('ip_post_program_obligations')) {
            Schema::dropIfExists('ip_post_program_obligations');
        }
    }
};
