<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected const SENDER_EMAIL = 'no-reply@vavada.net';

    public function run()
    {
        $handle = fopen('database/seeds/emails.csv', 'r');
        while ($email = fgetcsv($handle)) {
            foreach ($email as $eml) {
                $deliveryStatus = (rand(1, 50) > 10) ? "delivered" : "failed";
                $faker = \Faker\Factory::create();
                $date = $faker->dateTimeBetween('23.12.2019', '03.06.2020');
                DB::table('emails')->insert([
                    'email' => $eml,
                    'sender_email' => self::SENDER_EMAIL,
                    'delivery_status' => $deliveryStatus,
                    'given_to_user' => 1,
                    'send_date' => $date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
