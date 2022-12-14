<?php

use App\Models\Tweet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create((new Tweet())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tweet_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('tweet', 140)->index();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists((new Tweet())->getTable());
    }
};
