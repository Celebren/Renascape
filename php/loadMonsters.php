<?php

// 1. Open Monster JSON
$sFile = file_get_contents("../data/bestiary-mm.json");
$aData = json_decode($sFile, true);
// error_log(print_r($aData, true));
