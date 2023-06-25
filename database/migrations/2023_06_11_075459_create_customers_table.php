<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id');
            $table->string('customer_code', 6);
            $table->string('name', 35)->unique();
            $table->string('email', 40);
            $table->string('phone', 20);
            $table->string('address');
            $table->enum('level', array('customer', 'reseller'));
            $table->softDeletes();
            $table->integer('input_user');
            $table->dateTime('input_date');
            $table->integer('update_user');
            $table->dateTime('updated_at');
            $table->dropPrimary('customer_id');
            $table->primary(['customer_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
