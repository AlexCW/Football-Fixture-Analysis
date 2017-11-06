<?php 

namespace App\Collections;

use Illuminate\Support\Collection;
use App\Entity\TeamScore;

class Teams
{   
    /**
     * List of teams
     * @var Illuminate\Support\Collection
     */
    private $teams;

    public function __construct(array $teams)
    {
        $this->teams = new Collection();

        $this->teams = $this->teams->times(24, function($index) use($teams) {
            //maybe pass this in?
            return new TeamScore($teams[$index], $index);
        });

        return $this;
    }

    /**
     * Sort the teams by the greatest available points won.
     * @return Collection
     */
    public function sortByGreatestAvailablePointsWon(): Collection
    {
        return $this->teams->sort(function($team_one, $team_two){
            return $team_one->getPercentageOfAvailablePointsWon() > $team_two->getPercentageOfAvailablePointsWon();
        });
    }

    public function __call($method, array $arguments) 
    {
        return call_user_func_array([$this->teams, $method], $arguments);
    }
}