<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamCalendarTimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_calendar_timeslots', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_calender_id');
            $table->string('time_from')->nullable();
            $table->string('time_to')->nullable();
            $table->timestamp('exam_begins_at')->nullable();
            $table->timestamp('exam_end_at')->nullable();
            $table->string('status', 20)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_calendar_timeslots');
    }
}
