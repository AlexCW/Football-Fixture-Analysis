<?php 

namespace App\Features;

use App\Contracts\Request;
use App\Contracts\Logger;
use App\Contracts\Csv;

class DownloadCsvFeature
{
	/**
	 * The client used to make the requests.. 
	 * @var App\Contracts\Request
	 */
	private $client;

	/**
	 * Log any calls made in the service
	 * @var App\Contracts\Logger
	 */
	private $logger;

	/**
	 * Service used to handle the csv
	 * @var App\Contracts\Csv
	 */
	private $csv;

	public function __construct(Request $client, Logger $logger, Csv $csv)
	{
		$this->client = $client;

		$this->logger = $logger;

		$this->csv = $csv;
	}

	/**
	 * Downloads the from the specified source
	 * @param  string $source
	 * @return string
	 */
	public function download($source)
	{
		$this->logger->info('Attempting to download from the following.', compact('source'));

		return $this->client->sendGetRequest($source);
	}
}

