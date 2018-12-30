<div class="filter">
    <?php
        $xml=simplexml_load_file("assets/searchFilter.xml");
        foreach($xml->children() as $child)
        {
            if ($child->attributes() == urldecode($_GET['what'])){
                foreach($child->children() as $searchInput)
                {
                    if ($searchInput->attributes()['type'] == 'select'){
                        echo '<label><span class="filterName">'.$searchInput->attributes()['name'] . '</span><select class="'.$searchInput->attributes()['class'] . '" name="'.$searchInput->attributes()['name'] . '">';
                        foreach($searchInput->children() as $option)
                        {
                            echo '<option value="'.$option->attributes()['name'].'">'.$option->attributes()['name'].'</option>';
                        }
                        echo '</select></label><br>';
                    } else if ($searchInput->attributes()['type'] == 'multiselect'){
                        echo '<label><span class="filterName">'.$searchInput->attributes()['name'] . '</span><select multiple="multiple" class="'.$searchInput->attributes()['class'] . '" name="'.$searchInput->attributes()['name'] . '">';
                        foreach($searchInput->children() as $option)
                        {
                            echo '<option value="'.$option->attributes()['name'].'">'.$option->attributes()['name'].'</option>';
                        }
                        echo '</select></label><br>';
                    }else{
                        echo '<label><span class="filterName">'.$searchInput->attributes()['name'] . '</span><input class="'.$searchInput->attributes()['class'] . '" placeholder="' . $searchInput->attributes()['placeholder'] . ' (ak je zadané mesto)" type="'.$searchInput->attributes()['type'] . '"></label><br>';
                    }
                }
            }
        }
    ?>
    <button class="searchButton">Hľadať</button>
    <button class="resetFilter">Reset</button>
</div>
<hr>