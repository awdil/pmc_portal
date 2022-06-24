<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->after('id')->default(1);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id')->after('country_id')->default(1);
            $table->foreign('state_id')->references('id')->on('states');
            $table->unsignedBigInteger('city_id')->after('state_id')->default(1);
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('urdu_name')->after('name')->nullable(); //add this column
            $table->timestamp('cnic_expire_date')->after('cnic_number')->nullable(); //add this column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country_id');
            $table->dropColumn('state_id');
            $table->dropColumn('city_id');
            $table->dropColumn('urdu_name');
            $table->dropColumn('cnic_expire_date');
        });
    }
}
