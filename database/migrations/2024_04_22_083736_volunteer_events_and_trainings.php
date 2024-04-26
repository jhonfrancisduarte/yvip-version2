<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VolunteerEventsAndTrainings extends Migration
{
    /**
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_events_and_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->string('event_name');
            $table->string('organizer_facilitator');
            $table->date('start_date')->format('d F Y');
            $table->date('end_date')->format('d F Y');
            $table->integer('volunteer_hours');
            $table->string('volunteer_category')->nullable();
            $table->timestamps();
        });
    }

    /**
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer_events_and_trainings');
    }
}

