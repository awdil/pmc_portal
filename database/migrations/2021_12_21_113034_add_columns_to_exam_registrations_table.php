<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToExamRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_registrations', function (Blueprint $table) {

            $table->dropColumn('time_slote');
            $table->dropColumn('name');
            $table->dropColumn('exam_date');
            $table->unsignedBigInteger('exam_calendar_timeslot_id')->after('city_id');
            $table->foreign('exam_calendar_timeslot_id')->references('id')->on('exam_calendar_timeslots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_registrations', function (Blueprint $table) {
            
            $table->string('time_slote')->after('exam_center_id');
            $table->string('name')->after('city_id');
            $table->string('exam_date')->after('name');
            $table->dropConstrainedForeignId('exam_calendar_timeslot_id');
            // $table->dropColumn('exam_calendar_timeslot_id');
        });
    }
}
