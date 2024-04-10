<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('user_volunteer_skills')) {
        Schema::create('user_volunteer_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('volunteer_skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

}

    public function down()
    {
        if (Schema::hasTable('user_volunteer_skills')) {
        Schema::dropIfExists('user_volunteer_skills');
        }
    }
};
