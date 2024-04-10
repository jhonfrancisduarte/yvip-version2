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
        if (!Schema::hasTable('volunteer_categories')) {
        Schema::create('volunteer_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }
}

    public function down()
    {
        if (Schema::hasTable('volunteer_categories')) {
        Schema::dropIfExists('volunteer_categories');
        }
    }
};
