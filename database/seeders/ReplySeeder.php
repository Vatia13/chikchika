<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::factory()->count(50)->state(new Sequence(fn () =>['tweet_id' => Tweet::get()->random()]))->create();
    }
}
