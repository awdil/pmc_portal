<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInstituteForeignCandidateDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_documents', function (Blueprint $table) {
            $table->dropColumn('institute');
            $table->unsignedBigInteger('institute_id')->after('academic_achievement')->default(1);
            $table->foreign('institute_id')->references('id')->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_documents', function (Blueprint $table) {
            $table->dropForeign(['institute_id']);
            $table->dropColumn('institute_id');
            $table->string('institute')->after('academic_achievement')->nullable();
        });
    }
}
