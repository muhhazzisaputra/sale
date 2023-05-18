<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('size_code', 6);
            $table->string('name', 10)->unique();
            $table->softDeletes();
            $table->string('input_user', 4);
            $table->dateTime('input_date');
            $table->string('update_user', 4);
            $table->dateTime('update_date');
            $table->dropPrimary('id');
            $table->primary(['size_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
