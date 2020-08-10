<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

class EmailSecondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected const SENDER_EMAIL = 'no-reply@vavada.net';

    public function run()
    {
        $second = fopen('database/seeds/second.csv', 'r');
        while ($emails = fgetcsv($second)) {
            foreach ($emails as $email) {
                $deliveryStatus = (rand(1, 50) > 10) ? "delivered" : "failed";
                $faker = \Faker\Factory::create();
                $date = $faker->dateTimeBetween('23.12.2019', '03.06.2020');
                DB::table('emails')->insert([
                    'email' => $email,
                    'sender_email' => self::SENDER_EMAIL,
                    'delivery_status' => $deliveryStatus,
                    'send_date' => $date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
