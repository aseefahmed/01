<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBuyingOrders4334 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buying_orders', function (Blueprint $table) {
            $table->date('po_recieved_date')->nullable()->change();
            $table->string('accys_status')->nullable()->change();
            $table->string('trims_status')->nullable()->change();
            $table->string('fit_sample_sent', 2)->nullable()->change();
            $table->string('courier_no')->nullable()->change();
            $table->string('fit_sample_comments')->nullable()->change();
            $table->string('fg')->nullable()->change();
            $table->string('production_status_details')->nullable()->change();
            $table->string('shipping_sample_required', 2)->nullable()->change();
            $table->string('shipping_sample_sent')->nullable()->change();
            $table->string('shipping_sample_comments')->nullable()->change();
            $table->date('inspection_date')->nullable()->change();
            $table->string('inspection_status')->nullable()->change();
            $table->date('handedover_date')->nullable()->change();
            $table->integer('handedover_qty')->nullable()->change();
            $table->integer('short_excess')->nullable()->change();
            $table->string('remarks')->nullable()->change();
            //
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
