<?php

use Illuminate\Database\Seeder;
use App\Models\Link;
use App\Models\User;

class LinkSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(Link::class)->create();

        factory(User::class, 10)->create()->each(function (User $user) {
            factory(Link::class, 6)->make()->each(function(Link $link) use ($user) {
                factory(Link::class)->create([
                    'user_id' => $user->id
                ]);
            });
        });
    }
}
