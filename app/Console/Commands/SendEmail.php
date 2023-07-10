<?php

namespace App\Console\Commands;

use App\Http\Controllers\UserController;
use App\Models\Event;
use App\Mail\UserContactMail;
use App\Models\Eleve;
use App\Models\Inscription;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $upcomingEvents = Event::where('date', '>=', date('Y-m-d'))
                                ->where('date', '<=', date('Y-m-d', strtotime(date('Y-m-d')) + 86400))
                                ->with('classes')
                                ->get();

        foreach ($upcomingEvents as $event) {
            foreach ($event->classes as $classe) {
                $students = $classe->students;

                $emailData = [
                    'event' => $event,
                    'classe' => $classe,
                    'students' => $students,
                ];

                $studentEmails = [];
                foreach ($students->pluck('email') as $studentEmail) {
                    $studentEmails[] = $studentEmail;
                }

                $userContactEmail = new UserContactMail(User::find(1)->email, $studentEmails, "Composition demain", "mail", $emailData);
                Mail::send($userContactEmail);
                // $this->info("Email envoyé avec succès à " . $userContactEmail->envelope()->to[0]->address);
                // Mail::to($classe->users->pluck('email'))->send(new UserController(''));
            }
        }
    }
}
