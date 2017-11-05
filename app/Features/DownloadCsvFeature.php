<?php 

namespace App\Features;

use App\Contracts\Request;
use App\Contracts\Logger;
use App\Contracts\Csv;
use App\Entity\TeamScore;
use Illuminate\Support\Collection;

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

	/**
	 * The array of score calculations for each team
	 * @var array
	 */
	private $scores = [];

	private $table = [
		24 => 'Wolves',
		23 => 'Sheffield United',
		22 => 'Cardiff',
		21 => 'Bristol City',
		20 => 'Aston Villa',
		19 => 'Derby',
		18 => 'Ipswich',
		17 => "Nott'm Forest",
		16 => 'Middlesbrough',
		15 => 'Leeds',
		14 => 'Sheffield Weds',
		13 => 'Brentford',
		12 => 'Norwich',
		11 => 'Preston',
		10 => 'QPR',
		9 => 'Barnsley',
		8 => 'Fulham',
		7 => 'Reading',
		6 => 'Millwall',
		5 => 'Hull',
		4 => 'Burton',
		3 => 'Birmingham',
		2 => 'Bolton',
		1 => 'Sunderland'
	];

	private $point_multipliers = ['HomeWin' => 3, 'AwayWin' => 3.5, 'HomeDraw' => 1, 'AwayDraw' => 1.5];

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
	public function download(string $source): string
	{
		$this->logger->info('Attempting to download from the following.', compact('source'));

		return $this->client->sendGetRequest($source);
	}

	/**
	 * Process the csv data
	 * @param  string $csv_data
	 * @return Collection
	 */
	public function processData(string $csv_data): Collection
	{
		$rows = $this->csv->getRows($csv_data, ['Div','Date','HomeTeam','AwayTeam','FTHG','FTAG']);

		$teams = new Collection();

		$teams = $teams->times(24, function($index){
			return new TeamScore($this->table[$index], $index);
		});

		for($i = 1; $i < count($rows); $i++) {
			$home_team = $rows[$i]['HomeTeam'];

		    $away_team = $rows[$i]['AwayTeam'];

		    $home_team = $teams->filter(function($team) use($home_team) { return $team->name == $home_team; })->first();
		    
		    $away_team = $teams->filter(function($team) use($away_team) { return $team->name == $away_team; })->first();

		    if($rows[$i]['FTHG'] > $rows[$i]['FTAG']) {
		    	$home_team->addScoreForHomeWin($away_team->position_multiplier);
		    	$away_team->addScoreForAwayLoss($home_team->position_multiplier);
		    } elseif($rows[$i]['FTHG'] == $rows[$i]['FTAG']) {
		    	$home_team->addScoreForHomeDraw($away_team->position_multiplier);
		    	$away_team->addScoreForAwayDraw($home_team->position_multiplier);
		    } else {
		    	$away_team->addScoreForAwayWin($home_team->position_multiplier);
		    	$home_team->addScoreForHomeLoss($away_team->position_multiplier);
    		}
		}

		return $teams->sort(function($team_one, $team_two){
			return $team_one->getPercentageOfAvailablePointsWon() > $team_two->getPercentageOfAvailablePointsWon();
		});
	}
}

