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
        $outputs    = $landing->getAllImages();
        $layout     = 'landing.inc.php';
    break;

    case 'upload-image':
        $failed = $landing->addImageAndText($data);
        // If has a failed message, pass it through to display it.
        header('Location: landing.php?'.(($failed) ? 'failed='.$failed . '&image_text='.$data['image_text'] :'' ));
    break;

    case 'display':
        $image      = $landing->getImageToDisplay($data);
        $layout     = 'display-image.inc.php';
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
require(__DIR__ . '/views' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'header.inc.php');
require(__DIR__ . '/views' . DIRECTORY_SEPARATOR . 'landing' . DIRECTORY_SEPARATOR . $layout);
require(__DIR__ . '/views' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'footer.inc.php');

?>