<?php

/*
 * CONFIG COLLECTION
 */

use Fr05\Helper\Config;

require_once 'defines.php';
require_once 'views.php';
require_once 'filters.php';
require_once 'routes.php';
require_once 'view_macros.php';

$GLOBALS['json_config_path'] = __DIR__ . '/config.json';

Config::load($GLOBALS['json_config_path']);
