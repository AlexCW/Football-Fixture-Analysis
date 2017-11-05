<?php 

namespace App\Entity;

class TeamScore
{   
    /**
     * The team name.
     * @var string
     */
    public $name;

    /**
     * The team position multiplier.
     * @var integer
     */
    public $position_multiplier;

    /**
     * Default initial available score
     * @var integer
     */
    private $available = 0;

    /**
     * Default initial total score
     * @var integer
     */
    private $total = 0;

    public function __construct(string $name, int $position_multiplier)
    {
        $this->name = $name;

        $this->position_multiplier = $position_multiplier;
    }

    /**
     * Add the points score for a home win.
     * @param integer $opposition_multiplier
     */
    public function addScoreForHomeWin(int $opposition_multiplier)
    {
        $this->total += (3 * $opposition_multiplier);

        $this->available += (3 * $opposition_multiplier);
    }

    /**
     * Add the points score for a away win.
     * @param integer $opposition_multiplier
     */
    public function addScoreForAwayWin(int $opposition_multiplier)
    {
        $this->total += (3.5 * $opposition_multiplier);

        $this->available += (3.5 * $opposition_multiplier);
    }

    /**
     * Add the points score for a home draw.
     * @param integer $opposition_multiplier
     */
    public function addScoreForHomeDraw(int $opposition_multiplier)
    {
        $this->total += (1 * $opposition_multiplier);

        $this->available += (3 * $opposition_multiplier);
    }

    /**
     * Add the points score for a away win.
     * @param integer $opposition_multiplier
     */
    public function addScoreForAwayDraw(int $opposition_multiplier)
    {
        $this->total += (1.5 * $opposition_multiplier);

        $this->available += (3.5 * $opposition_multiplier);
    }

    /**
     * Add the points score for a home loss.
     * @param integer $opposition_multiplier
     */
    public function addScoreForHomeLoss(int $opposition_multiplier)
    {
        $this->available += (3 * $opposition_multiplier);
    }

    /**
     * Add the points score for a away loss.
     * @param integer $opposition_multiplier
     */
    public function addScoreForAwayLoss(int $opposition_multiplier)
    {
        $this->available += (3.5 * $opposition_multiplier);
    }

    /**
     * Get the total team score
     * @return float
     */
    public function getTotalScore(): float
    {
        return $this->total;
    }

    /**
     * Get the total available team score
     * @return float
     */
    public function getAvailableScore(): float
    {
        return $this->available;
    }

    /**
     * Get the percentage of available points won
     * @return float
     */
    public function getPercentageOfAvailablePointsWon(): float
    {
        return number_format($this->available / max($this->total, 1), 2);
    }
}