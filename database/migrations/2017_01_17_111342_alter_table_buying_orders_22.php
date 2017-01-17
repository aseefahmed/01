<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBuyingOrders22 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buying_orders', function (Blueprint $table) {
            $table->string('shipping_sample_required', 3)->change();
            $table->string('shipping_sample_sent', 3)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buying_orders', function (Blueprint $table) {
            //
        });
    }
}
