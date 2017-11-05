<?php

/**
 * @coversDefaultClass App\Entity\TeamScore
 * @covers App\Entity\TeamScore
 * @group TeamScore
 */
use App\Entity\TeamScore;

class TeamScoreTest extends TestCase
{
	/**
	 * @var App\Features\TeamScore
	 */
	private $team_score;

	public function setUp()
	{
		parent::setUp();

		$this->setupTeamScore();
	}

	public function testTeamScoreCorrectlyCalculatesTotalAndAvailableScore()
	{
		//Total = 24 * 3 = 72; Available = 24 * 3 = 72;
		$this->team_score->addScoreForHomeWin(24);

		$this->assertEquals($this->team_score->getTotalScore(), 72);

		$this->assertEquals($this->team_score->getAvailableScore(), 72);

		//Total = 20 * 3.5 = 70; Available = 20 * 3.5 = 70;
		$this->team_score->addScoreForAwayWin(20);

		$this->assertEquals($this->team_score->getTotalScore(), 142);

		$this->assertEquals($this->team_score->getAvailableScore(), 142);

		//Total = 10 * 1 = 10; Available = 10 * 3 = 30;
		$this->team_score->addScoreForHomeDraw(10);

		$this->assertEquals($this->team_score->getTotalScore(), 152);

		$this->assertEquals($this->team_score->getAvailableScore(), 172);

		//Total = 15 * 1.5 = 22.5; Available = 15 * 3.5 = 52.5;
		$this->team_score->addScoreForAwayDraw(15);

		$this->assertEquals($this->team_score->getTotalScore(), 174.5);

		$this->assertEquals($this->team_score->getAvailableScore(), 224.5);

		//Total = 0 * 3.5 = 0; Available = 12 * 3.5 = 42;
		$this->team_score->addScoreForAwayLoss(12);

		$this->assertEquals($this->team_score->getTotalScore(), 174.5);

		$this->assertEquals($this->team_score->getAvailableScore(), 266.5);

		//Total = 0 * 3 = 0; Available = 4 * 3 = 12;
		$this->team_score->addScoreForHomeLoss(4);

		$this->assertEquals($this->team_score->getTotalScore(), 174.5);

		$this->assertEquals($this->team_score->getAvailableScore(), 278.5);

		$this->assertEquals($this->team_score->getPercentageOfAvailablePointsWon(), 1.60);
	}	

	private function setupTeamScore()
	{
		$this->team_score = new TeamScore('Aston Villa', 19);
	}
}