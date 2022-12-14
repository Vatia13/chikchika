<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WeeklySummery;
use Illuminate\Console\Command;

class SendWeeklySummery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:weekly-summery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly summery notification to users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        User::weeklyFollowersCount()->weeklyFollowingCount()->chunk(10, function ($users) {
            foreach ($users as $user) {
                $user->notify(new WeeklySummery($user));
            }
            return false; //this is because of mail span on test project =)
        });
    }
}
