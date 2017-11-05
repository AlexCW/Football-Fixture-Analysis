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

		$this->assertNotEmpty($content, 'The content should not be empty.');

		$this->assertStringStartsWith(
			'Div,Date,HomeTeam,AwayTeam,FTHG,FTAG', 
			$content,
			'The CSV did not startt with the expected column headers.'
		);
		
		$records = $this->download_csv_feature->processData($content);

		$keys = ['available', 'total', 'position_multiplier', 'name'];

		$record = $records->first();

		foreach($keys as $key) {
	    	$this->assertObjectHasAttribute($key, $record, 'Class should contain the key ' . $key);
	    }

	    //Assert sorting order is correct.
	    $records->reduce(function($prev, $next){
	    	if(!is_null($prev)) {
		    	$this->assertGreaterThanOrEqual(
		    		$prev->getPercentageOfAvailablePointsWon(), 
		    		$next->getPercentageOfAvailablePointsWon()
		    	);
	    	}
	    });
	}	

	private function setupDownloadCsvFeature()
	{
		$this->download_csv_feature = $this->app->make('App\Features\DownloadCsvFeature');
	}
}