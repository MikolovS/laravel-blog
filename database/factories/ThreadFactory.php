<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->title . '-' . str_random(),
        'content' => $faker->text(200) . '.',
    ];
});

$factory->defineAs(App\Models\Thread::class, 'with_author',function () {
	return factory(\App\Models\Thread::class)->make(['user_id' => function(){
		return factory(\App\Models\User::class)->create()->id;
	}])->toArray();
});
