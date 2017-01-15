<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBuyingOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buying_orders', function (Blueprint $table) {
            $table->string('style');
            $table->string('ref');
            $table->string('sketch');
            $table->string('Gauge', 9);
            $table->string('yarn_ref_details');
            $table->string('colors');
            $table->date('pi_date');
            $table->char('yarn_status', 1);
            $table->string('contract_weight');
            $table->string('customer');
            $table->string('po');
            $table->date('po_recieved_date');
            $table->integer('qty');
            $table->string('sizing');
            $table->string('main_label');
            $table->string('hang_tag');
            $table->string('accys_status');
            $table->string('trims_status');
            $table->string('handover_date');
            $table->char('fit_sample_sent', 1);
            $table->string('courier_no');
            $table->string('fit_sample_comments');
            $table->string('fg');
            $table->string('production_status_details');
            $table->string('production_condition');
            $table->string('photo_sample');
            $table->char('shipping_sample_required', 1);
            $table->char('shipping_sample_sent', 1);
            $table->string('shipping_sent_courier_no');
            $table->string('shipping_sample_comments');
            $table->double('actual_production_weight');
            $table->double('confirmed_price');
            $table->date('inspection_date');
            $table->char('inspection_status', 1);
            $table->date('handedover_date');
            $table->integer('handedover_qty');
            $table->integer('short_excess');
            $table->double('value');
            $table->string('doc_sent_courier_no');
            $table->string('remarks');
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
