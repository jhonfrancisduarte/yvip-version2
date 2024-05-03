<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->string('number_of_hours');
            $table->text('rewards');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
