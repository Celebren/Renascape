<?php

namespace service;

require_once(__DIR__ . '/../Database.php');
require_once(__DIR__ . '/../Util.php');

use Database\Database;
use Util\Util;


class Monster {
	public static function loadAllIntoDb() {
		// 0. Wipe table
		Database::deleteAll('monster');

		// 1. Open Monster JSON
		$sFile = file_get_contents("../data/bestiary-mm.json");
		$aMonsters = json_decode($sFile, true);
		$aaValues = [];
		$sValues = '';

		// 2. Put values together
		foreach ($aMonsters['monster'] as $aMonster) {
			$type = $aMonster['type'];
			if (is_array($type)) {
				$type = $type['type'] . (!isset($type['tags']) ? '' : ',' .implode(',', $type['tags']));
			}

			$cr = $aMonster['cr'];
			if (is_array($cr)) {
				$cr = $cr['cr'];
			}

			$aValues = [
				"'" . Database::escapeString($aMonster['name']) . "'",
				"'" . $aMonster['source'] . "'",
				"'" . $aMonster['size'] . "'",
				"'" . $type . "'",
				"'" . $cr . "'",
				Util::crToExp($cr),
				"'" . Database::escapeString(json_encode($aMonster)) . "'"
			];
			
			$aaValues[] = '(' . implode(',', $aValues) . ')';
		}

		// 3. Implode and insert
		$sValues = implode(',', $aaValues);
		Database::insert("
			INSERT INTO monster (Name, Source, Size, Type, Cr, Exp, Data)
			VALUES $sValues
		");
	}
}