<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Helper\ProgressBar;
use App\Models\User;

class UbereatsDemo extends Command
{
    /**
     * @var ProgressBar
     */
    protected $progressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ubereats:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database demo';

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
        $this->progressBar = $this->output->createProgressBar(2);
        $this->info('Creating database demo !');

        if (! $this->progressBar->getProgress()) {
            $this->progressBar->start();
        }

        $super_admin = User::whereHas('roles', function($query){
            $query->where('name', 'super-admin');
        })->first();

        Auth::login($super_admin);

        $this->progressBar->advance();
        $this->call('db:seed', ['--class' => 'DatabaseDemoSeeder']);
        $this->progressBar->advance();

        // Visually slow down the installation process so that the user can read what's happening
        usleep(500000);
        $this->progressBar->finish();

        Auth::logout();
        exit;
    }
}
