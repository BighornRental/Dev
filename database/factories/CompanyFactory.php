<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->firstName,
            'company_address' => $this->faker->streetAddress,
            'company_city' => $this->faker->city,
            'company_state' => $this->faker->state,
            'company_postal_code' => $this->faker->postcode,
            'company_phone' => $this->faker->phoneNumber,
        ];
    }
}
