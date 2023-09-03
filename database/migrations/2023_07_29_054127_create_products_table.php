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
            $table->increments('product_id');
            $table->string('product_code', 13);
            $table->string('image', 100)->nullable();
            $table->string('name')->unique();
            $table->char('category_code', 2);
            $table->char('group_code', 2);
            $table->integer('weight');
            $table->integer('stock');
            $table->integer('capital_price');
            $table->integer('selling_price');
            $table->text('description');
            $table->string('product_sku');
            $table->integer('unit_id');
            $table->integer('min_stock');
            $table->enum('status_variant', ['0', '1']);
            $table->integer('variant_color');
            $table->integer('variant_size');
            $table->softDeletes();
            $table->string('input_user', 4);
            $table->dateTime('input_date');
            $table->string('update_user', 4);
            $table->dateTime('updated_at');
            $table->integer('counter');
            $table->dropPrimary('product_id');
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
