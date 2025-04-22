<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TruckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'renew_tag' => $this->faker->date(),
            'insurance_renewal' => $this->faker->date(),
            'next_oil_change' => $this->faker->date(),
            'truck_name' => $this->faker->word() . ' Truck',
            'truck_brand' => $this->faker->company(),
            'truck_model' => 'Model ' . $this->faker->randomNumber(3),
            'color' => $this->faker->safeColorName(),
            'license_plate' => strtoupper($this->faker->bothify('TRK-####')),
            'last_mechanic_visit' => $this->faker->date(),
            'repairs_done' => $this->faker->sentence(3),
            'attachment' => null 
        ];
    }
}
