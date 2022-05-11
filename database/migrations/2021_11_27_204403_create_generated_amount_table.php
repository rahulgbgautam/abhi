<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneratedAmountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amount_table', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_person_id');
            $table->integer('customer_id');
            $table->integer('total_amount');
            $table->integer('paid_amount');
            $table->integer('udhar_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amount_table');
    }
}
