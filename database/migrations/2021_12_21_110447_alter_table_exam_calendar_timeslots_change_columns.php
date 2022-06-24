<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableExamCalendarTimeslotsChangeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_calendar_timeslots', function (Blueprint $table) {
            $table->string('time_from')->change();
            $table->string('time_to')->change();
            $table->string('exam_begins_at')->change();
            $table->string('exam_end_at')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_calendar_timeslots', function (Blueprint $table) {
            $table->timestamp('time_from')->change();
            $table->timestamp('time_to')->change();
            $table->timestamp('exam_begins_at')->change();
            $table->timestamp('exam_end_at')->change();
        });
    }
}
