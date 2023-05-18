<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('product_code');
            $table->foreignId('size_code');
            $table->integer('stock');
            $table->integer('capital_price');
            $table->integer('selling_price');
            $table->softDeletes();
            $table->string('input_user', 4);
            $table->dateTime('input_date');
            $table->string('update_user', 4);
            $table->dateTime('update_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
