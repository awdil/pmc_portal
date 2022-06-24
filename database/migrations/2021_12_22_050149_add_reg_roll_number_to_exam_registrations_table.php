<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegRollNumberToExamRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_registrations', function (Blueprint $table) {
            //
            $table->string('reg_number')->after('challan_number')->nullable(); //add this column
            $table->string('is_paid')->after('reg_number')->nullable(); //add this column
            $table->timestamp('paid_date')->after('is_paid')->nullable(); //add this column
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
            //
            $table->dropColumn(['reg_number', 'is_paid', 'paid_date']);
        });
    }
}
