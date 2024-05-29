protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $loans = \App\Models\Loan::where('due_date', '<=', now()->addDays(1))->get();

        foreach ($loans as $loan) {
            Mail::to($loan->user->email)->send(new \App\Mail\LoanReturnReminder($loan));
        }
    })->daily();
}
