<?php

// Record the start time of the application
define('TODO_START', microtime(true));

// Load dependencies
require('../vendor/autoload.php');

// Create a new app instance
$app = new \App\Base\Application(__DIR__.'/../');

// Run the app
$app->run();
