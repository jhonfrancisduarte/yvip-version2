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
        if (!Schema::hasTable('volunteer_skills')) {
        Schema::create('volunteer_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('skill_name', 1000);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
}
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasTable('volunteer_skills')) {
        Schema::dropIfExists('volunteer_skills');
        }
    }
};
