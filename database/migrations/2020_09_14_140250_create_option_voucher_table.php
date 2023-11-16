<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_voucher', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('voucher_id');
            $table->Integer('quantity');
            $table->Integer('price');
            $table->string('date');
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
        Schema::dropIfExists('option_voucher');
    }
}
