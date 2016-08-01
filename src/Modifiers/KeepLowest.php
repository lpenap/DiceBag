<?php
namespace DiceBag\Modifiers;

class KeepLowest implements Modifier
{
    const MATCH = '/kl(?<lowest>\d+)/';

    /** @var string $format */
    private $format;

    public function __construct(string $diceString)
    {
        $this->format = $diceString;
    }

    public function isValid() : bool
    {
        return preg_match(self::MATCH, $this->format);
    }

    public function apply(array $dice) : array
    {
        preg_match(self::MATCH, $this->format, $matches);
        $lowest = $matches['lowest'];

        sort($dice);

        return array_slice($dice, 0, $lowest);
    }
}
