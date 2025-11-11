<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class SetupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:setup_db {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup new app';

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

        $this->call('key:generate');
        $this->call('config:clear');

        // Get the database name from the argument or .env
        $database = $this->argument('name') ? $this->argument('name') : env('DB_DATABASE');       
        if (!$database) {
            $database='laravel';
            $this->error('Please provide a database name or set DB_DATABASE in your .env file.');
            // return 1;
        }

        // Update the .env file with the new database name
        // $this->updateEnvFile('DB_DATABASE', $database);

        // Temporarily clear the database config
        Config::set('database.connections.mysql.database', null);

        try {
            // Drop the existing database if it exists
            $dropQuery = "DROP DATABASE IF EXISTS `$database`";
            DB::statement($dropQuery);

            // Introduce a delay to ensure the database is dropped
            $this->info('Waiting for 2 seconds...');
            sleep(2); // Delay in seconds

            // Create the new database
            $createQuery = "CREATE DATABASE `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            DB::statement($createQuery);

            $this->info("Database '$database' recreated successfully!");
        } catch (\Exception $e) {
            $this->error("Failed to drop/create database: " . $e->getMessage());
            return 1;
        }

        // Reconnect with the new database name
        Config::set('database.connections.mysql.database', $database);
        DB::purge('mysql');
        DB::reconnect('mysql');

        // Run migrations and seed the database
        $this->call('migrate');
        $this->call('db:seed');

        // Install Laravel Passport
        $this->call('passport:install');

        return 0;
    }

    /**
     * Update the value in the .env file.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    protected function updateEnvFile($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $env = file_get_contents($path);
            $pattern = "/^$key=.*/m";

            // Check if the key exists, and replace it; otherwise, append it.
            if (preg_match($pattern, $env)) {
                $env = preg_replace($pattern, "$key=$value", $env);
            } else {
                $env .= "\n$key=$value";
            }

            // Write the updated .env file
            file_put_contents($path, $env);
        }
    }
}
