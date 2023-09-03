<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_id', 15);
            $table->date('purchase_date');
            $table->date('purchase_duedate');
            $table->string('supplier_code', 6);
            $table->string('note', 200);
            $table->enum('status',['0', '1', '2']);
            $table->bigInteger('amount_total');
            $table->integer('ppn');
            $table->integer('discount');
            $table->integer('delivery');
            $table->bigInteger('total_pay');
            $table->integer('counter');
            $table->softDeletes();
            $table->char('input_user', 4);
            $table->dateTime('input_date');
            $table->char('update_user', 4);
            $table->dateTime('update_date');
            $table->dropPrimary('id');
            $table->primary(['purchase_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
