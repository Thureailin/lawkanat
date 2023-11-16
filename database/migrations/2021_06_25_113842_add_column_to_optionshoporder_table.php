<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToOptionshoporderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('option_shop_order', function (Blueprint $table) {
            $table->integer('add_same_item_status')->default(0)->comment = '0= Not same item add, 1= same itme add';
            $table->integer('new_status')->default(0)->comment = 'new same item (finish,start,cooking)';
            $table->integer('old_quantity')->nullable()->comment = 'old qty of same item ';
            $table->integer('new_quantity')->nullable()->comment = 'new qty same item';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('option_shop_order', function (Blueprint $table) {
            //
        });
    }
}
