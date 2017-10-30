<?php

/**
 * @coversDefaultClass App\Services\DownloadCsvService
 * @covers App\Services\DownloadCsvService
 * @group DownloadCsv
 */
class DownloadCsvServiceTest extends TestCase
{
	/**
	 * @var App\Services\DownloadCsvService
	 */
	private $download_csv_service;

	public function setUp()
	{
		parent::setUp();

		$this->setupDownloadCsvService();
	}

	public function testDownloadCsvServiceDownloadReturnsCsv()
	{
		$content = $this->download_csv_service->download('mmz4281/1718/E1.csv');

		$this->assertNotEmpty($content, 'The content should not be empty.');

		$this->assertStringStartsWith(
			'Div,Date,HomeTeam,AwayTeam,FTHG,FTAG', 
			$content,
			'The CSV did not startt with the expected column headers.'
		);
	}	

	private function setupDownloadCsvService()
	{
		$this->download_csv_service = $this->app->make('App\Services\DownloadCsvService');
	}
}