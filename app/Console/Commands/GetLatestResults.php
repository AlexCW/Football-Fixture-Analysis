<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\DownloadCsvService;

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
     * The download CSV service
     * @var App\Services\DownloadCsvService
     */
    protected $download_csv_service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DownloadCsvService $download_csv_service)
    {
        parent::__construct();

        $this->download_csv_service = $download_csv_service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $csv_data = $this->download_csv_service->download();
    }
}