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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('passport_number');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('nickname', 50)->nullable();
            $table->date('date_of_birth');
            $table->string('civil_status', 50);
            $table->integer('age');
            $table->string('nationality', 50);
            $table->integer('tel_number')->nullable();
            $table->integer('mobile_number');
            $table->string('email', 50);
            $table->string('password', 1000);
            $table->string('user_role', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
