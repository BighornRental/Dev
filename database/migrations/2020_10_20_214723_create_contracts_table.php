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
            $table->bigIncrements('id', 1000);
            $table->unsignedBigInteger('customers_id')->nullable();
            $table->string('contract_number');
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
            $table->float('product_cash_price');
            $table->float('product_sales_tax');
            $table->float('product_sales_tax_amount');
            $table->float('product_delivery_charge')->nullable();
            $table->string('product_side_color');
            $table->string('product_trim_color')->nullable();
            $table->string('product_roof_color');
            $table->string('product_condition');
            $table->float('monthly_payment');
            $table->integer('rto_terms');
            $table->date('delivery_date');
            $table->boolean('ldw')->default(false);
            $table->float('ldw_monthly');
            $table->float('cra');
            $table->float('initial_payment');
            $table->boolean('recurring_payment')->default(false);
            $table->boolean('papperless_billing')->default(false);
            $table->boolean('signed')->default(false);
            $table->boolean('initial_payment_made')->default(false);
            $table->timestamps();
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('SET NULL');
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
