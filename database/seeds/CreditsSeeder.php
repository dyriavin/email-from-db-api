<?php

use Illuminate\Database\Seeder;

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
        foreach ($ids as $id){
            DB::table('user_credits')->insert(['user_id'=> $id,'credit' => 2000]);
        }

    }
}
