<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen-env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy .env.example to .env';

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
        // Copy the .env.example to .env and generate app key  
        if (file_exists('.env.example')) {
            copy('.env.example', '.env');
            $this->info('.env file has been created.');
        } else {
            $this->error('.env.example file does not exist.');
        }
        $this->call('key:generate');
        $this->call('config:clear');
        return 0;
    }
}
