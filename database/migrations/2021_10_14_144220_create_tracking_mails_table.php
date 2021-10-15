<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to');
            $table->string('subject');
            $table->text('content')->nullable();
            $table->enum('status', ['Pending', 'Sending', 'Done', 'Error'])->default('Pending');
            $table->integer("post_id")->nullable();;
            $table->integer("user_id")->nullable();;
            $table->tinyInteger("type")->default(0); //User:0.Admin 1
            $table->dateTime('time', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking_mails');
    }
}
