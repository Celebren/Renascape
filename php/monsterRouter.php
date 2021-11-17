<?php

require_once('classes/Request.php');
require_once('classes/service/Monster.php');

use request\Request;
use service\Monster;

$sIntent =  Request::getParam('q');

switch ($sIntent) {
	case 'loadIntoDb':
		Monster::loadAllIntoDb();
		break;
}