<!-- LOCATIONS -->
<?php
    foreach($xml->children() as $child)
    {
        if ($child->attributes() == 'newAsset'){
            foreach($child->children() as $searchInput)
            {
                if ($searchInput->attributes()['type'] == 'select'){
                    echo '<div class="form-group">
                            <label class="col-md-4 control-label" for="'.$searchInput->attributes()['name'] . '">'.$searchInput->attributes()['name'] . ' <span style="color:red">*</span></label>
                            <div class="col-md-4">
                                <select class="'.$searchInput->attributes()['class'] . ' form-control" name="'.$searchInput->attributes()['name'] . '">';
                                foreach($searchInput->children() as $option)
                                {
                                    echo '<option value="'.$option->attributes()['name'].'">'.$option->attributes()['name'].'</option>';
                                }
                          echo '</select>
                            </div>
                         </div>';
                }
            }
        }
    }
?>