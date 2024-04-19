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
        if (!Schema::hasTable('volunteers')) {
            Schema::create('volunteers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                //$table->unsignedBigInteger('category_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  
                //$table->foreign('category_id')->references('id')->on('volunteer_categories')->onDelete('cascade');
                $table->text('volunteer_experience')->nullable();
                $table->integer('volunteering_hours')->nullable(false)->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('volunteers')) {
            Schema::dropIfExists('volunteers');
        }
    }
};
