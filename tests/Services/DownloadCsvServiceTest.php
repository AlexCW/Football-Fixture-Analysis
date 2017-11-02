<?php

/**
 * @coversDefaultClass App\Features\DownloadCsvFeature
 * @covers App\Features\DownloadCsvFeature
 * @group DownloadCsv
 */
class DownloadCsvFeatureTest extends TestCase
{
	/**
	 * @var App\Features\DownloadCsvFeature
	 */
	private $download_csv_feature;

	public function setUp()
	{
		parent::setUp();

		$this->setupDownloadCsvFeature();
	}

	public function testDownloadCsvFeatureDownloadReturnsCsv()
	{
		$content = $this->download_csv_feature->download('mmz4281/1718/E1.csv');

		$reader = \League\Csv\Reader::createFromString($content);

		$reader->setDelimiter(','); #set in Feature provider.

		$reader->getHeaderOffset(1);

		$keys = ['Div','Date','HomeTeam','AwayTeam','FTHG','FTAG'];

		$records = $reader->getRecords($keys);

		foreach ($records as $offset => $record) {
		    foreach($keys as $key) {
		    	$this->assertArrayHasKey($key, $record);
		    }

		    break;
		}

		$this->assertNotEmpty($content, 'The content should not be empty.');

		$this->assertStringStartsWith(
			'Div,Date,HomeTeam,AwayTeam,FTHG,FTAG', 
			$content,
			'The CSV did not startt with the expected column headers.'
		);
	}	

	private function setupDownloadCsvFeature()
	{
		$this->download_csv_feature = $this->app->make('App\Features\DownloadCsvFeature');
	}
}