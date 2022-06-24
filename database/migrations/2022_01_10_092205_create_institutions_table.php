<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('status', 20)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('institutions')->insert(
            array(
                'name' => 'BISE Lahore',
                'status' => 'active'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institutions');
    }
}
