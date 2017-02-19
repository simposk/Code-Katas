<?php

class StringCalculator
{
    public function add($numbers)
    {
        $numbers = preg_split('/\s*(,|\\\n)\s*/', $numbers);

        $solution = 0;

        foreach ($numbers as $number) 
        {
            $this->guardAgainstInvalidNumber($number);
            if ($number >= 1000) continue;
            $solution += $number; 
        }

        return $solution;
    }

    public function guardAgainstInvalidNumber($number)
    {
        return $number < 0 ? throw new InvalidArgumentException('Invalid number provided: ' . $number);
    }
}
