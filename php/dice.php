<?php

require_once('classes/Request.php');
require_once('classes/Dice.php');

use Dice\Dice;
use request\Request;

$sType =  Request::getParam('d');
$result = Dice::roll($sType);

echo $result;