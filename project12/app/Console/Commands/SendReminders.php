<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\ReturnItemReminder;
use Illuminate\Support\Facades\Notification;
use App\User;

class SendReminders extends Command
{
    protected $signature = 'send:reminders';

    protected $description = 'Send reminders to users about returning items';

    public function handle()
    {
        // Retrieve the users who need to be notified
        $users = User::where('return_date', '<=', now()->addDay())->get();

        // Send the notification to each user
        foreach ($users as $user) {
            $user->notify(new ReturnItemReminder());
        }
    }
}