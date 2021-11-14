<?php

require_once('classes/Database.php');

use Database\Database;

// 1. Open Monster JSON
$sFile = file_get_contents("../data/bestiary-mm.json");
$aData = json_decode($sFile, true);
$rows = Database::select("SELECT * FROM monster");
// error_log(print_r($rows, true));