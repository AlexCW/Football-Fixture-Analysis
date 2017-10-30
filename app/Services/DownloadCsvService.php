<?php 

namespace App\Services;

use App\Contracts\Request;
use App\Contracts\Logger;

class DownloadCsvService
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

	public function __construct(Request $client, Logger $logger)
	{
		$this->client = $client;

		$this->logger = $logger;
	}

	/**
	 * Downloads the from the specified source
	 * @param  string $source
	 * @return string
	 */
	public function download($source)
	{
		return $this->client->sendGetRequest($source);
	}
}

