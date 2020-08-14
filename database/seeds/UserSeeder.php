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
        $users = [
            [
                'email' => 'admin@pajanik.com',
                'name' => 'admin',
                'password' => Hash::make(self::PASSWORD),
                'is_admin' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'heferttt@gmail.com',
                'name' => 'Артём',
                'password' => Hash::make('Karina2020'),
                'is_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'morziev@gmail.com',
                'name' => 'Артём',
                'password' => Hash::make('Karina2019'),
                'is_admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        DB::table('users')->insert($users);
    }

}
