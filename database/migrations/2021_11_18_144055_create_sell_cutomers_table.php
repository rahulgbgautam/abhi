<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellCutomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_customers', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_person_id');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('sell_quantity');
            $table->integer('alloted_quantity');
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
        Schema::dropIfExists('sell_customers');
    }
}
