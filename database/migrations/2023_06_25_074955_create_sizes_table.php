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
            $table->increments('size_id');
            $table->string('size_code', 2);
            $table->string('name', 20)->unique();
            $table->softDeletes();
            $table->integer('input_user');
            $table->dateTime('input_date');
            $table->integer('update_user');
            $table->dateTime('updated_at');
            $table->dropPrimary('size_id');
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
