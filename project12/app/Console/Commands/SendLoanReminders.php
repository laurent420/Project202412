<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Loan;
use App\Mail\LoanReturnReminder;

class SendLoanReminders extends Command
{
    protected $signature = 'reminders:send-loan-return';
    protected $description = 'Send loan return reminder emails to users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $loans = Loan::where('due_date', '<=', now()->addDay())->get();

        foreach ($loans as $loan) {
            Mail::to($loan->user->email)->send(new LoanReturnReminder($loan));
        }

        $this->info('Loan return reminders sent successfully!');
    }
}
