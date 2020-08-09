<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailExportHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_export_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_id');

            $table->string('sender_email')
                    ->references('sender_email')
                    ->on('emails');
            $table->string('delivery_status')
                    ->references('delivery_status')
                    ->on('emails');

            $table->string('export_date')
                    ->references('date_export')
                    ->on('email_date_stamps');
            $table->string('export_time')
                    ->references('time_export')
                    ->on('email_date_stamps');

            $table->foreign('email_id')->references('id')->on('emails');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_export_histories');
    }
}
