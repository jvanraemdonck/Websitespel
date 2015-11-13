<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Question::class, function ($faker) {
    return [
        'question' => $faker->paragraph(3),
        'additional_info' => $faker->sentence(3),
        'tip' => $faker->sentence(7),
        'tip_alters_question' => $faker->boolean,
        'question_type' => $faker->word,
        'sequence' => $faker->numberBetween(0, 50)
    ];
});
