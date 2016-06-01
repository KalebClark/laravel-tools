<?php

namespace KalebClark\LaravelTools\Console;

use Illuminate\Console\Command;

class EnvironmentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:env:set {--show : Display the env instead of modifying files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the Application Environment';

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
    public function fire()
    {

        $this->line('<info>Current application environment:</info> <comment>'.$this->laravel['env'].'</comment>');

        $env = $this->ask('Which environment would you like to set? <comment>(local, development, test, production)</comment>');
        $this->setEnvInEnvironmentFile($env);
        $this->laravel['config']['app.env'] = $env;

        $this->info("Application environment [$env] set successfully.");
    }

    /**
     * Set the application environment in the environment file.
     *
     * @param  string  $env
     * @return void
     */
    protected function setEnvInEnvironmentFile($env)
    {
        file_put_contents($this->laravel->environmentFilePath(), str_replace(
            'APP_ENV='.$this->laravel['config']['app.env'],
            'APP_ENV='.$env,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }
}
