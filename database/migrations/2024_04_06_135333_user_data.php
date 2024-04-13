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
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('passport_number');
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('nickname', 50)->nullable();
            $table->date('date_of_birth')->format('d F Y');
            $table->string('civil_status', 50);
            $table->integer('age');
            $table->string('nationality', 50);
            $table->string('tel_number')->nullable();
            $table->string('mobile_number');
            $table->string('sex', 50);
            $table->string('permanent_selectedProvince', 200);
            $table->string('permanent_selectedCity', 200);
            $table->string('p_street_barangay', 200);
            $table->string('residential_selectedProvince', 200);
            $table->string('residential_selectedCity', 200);
            $table->string('r_street_barangay', 200);
            $table->string('educational_background', 50);
            $table->string('blood_type', 5)->nullable();
            $table->string('status', 50);
            $table->string('nature_of_work', 50)->nullable();
            $table->string('employer', 50)->nullable();
            $table->string('profile_picture')->nullable();
            $table->boolean('is_volunteer')->nullable();
            $table->boolean('is_ip_participant')->nullable();
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
        Schema::dropIfExists('user_data');
    }
};
