<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use App\Features\DownloadCsvFeature;
use App\Services\CsvService;
use App\Services\LoggerService;
use App\Services\RequestService;

class DownloadCsvFeatureProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Features\DownloadCsvFeature', function($app)
        {
            return new DownloadCsvFeature(
                new RequestService( new Client([
                    'base_uri' => env('CSV_DOWNLOAD_BASE_URI'),
                ])),
                new LoggerService($this->app->make('Psr\Log\LoggerInterface')),
                new CsvService(',')
            );
        });
    }
}
