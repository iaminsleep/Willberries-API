<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Creditentials: true');

header('Content-Type: application/json');

require_once 'cfg/config.php';
require_once 'cfg/functions.php';
require_once 'cfg/get_parameter.php';
require_once 'cfg/request_methods.php';