<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class SetupTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:setup-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create testing database if it does not exist';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = 'urlshortner_testing';

        try {
            config([
                'database.connections.mysql.database' => null,
            ]);

            DB::purge('mysql');
            DB::reconnect('mysql');

            DB::statement("CREATE DATABASE IF NOT EXISTS `{$database}`");

            $this->info("Database '{$database}' is ready.");

            return Command::SUCCESS;
        } catch (\Exception $e) {

            $this->error('Database setup failed.');
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}
