<?php

namespace Database\Factories;

use App\Models\Contracts;
use Illuminate\Database\Eloquent\Factories\Factory;
use App;

class ContractsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contracts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dealer' => "MSC",
            'customers_id'=> 7,
            'contract_number' => $this->faker->biasedNumberBetween($min = 6, $max = 7, $function = 'sqrt'),
            'sales_person' => $this->faker->name,
            'contract_state' => $this->faker->state,
            'shipping_address' => $this->faker->streetAddress,
            'shipping_city' => $this->faker->city,
            'shipping_state' => $this->faker->state,
            'shipping_county' => $this->faker->realText($maxNbChars = 20, $indexSize = 2),
            'shipping_country' => "USA",
            'shipping_postal_code' => $this->faker->postcode,
            'reference_name' => $this->faker->name,
            'reference_phone' => $this->faker->phoneNumber,
            'product_size' => $this->faker->biasedNumberBetween($min = 4, $max = 16, $function = 'sqrt'),
            'product_style' => $this->faker->word,
            'product_material' => 'wood',
            'product_roof_material' => "metal",
            'product_serial_number' => $this->faker->creditCardNumber,
            'product_cash_price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 999, $max = 9000),
            'product_sales_tax' => 0,
            'product_side_color' => $this->faker->colorName,
            'product_trim_color'=> $this->faker->colorName,
            'product_roof_color' => $this->faker->colorName,
            'product_condition' => "New",
            'rto_terms' => "36",
            'delivery_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'LDW' => $this->faker->boolean,
            'LDW-price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 1000),
            'CRA_amount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 1000),
            'inital_payment' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 999, $max = 9000),
            'recurring_payment' => $this->faker->boolean,
            'paperless_billing' => $this->faker->boolean,
            'signed' => $this->faker->boolean,
            'intial_payment' => $this->faker->boolean
        ];
    }
}
