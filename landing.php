<?php
/**
 * Controller here.
 */
require __DIR__ . DIRECTORY_SEPARATOR . 'initialise.php';
require __DIR__ . '/models/Landing.php';

$landing = new Landing($db);
if(!isset($_REQUEST['action'])) $_REQUEST['action'] = 'landing'; // Default action
$data = $landing->formatAll($_REQUEST); // Clean url params.

/*
|--------------------------------------------------------------------------
| Determine the action required for the model and prepare includes for view
|--------------------------------------------------------------------------
*/
switch($_REQUEST['action'])
{
    case 'landing':
        // Output the data here. And also have the form to upload stuff here. 
        $layout     = 'landing.inc.php';
    break;

    /*
    |--------------------------------------------------------------------------
    | Default
    |--------------------------------------------------------------------------
    */
    default:
        echo ("Error. No Action.");
    break; 
}

/*
|--------------------------------------------------------------------------
| If we get here then output final result 
| If it is an action like an update then we may not get here.
|--------------------------------------------------------------------------
*/
require(__DIR__ . '/views/' . $layout);

?>