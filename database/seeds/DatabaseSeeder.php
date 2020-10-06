<?php

use App\Models\Status;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Status::truncate();

        factory(User::class)->create(['email' => 'jose0302@gmail.com','name' => 'OrlandoSoto']);
        factory(Status::class, 10)->create();
    }
}
