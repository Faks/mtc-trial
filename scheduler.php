<?php
/**
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *******************************************
 * Company Name: Solum DeSignum
 * Company Website: http://solum-designum.com
 * Company GitHub: https://github.com/SolumDeSignum
 ********************************************************
 * Date: 2018.10.06.
 * Time: 3:21
 */

require_once __DIR__ . '/vendor/autoload.php';

use GO\Scheduler;
use src\Controllers\APIController;

// Create a new scheduler
$scheduler = new Scheduler();

// ... configure the scheduled jobs (see below) ...
$scheduler->call
(
    [
        APIController::init()->DoCreateCars()
    ]
)->everyFiveMinutes();

$scheduler->run();