<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Features\DownloadCsvFeature;

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
     * @var App\Features\DownloadCsvFeature
     */
    protected $download_csv_feature;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DownloadCsvFeature $download_csv_feature)
    {
        parent::__construct();

        $this->download_csv_feature = $download_csv_feature;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $csv_data = $this->download_csv_feature->download();
    }
}