<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /** 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code', 8);
            $table->string('image', 100)->nullable();
            $table->string('name')->unique();
            $table->string('category_code', 6);
            $table->string('merk_code', 6);
            $table->integer('weight');
            $table->integer('stock');
            $table->integer('capital_price');
            $table->integer('selling_price');
            $table->text('description');
            $table->integer('min_stock');
            $table->smallInteger('status_variant');
            $table->softDeletes();
            $table->string('input_user', 4);
            $table->dateTime('input_date');
            $table->string('update_user', 4);
            $table->dateTime('update_date');
            $table->dropPrimary('id');
            $table->primary(['product_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
