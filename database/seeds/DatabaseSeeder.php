<?php

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
        if (app()->env == 'local') {
            $this->call([UserSeeder::class,
                CreditsSeeder::class]);

        } else {
            $this->call([UserSeeder::class,
                CreditsSeeder::class,
                EmailSeeder::class,
                EmailSecondSeeder::class]);
        }

    }
}
