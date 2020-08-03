<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected const PASSWORD = 'pajanik';
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin@pajanik.com',
            'name' => 'admin',
            'password' => Hash::make(self::PASSWORD),
            'is_admin' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

}
