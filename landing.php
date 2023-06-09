<?php
/**
 * Controller here.
 */
require __DIR__ . DIRECTORY_SEPARATOR . 'initialise.php';
require __DIR__ . '/models/Landing.php';

$landing = new Landing($db);
if(!isset($_REQUEST['action'])) $_REQUEST['action'] = 'landing'; // Default action/route
$data = $landing->formatAll($_REQUEST); // Clean up the url params.

/*
|--------------------------------------------------------------------------
| Determine the action required for the model and prepare includes for view
|--------------------------------------------------------------------------
*/
switch($_REQUEST['action'])
{
    case 'landing':
        // Page to show the upload form and also the uploaded images links.
        $outputs    = $landing->getAllImages();
        $layout     = 'landing.inc.php';
    break;

    case 'upload-image':
        // Try to upload the image to the proper directory.
        $failed = $landing->addImageAndText($data);
        // If it failed, then pass the message through to display it.
        header('Location: landing.php?'.(($failed) ? 'failed='.$failed . '&image_text='.$data['image_text'] :'' ));
    break;

    case 'display':
        // Page to display the actual image.
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
        exit();
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