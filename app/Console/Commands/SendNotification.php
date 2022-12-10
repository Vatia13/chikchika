<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\FollowingYou;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::first();
        $user->notify(new FollowingYou());
        return Command::SUCCESS;
    }
}
