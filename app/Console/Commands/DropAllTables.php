<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DropAllTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:drop-all-tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->confirm('⚠️ This will drop all tables in the database. Are you sure?', false)) {

            $connection = config('database.default');
            $database = config("database.connections.$connection.database");

            DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            $tables = DB::select('SHOW TABLES');

            $keyName = "Tables_in_$database";

            foreach ($tables as $table) {
                $tableName = $table->$keyName;
                DB::statement("DROP TABLE `$tableName`");
                $this->info("Dropped table: $tableName");
            }

            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            $this->info('✅ All tables dropped successfully!');
        } else {
            $this->info('❌ Operation cancelled.');
        }
    }
}
