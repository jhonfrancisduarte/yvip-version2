<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        if (!Schema::hasTable('volunteer_experience')) {
            Schema::create('volunteer_experience', function (Blueprint $table) {
                $table->id();
                $table->uuid('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
                $table->text('nature_of_event');
                $table->text('participation');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('volunteer_experience')) {
            Schema::dropIfExists('volunteer_experience');
        }
    }
};
