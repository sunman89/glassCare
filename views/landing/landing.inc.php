<!-- 
    Finish the form off.
    Make it only be able to upload png, jpeg, mpeg. Etc, all the image types.
    If user tries to upload a wrong image type return a fail message.
    Test the image type on the backend.
    Make it also pass in the text used, that way can put the text back into the field. 

    OR test via javascript.
 -->
<div class="container-fluid pl-3 pr-3 mt-2 mb-0">
    <div class="row">
        <div class="col-6">
            <div class="widget-container p-2">
                <p class="sub-widget-title mb-1" style="font-size:1em;">Upload Image Form</p>
                <form class="p-2" id="upload-form" action="landing.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="upload-image" />
                    <div class="row mt-0 mb-0 p-2">
                        <div class="col-4 p-1 mb-0 text-center" style="background-color:#f0f8ff;vertical-align:center !important;">
                            <label for="image_text">Text:</label>
                        </div>
                        <div class="col-8 p-1 mb-0" style="background-color:#e4e9ed;">       
                            <input type="text" id="image_text" name="image_text" class="p-2" style="width:100%;" placeholder="Enter text" autocomplete="off" required value="<?=array_key_exists('image_text', $data) ? $data['image_text'] : '' ;?>">
                        </div>
                    </div>

                    <div class="row mt-0 mb-0 p-2">
                        <div class="col-4 p-1 mb-0 text-center" style="background-color:#f0f8ff;vertical-align:center !important;">
                            <label for="image">Upload Image:</label>
                        </div>
                        <div class="col-8 p-1 mb-0" style="background-color:#e4e9ed;">       
                            <input type="file" id="image" name="image" style="width:100%;" required="">
                        </div>
                    </div>

                    <?php if(array_key_exists('failed', $data)):?>
                        <div class="p-2">
                            <p class="m-0 text-center" style="color:red;"><?=$data['failed'];?></p>
                        </div>
                    <?php endif;?>

                    <div class="row mt-0 mb-0 p-2">
                        <div class="col-12 p-1 mb-0 text-center" style="background-color:#f0f8ff;vertical-align:center !important;">
                            <input type="submit" class="btn btn-success" style="width:100%;" value="Upload File" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6">
            <div class="widget-container p-2">
                <p class="sub-widget-title mb-1" style="font-size:1em;">Click link to see image</p>
                Put outputs in here. In a table.
            </div>
        </div>
    </div>
</div>