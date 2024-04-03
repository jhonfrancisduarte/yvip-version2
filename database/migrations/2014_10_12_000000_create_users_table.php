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
            #sample
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
            $table->string('sex', 50);
            $table->string('permanent_address', 200);
            $table->string('residential_address', 200);
            $table->string('educational_background', 50);
            $table->string('blood_type', 5);
            $table->string('status', 50);
            $table->string('nature_of_work', 50)->nullable();
            $table->string('employer', 50)->nullable();
            $table->binary('profile_picture')->nullable();
            $table->boolean('is_volunteer');
            $table->boolean('is_ip_participant');
            $table->string('name_of_school', 50)->nullable();
            $table->string('course', 50)->nullable();
            $table->string('organization_name', 50)->nullable();
            $table->string('org_position', 50)->nullable();
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
