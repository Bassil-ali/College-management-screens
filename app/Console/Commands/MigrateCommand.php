<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database and migrate tables.';

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
        $connection = config('database.default');
        $migrate = 0;

        if ($connection == 'sqlite') {
            $database = config("database.connections.$connection.database");

            if(!file_exists($database)) {
                $this->error("Unable to find database file $database");
                return 0;
            }

            $this->dropExistingTables();
            $migrate = Artisan::call('migrate:refresh --force --seed');
            $this->info("New database `screens` created.");

        } else {
            $host = config("database.connections.$connection.host");
            $username = config("database.connections.$connection.username");
            $password = config("database.connections.$connection.password");
            $database = config("database.connections.$connection.database");
            $charset = 'utf8mb4';
            $collation = 'utf8mb4_unicode_ci';
            $create = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET $charset COLLATE $collation;";

            $this->info("Creating MySQL Database.");
            $pdo = new \PDO("mysql:host=$host", $username, $password);
            $pdo->exec($create);

            if (DB::statement($create) > 0) {
                $this->info("New database `screens` created.");
            }

            $this->dropExistingTables();

            $migrate = Artisa::call('migrate --force --seed');
        }

        $key = Artisa::call('key:generate');
        $this->info("Encryption key generated.");

        $links = Artisa::call('storage:link');
        $this->info("Storage links generated.");

        return $migrate + $key + $links;
    }

    private function dropExistingTables()
    {
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('screens');
        Schema::dropIfExists('instructors');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('users');
    }
}
