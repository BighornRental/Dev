<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customers_id')->nullable();
            $table->unsignedBigInteger('contract_number');
            $table->string('dealer');
            $table->string('sales_person');
            $table->string('contract_state');
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_county');
            $table->string('shipping_country');
            $table->string('shipping_postal_code');
            $table->string('reference_name');
            $table->string('reference_phone');
            $table->string('product_size');
            $table->string('product_style');
            $table->string('product_material');
            $table->string('product_roof_material');
            $table->string('product_serial_number');
            $table->string('product_cash_price');
            $table->string('product_sales_tax');
            $table->string('product_delivery_charge')->nullable();
            $table->string('product_side_color');
            $table->string('product_trim_color')->nullable();
            $table->string('product_roof_color');
            $table->string('product_condition');
            $table->string('rto_terms');
            $table->date('delivery_date');
            $table->boolean('LDW')->default(false);
            $table->float('LDW-price');
            $table->string('CRA_amount');
            $table->float('inital_payment');
            $table->boolean('recurring_payment')->default(false);
            $table->boolean('paperless_billing')->default(false);
            $table->boolean('signed')->default(false);
            $table->boolean('intial_payment')->default(false);
            $table->timestamps();
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
