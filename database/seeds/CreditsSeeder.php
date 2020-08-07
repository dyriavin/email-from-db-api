<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreditsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ids = \App\Models\User::all()->pluck('id');
        foreach ($ids as $id) {
            DB::table('user_credits')
                ->insert(['user_id' => $id,
                    'credit' => rand(17380,24108),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()]);
        }

    }
}
