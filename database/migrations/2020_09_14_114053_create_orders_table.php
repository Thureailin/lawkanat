<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->nullable();
            $table->text('address');
            $table->string('name');
            $table->string('phone');
            $table->dateTime('order_date');
            $table->dateTime('delivered_date')->nullable();
            $table->dateTime('accepted_date')->nullable();
            $table->integer('total_quantity');
            $table->integer('price');
            $table->text('note');
            $table->tinyInteger('status')->comment('1 Will incoming Status, 2 will confirm status, 3 will deliverd status,4 will delete status');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('employee_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
