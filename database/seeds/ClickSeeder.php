<?php

use Illuminate\Database\Seeder;
use App\Models\Link;
use App\Models\User;
use App\Models\Click;

class ClickSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class, 10)->create()->each(function (User $user) {
        //     factory(Link::class, 6)->make()->each(function(Link $link) use ($user) {
        //         factory(Click::class, 10)->make()->each(function(Click $click) use ($link, $user) {
        //             factory(Link::class)->create([
        //                 'user_id' => $user->id
        //             ]);

        //             factory(Click::class)->create([
        //                 'link_id' => $link->id
        //             ]);
        //         });
        //     });
        // });
    }
}
