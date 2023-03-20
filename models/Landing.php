<?php 
/*
|----------------------------------------------------------------------------
| Landing Page Class
|----------------------------------------------------------------------------
*/
class Landing    
{
    private $db;
    /*
    |--------------------------------------------------------------------------
    | Setup our constructor. So can access the database.
    |--------------------------------------------------------------------------
    */    
    public function __construct($db)
    {
        $this->db       = $db;
    }

    /**
     * Function to format the passed in array to clean the inputted values. Mostly for the $_REQUEST.
     */
    public function formatAll($array)
    {
        foreach($array as $key => $value)
        {
            if(!is_array($array[$key])) $array[$key] = htmlspecialchars($value);
        }
        return $array;
    }

    /**
     * Function to get all the images, so can link to them on the landing page.
     */
    public function getAllImages()
    {
        return $this->db->get_all('SELECT * FROM landing_images ORDER BY landing_id ASC', []);
    }

    /**
     * Function to add the image to the correct directory and also store the data into the database.
     */
    public function addImageAndText($data)
    {
        $result = ['failed' => false, 'success' => false];

        // First try and upload the file. Then if that succeeds add it to the database. If not, return the failed message below, which will mention the file type they tried to upload.

        // Need to sort out this stuff.
        $result['failed'] = 'Image type not allowed - Try uploading a jpeg, jpg, png file.';
        return $result;
        echo '<pre>';
        print_r($data);
        exit();
        return $result;
    }
}

?>