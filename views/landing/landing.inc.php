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
                <p class="sub-widget-title mb-2" style="font-size:1em;">Click link to see image</p>
                <table class="table table-alternate table-hover" style="width:100%;font-size:0.8em;">
                    <thead class="thead-light">
                        <tr>
                            <th class="p-2 text-center" width="100">Text</th>
                            <th class="p-2 text-center" width="200">Image filename</th>
                            <th class="p-2 text-center" width="100">Uploaded Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($outputs as $output): ?>
                            <tr class="open-image" data-id="<?=$output['landing_id'];?>" style="cursor:pointer;">
                                <td class="p-2 text-center"><?=$output['image_text'];?></td>
                                <td class="p-2 text-center"><?=$output['image_filename'];?></td>
                                <td class="p-2 text-center"><?=date('d/m/Y H:i', strtotime($output['created_date']));?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    // Could of just put an <a> tag around the table entries to make it relocate to the images. Or even put an onclick function on the table rows too. But decided to do this way, to add some javascript to it all.
    // Normally would have a separate js file for this and use JQuery, but since it's such a small thing I decided not to.

    // Get the table rows.
    let trs = document.getElementsByClassName('open-image');
    for(let i=0;i< trs.length;i++) {
        // Loop through adding the click event to them.
        trs[i].addEventListener('click', openLink);
    }
    
    // Function to open the link.
    function openLink(e) {
        let id = this.getAttribute('data-id');
        window.location.href = 'landing.php?action=display&id=' + id;
    }
</script>