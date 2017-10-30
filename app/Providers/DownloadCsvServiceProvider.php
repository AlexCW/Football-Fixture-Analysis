<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use App\Services\DownloadCsvService;
use App\Services\LoggerService;

use App\Services\RequestService;

class DownloadCsvServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\DownloadCsvService', function($app)
        {
            return new DownloadCsvService(
                new RequestService( new Client([
                    'base_uri' => env('CSV_DOWNLOAD_BASE_URI'),
                ])),
                new LoggerService($this->app->make('Psr\Log\LoggerInterface'))
            );
        });
    }
}
