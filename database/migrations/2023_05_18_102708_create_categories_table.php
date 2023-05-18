<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema; 

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_code', 2);
            $table->string('name', 100)->unique();
            $table->softDeletes();
            $table->foreignId('input_user', 4);
            $table->dateTime('input_date');
            $table->foreignId('update_user', 4);
            $table->dateTime('update_date');
            $table->dropPrimary('id');
            $table->primary(['category_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
