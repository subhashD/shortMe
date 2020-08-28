<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Click;
use App\Helpers\ClickHelper;
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

$factory->define(Click::class, function (Faker $faker) {
    // $referer = $_SERVER['HTTP_REFERER'];
    $referer = $faker->url;

    return [
        // 'link_id' => 1,
        'ip' => $faker->ipv4,
        'referer' => $referer,
        'referer_host' => ClickHelper::getHost($referer),
        'user_agent' => $faker->userAgent
    ];
});
