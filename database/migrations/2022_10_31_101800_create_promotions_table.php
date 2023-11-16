<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('reward');
            $table->integer('amount')->dafault(0);
            $table->integer('percent')->dafault(0);
            $table->string('foc_items')->nullable();
            $table->integer('type');
            $table->integer('voucher_amount')->dafault(0);
            $table->integer('purchase_item')->dafault(0);
            $table->integer('purchase_time')->dafault(0);
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('customer_console')->default(0);
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
        Schema::dropIfExists('promotions');
    }
}
