<?php

namespace App\Console\Commands;

use App\Mail\SendMailable;
use Illuminate\Console\Command;
use App\Models\User;
use Mail;

class HappyNewYear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holiday:new-year';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send "happy new year" message to all users';

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
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        $message = [];
        foreach ($users as $user) {
            $message['title'] = 'Happy new year';
            $message['user_name'] = $user->full_name;
            $message['content'] = 'Happy new year';
            Mail::from(env(CONTACT_SUPPORT))
                    ->to($user->email)
                    ->subject('Happy new year')
                    ->send(new SendMailable($message));
        }
         
        $this->info('Happy new year sent to All Users');
    }
}
