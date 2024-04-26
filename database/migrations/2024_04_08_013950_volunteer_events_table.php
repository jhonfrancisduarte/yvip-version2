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
        Schema::create('volunteer_events', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_events');
            $table->string('organizer');
            $table->date('date');
            $table->integer('volunteering_hours');
            $table->string('volunteer_category');
            $table->string('event_status');
            $table->string('participant');
            $table->string('join_requests');
            $table->string('disapproved');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('volunteer_events');
    }
};
