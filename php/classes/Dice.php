<?php
namespace Dice;

Class Dice {
	public static function roll(string $sType) : int {
		return random_int(1, (int) $sType);
	}
}