<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttendanceTimePasswordToExamRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_registrations', function (Blueprint $table) {
            $table->timestamp('arrived_at')->after('paid_date')->nullable(); //add this column
            $table->integer('exam_password')->after('arrived_at')->nullable(); //add this column
            $table->integer('seat_no')->after('exam_password')->nullable(); //add this column
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
            $table->dropColumn(['arrived_at', 'exam_password', 'seat_no']);
        });
    }
}
