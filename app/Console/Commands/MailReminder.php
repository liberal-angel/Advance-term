<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;

class MailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ReminderMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '予約当日の朝にリマインダーを送る';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $users = User::all();
        $reservations = Reservation::wheredate('start_at', $today)->get();
        foreach( $reservations as $reservation ){
            foreach( $users as $user ){
                if( $user->id === $reservation->user_id ){
                    return Mail::to($user->email)->send(new ReminderMail($user));
                }
            }
        }
    }
}