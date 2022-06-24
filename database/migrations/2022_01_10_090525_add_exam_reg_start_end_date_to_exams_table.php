<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExamRegStartEndDateToExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->string('exam_reg_start_date')->after('exam_end_date')->nullable(); //add this column
            $table->string('exam_reg_end_date')->after('exam_reg_start_date')->nullable(); //add this column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('exam_reg_start_date');
            $table->dropColumn('exam_reg_end_date');
        });
    }
}
