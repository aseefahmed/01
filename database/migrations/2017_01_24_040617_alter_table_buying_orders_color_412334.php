<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBuyingOrdersColor412334 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buying_orders_colors', function (Blueprint $table) {
            $table->string('color_name', 10);
            $table->string('color_type', 10);
            $table->string('order_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buying_orders_colors', function (Blueprint $table) {
            //
        });
    }
}
