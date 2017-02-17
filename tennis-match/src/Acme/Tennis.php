<?php

namespace Acme;

class Tennis
{
    private $player1;
    
    private $player2;

    private $lookup = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Fourty'
    ];

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function score()
    {
        if ($this->hasAWinner())
        {
            return 'Win for ' . $this->winner()->name;
        }

        if ($this->hasTheAdvantage())
        {
            return 'Advantage ' . $this->winner()->name;
        }

        if ($this->inDeuce())
        {
            return 'Deuce';
        }

        $score = $this->lookup[$this->player1->points] . '-'; 
        return $score .= $this->tied() ? 'All' : $this->lookup[$this->player2->points];
    }

    private function hasAWinner()
    {
        return $this->hasEnoughPointsToBeWon() && $this->isLeadingAtleastByTwo();
    }

    private function hasTheAdvantage()
    {
        return $this->hasEnoughPointsToBeWon() && $this->isLeadingByOne();
    }

    private function inDeuce()
    {
        return $this->player1->points + $this->player2->points >= 6 && $this->tied();
    }

    private function hasEnoughPointsToBeWon()
    {
        return max([$this->player1->points, $this->player2->points]) >= 4;
    }

    private function isLeadingByOne()
    {
        return abs($this->player1->points - $this->player2->points) == 1;
    }

    private function isLeadingAtleastByTwo()
    {
        return abs($this->player1->points - $this->player2->points) >= 2;
    }

    private function winner()
    {
         return $this->player1->points > $this->player2->points
            ?   $this->player1
            :   $this->player2;

    }

    private function tied()
    {
        return $this->player1->points == $this->player2->points;
    }
}
