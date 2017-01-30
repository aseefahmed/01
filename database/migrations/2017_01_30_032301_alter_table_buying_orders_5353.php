<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBuyingOrders5353 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buying_orders', function (Blueprint $table) {
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
            $table->integer('supplier_id');
            $table->string('session');
            $table->string('number');
            $table->string('customer_dept');
            $table->string('type');
            $table->string('weight');
            $table->string('price');
            $table->string('accessories');
            $table->string('overseas_accessories');
            $table->date('accessories_status_date');
            $table->string('care_label_composition');
            $table->string('ca_rn');
            $table->string('packing');
            $table->date('original_ho_date');
            $table->date('proposed_ho_date');
            $table->string('approval_status');
            $table->date('approval_status_date');
            $table->string('next_sample');
            $table->string('status');
            $table->date('status_date');
            $table->string('yarn');
            $table->string('dyeing_order');
            $table->date('dyeing_order_date');
            $table->string('size_set');
            $table->date('size_set_date');
            $table->string('production');
            $table->string('production_date');
            $table->string('knitting');
            $table->string('linking');
            $table->string('finishing');
            $table->string('packing');
            $table->string('shipping_req');
            $table->string('shipping_status');
            $table->string('approved_weight');
            $table->string('shipping_status');
            $table->date('shipping_date');
            $table->string('mode');
            $table->string('destination');
            $table->string('shipping_hbl_awb');
            $table->string('shipping_vsl_flight');
            $table->date('shipping_etd');
            $table->date('shipping_eta');
            $table->string('shipping_master_lc');
            $table->string('shipping_invoice');
            $table->string('shipping_invoice_value');
            $table->string('doc_status');
            $table->string('doc_date');
            $table->string('payment');
            $table->string('payment_date');
        });
    }
}
