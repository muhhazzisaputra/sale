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
            $table->increments('category_id');
            $table->string('category_code', 2);
            $table->string('name', 100)->unique();
            $table->softDeletes();
            $table->integer('input_user');
            $table->dateTime('input_date');
            $table->integer('update_user');
            $table->dateTime('updated_at');
            $table->dropPrimary('category_id');
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
