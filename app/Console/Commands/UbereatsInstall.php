<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use App\Traits\Seedable;

class UbereatsInstall extends Command
{
    use Seedable;

    /**
     * @var ProgressBar
     */
    protected $progressBar;

    /**
     * The path of the seeder
     *
     * @var string
     */
    // protected $seedersPath = database_path('seeds/');

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ubereats:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install ubereats web application';

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
        $this->progressBar = $this->output->createProgressBar(6);
        $this->introMessage();
        sleep(1);

        $this->info('Installation of package, setup database');

        if (! $this->progressBar->getProgress()) {
            $this->progressBar->start();
        }

        $this->setupDatabaseConfig();
        $this->addEnvVarible();

        $this->info('Creating a symbolic link to your medias files');
        $this->call('storage:link');
        $this->progressBar->advance();

        $this->complete();
    }

        /**
     * Setup database configuration and seeder
     *
     * @return void
     */
    protected function setupDatabaseConfig(): void
    {
        $this->info('Generating the APP_KEY');
        $this->call('key:generate');
        $this->progressBar->advance();

        $this->info('Migrating the database tables into your application');
        $this->call('migrate');
        $this->progressBar->advance();

        $this->info('Installing passport and creating the token keys for security');
        $this->call('passport:install');
        $this->progressBar->advance();

        $this->info('Flush data into the database');
        $this->seed('DatabaseSeeder');
        $this->progressBar->advance();

        // Visually slow down the installation process so that the user can read what's happening
        usleep(350000);
    }

    /**
     * Set env variables
     *
     * @return void
     */
    protected function addEnvVarible(): void
    {
        $env = [
            'API_PREFIX' => config('global.api_prefix'),
            'LANGUAGE_CODE' => config('global.language_code'),
            'CURRENCY_CODE'  => config('global.currency_code'),
        ];

        $this->progressBar->advance();
        setEnvironmentValue($env);
        $this->info('Add API_PREFIX, LANGUAGE_CODE and CURRENCY_CODE to .env file');
    }

    protected function complete()
    {
        $this->progressBar->finish();

        // Outro message
        $this->info("
       ==========================+=========================================
                                      ,@@@@@@@,                 
                              ,,,.   ,@@@@@@/@@,  .oo8888o.     
                           ,&%%&%&&%,@@@@@/@@@@@@,8888\88/8o 
                          ,%&\%&&%&&%,@@@\@@@/@@@88\88888/88'   
                          %&&%&%&/%&&%@@\@@/ /@@@88888\88888'   
                          %&&%/ %&%%&&@@\ V /@@' `88\8 `/88'    
                          `&%\ ` /%&'    |.|        \ '|8'      
                              |o|        | |         | |        
                              |.|        | |         | |       
        ======================= Installation Complete ======================
        ");

        $this->comment("To create a user, run 'php artisan ubereats:admin'");
    }

    protected function introMessage()
    {
        // Intro message
        $this->info("
        ================================================================
              _                         _              _                  
        _   _| |__   ___ _ __ ___  __ _| |_ ___    ___| | ___  _ __   ___ 
       | | | | '_ \ / _ \ '__/ _ \/ _` | __/ __|  / __| |/ _ \| '_ \ / _ \
       | |_| | |_) |  __/ | |  __/ (_| | |_\__ \ | (__| | (_) | | | |  __/
        \__,_|_.__/ \___|_|  \___|\__,_|\__|___/  \___|_|\___/|_| |_|\___|        
        
                      Installation started. Please wait...
        ================================================================
        ");
    }
}
