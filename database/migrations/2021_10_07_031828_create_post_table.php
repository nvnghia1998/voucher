<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title",150);
            $table->string("slug_name",150)->nullable();
            $table->string("image",250)->nullable();
            $table->text("detail")->nullable();
            $table->tinyInteger("voucher_enabled")->default(0);
            $table->integer("voucher_quantity")->default(0)->nullable();
            $table->string("code")->nullable();
            $table->integer("view_count")->default(0)->nullable();
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
        Schema::dropIfExists('post');
    }
}
