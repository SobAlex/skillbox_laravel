<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_news', function (Blueprint $table) {
            $table->id();
            $table->text('content');

            $table->unsignedBigInteger('news_id');
            $table->unsignedInteger('user_id');

            $table->foreign('news_id')->on('news')->references('id');
            $table->foreign('user_id')->on('users')->references('id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments_news');
    }
}
