<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        if (!Schema::hasTable('ip_events')) {
            Schema::create('ip_events', function (Blueprint $table) {
                $table->id();
                $table->uuid('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('event_name', 100);
                $table->string('organizer_sponsor', 1000);
                $table->date('start')->format('d F Y');
                $table->date('end')->format('d F Y');
                $table->string('status')->nullable();
                $table->text('qualifications');
                $table->text('participants')->nullable();
                $table->text('join_requests')->nullable();
                $table->text('disapproved')->nullable();
                $table->boolean('join_status')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('ip_events')) {
            Schema::dropIfExists('ip_events');
        }
    }
};
