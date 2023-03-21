<?php 
/*
|----------------------------------------------------------------------------
| Landing Page Class
|----------------------------------------------------------------------------
*/
class Landing    
{
    private $db;
    private $upDir;
    /*
    |--------------------------------------------------------------------------
    | Setup our constructor. So can access the database.
    |--------------------------------------------------------------------------
    */    
    public function __construct($db)
    {
        $this->db       = $db;
        $this->upDir    = dirname(__DIR__, 1). DIRECTORY_SEPARATOR .'images' . DIRECTORY_SEPARATOR;
    }

    private function getUploadDirectory()
    {
        return $this->upDir;
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
     * Function to add the newly uploaded image and associated text to the database.
     */
    public function addImageAndTextToDb($upload, $text)
    {
        if(!$upload && !$text) return false;
        $this->db->insert('INSERT INTO landing_images (
            image_text,
            image_filename,
            image_link
        ) VALUES (?,?,?)',[
            $text,
            $upload,
            'images' . DIRECTORY_SEPARATOR . $upload
        ]);
    }

    /**
     * Function to get the image to display.
     */
    public function getImageToDisplay($data)
    {
        if(!array_key_exists('id', $data)) return [];
        return $this->db->get('SELECT *, CONCAT(?, image_filename) AS `file_path`
        FROM landing_images WHERE landing_id = ?',['images' . DIRECTORY_SEPARATOR, $data['id']]);
    }

    /**
     * Function to add the image to the correct directory and also store the data into the database.
     */
    public function addImageAndText($data)
    {
        $failed = false;
        $result = $this->uploadImage();
        if($result['success'])
        {
            // Insert the data into the database
            $this->addImageAndTextToDb($result['success'], $data['image_text']);
        }
        else $failed = ($result['failed']) ? $result['failed'] : 'Failed for some reason - need to investigate.' ;
        return $failed;
    }

    public function uploadImage()
    {
        $result = ['failed' => false, 'success' => false];

        if($_FILES)
        {
            // Checks to see if the file uploaded is an uploaded file.
            if(is_uploaded_file($_FILES['image']['tmp_name']))
            {
                // Checks if there was an error.
                if($_FILES['image']['error'] != UPLOAD_ERR_OK)
                {
                    $result['failed'] = $_FILES['image']['error'];
                }
                else
                {
                    $tmpname = $_FILES['image']['tmp_name'];

                    // Check the file type is an image.
                    $proceed = false;
                    switch(exif_imagetype($tmpname))
                    {
                        case IMAGETYPE_GIF :
                            $proceed = 'gif';
                        break;

                        case IMAGETYPE_JPEG :
                            $proceed = 'jpeg';
                        break;

                        case IMAGETYPE_PNG :
                            $proceed = 'png';
                        break;
                    }

                    if(!$proceed)
                    {
                        $result['failed'] = 'File uploaded was not of type png, jpeg or gif.';
                    }
                    else
                    {
                        $updir = $this->getUploadDirectory();
                        $fileName = htmlspecialchars(basename($_FILES['image']['name']));
                        $target_file = $updir . $fileName;
                        
                        // Check if file/image already exists
                        if (file_exists($target_file)) {
                            // Could do something here to add a (1) to the file name and then still upload it. Maybe check the database for files with the same original name. Then can just add 1 to the count and then upload it. But for now, going to return an error.
                            $result['failed'] = 'File already exists on the server.';
                        }
                        else
                        {
                            // Try and move the uploaded file to the correct location.
                            if (move_uploaded_file($tmpname, $target_file)) $result['success'] = $fileName;
                            else $result['failed'] = 'Sorry, there was an error uploading your file.';
                        }
                    }
                }
            }
        }
        else
        {
            $result['failed'] = 'Could not access the uploaded file.';
        }
        return $result;
    }
}

?>