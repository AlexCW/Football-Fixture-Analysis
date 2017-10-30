<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetLatestResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'results:latest {league}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the latest results csv.';

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
        //$this->argument('league')
    }
}