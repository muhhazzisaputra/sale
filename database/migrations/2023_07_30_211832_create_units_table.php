<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('unit_id');
            $table->string('unit_code', 2);
            $table->string('name', 20)->unique();
            $table->integer('counter');
            $table->softDeletes();
            $table->integer('input_user');
            $table->dateTime('input_date');
            $table->integer('update_user');
            $table->dateTime('updated_at');
            $table->dropPrimary('unit_id');
            $table->primary(['unit_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
