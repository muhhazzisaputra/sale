<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_code', 6);
            $table->string('name', 35)->unique();
            $table->string('phone', 20);
            $table->string('address');
            $table->softDeletes();
            $table->string('input_user', 4);
            $table->dateTime('input_date');
            $table->string('update_user', 4);
            $table->dateTime('update_date');
            $table->dropPrimary('id');
            $table->primary(['supplier_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
