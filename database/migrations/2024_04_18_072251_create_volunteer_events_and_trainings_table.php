<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteerEventsAndTrainingsTable extends Migration
{
    /**
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteer_events_and_trainings', function (Blueprint $table) {
            $table->string('event_type');
            $table->string('event_name');
            $table->string('organizer_facilitator');
            $table->date('event_date');
            $table->integer('volunteer_hours');
            $table->json('volunteer_categories')->nullable();
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

