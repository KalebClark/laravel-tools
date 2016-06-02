<?php

namespace KalebClark\LaravelTools\Console;

use Illuminate\Console\Command;
use DB;
use Artisan;
use Schema;


class RemakeDBCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:remakedb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild all tables in database from migrations and seed';

    /**
     * Create a new command instance.
     *
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
        //
        $db_name = getenv('DB_DATABASE');

        $tables = [];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->info('Dropping all tables =========================');
        foreach(DB::select('SHOW TABLES') as $k => $v) {
            $tables[] = array_values((array)$v)[0];
        }

        foreach($tables as $table) {
            Schema::drop($table);
            $this->info('Dropping table: <comment>'.$table.'</comment>');
        }

        $this->info('Calling: <comment>migrate</comment>');
        Artisan::call('migrate');

        $this->info('Calling: <comment>db:seed</comment>');
        Artisan::call('db:seed');

    }
}
