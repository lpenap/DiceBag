<?php
namespace DiceBag\Dice;

use DiceBag\Randomization\RandomizationEngine;

class FudgeDice extends AbstractDice
{
    const FORMAT = '/^(?<quantity>\d*)f/';

    public function __construct(RandomizationEngine $randomization)
    {
        parent::__construct($randomization);

        $this->value = $this->randomization->getValue(-1, 1);
    }

    public static function make(RandomizationEngine $randomization, string $diceString) : array
    {
        preg_match(static::FORMAT, $diceString, $tokens);

        $pool = [];

        for ($i = 0; $i < ($tokens['quantity'] ?: 1); $i++) {
            $pool[] = new static($randomization);
        }

        return $pool;
    }
}
