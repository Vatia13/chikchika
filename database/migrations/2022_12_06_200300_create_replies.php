<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->primary(['tweet_id', 'reply_id']);
            $table->foreignId('tweet_id');
            $table->foreignId('reply_id');

            $table->foreign('tweet_id')
            ->references('id')
            ->on('tweets')
            ->onDelete('cascade');

            $table->foreign('reply_id')
            ->references('id')
            ->on('tweets')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
