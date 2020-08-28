<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Link;
use App\Models\User;
use App\Helpers\LinkHelper;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Link::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $longUrl = $faker->url;
    $shortUrl = LinkHelper::createShortLink($longUrl);

    return [
        'user_id' => $user->id,
        'short_url' => $shortUrl,
        'long_url' => $longUrl,
        'long_url_hash' => LinkHelper::longUrlHash($longUrl),
        'is_disabled' => 0
    ];
});
