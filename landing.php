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
        $proceed = $landing->addImageAndText($data);

        if($proceed['failed'])
        {
            // Then return to landing page again, with error message.
            header('Location: landing.php?failed='.$proceed['failed'] . '&image_text='.$data['image_text']);
        }
        /**
         * Check if image has been uploaded. If not, return a fail message and then return to landing page displaying the fail message and the text the user put in.
         */
        echo '<pre>';
        print_r($data);
        exit();
    break;

    case 'display':
        // In here, display the image and the text.
        // Have go back button.
        // If no image, or image is wrong tell the user.
        echo '<pre>';
        print_r($data);
        exit();
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