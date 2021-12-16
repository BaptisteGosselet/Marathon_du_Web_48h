<?php

namespace Database\Factories;

use App\Models\Serie;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $users_ids = User::all()->pluck('id');
        $series_ids = Serie::all()->pluck('id');
        $createAt = $this->faker->dateTimeInInterval(
            $startDate = '-6 months',
            $interval = '+ 180 days',
            $timezone = date_default_timezone_get()
        );
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        $comment = "";
        foreach ($paragraphs as $para) {
            $comment .= "{$para}";
        }
        return [
            'content' => $comment,
            'note' => $this->faker->numberBetween(0, 5),
            'user_id' => $this->faker->randomElement($users_ids),
            'serie_id' => $this->faker->randomElement($series_ids),
            'validated' => ($this->faker->numberBetween(0,100) > 75 ? 0 : 1),
            'created_at' => $createAt,
            'updated_at' => $this->faker->dateTimeInInterval(
                $startDate = $createAt,
                $interval = $createAt->diff(new DateTime('now'))->format("%R%a days"),
                $timezone = date_default_timezone_get()
            ),
        ];
    }
}
