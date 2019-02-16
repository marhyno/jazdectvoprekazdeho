<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend><?php echo $title = basename($_SERVER['PHP_SELF']) == 'editovat.php' ? "Upraviť údaje udalosti" : "Detaily novej udalosti"; ?></legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="organizer">V mene koho organizujem udalosť</label>
  <div class="col-md-4">
    <select id="organizer" name="organizer" class="form-control inTheNameOf">
      <option value="me">Ja som organizátor</option>
    </select>
    <span class="help-block"><img src="img/questionMark.png">
        <span class="tooltiptext">Zvoliť si môžete seba, alebo jednu zo stajní, ktorú spravujete.</span>
    </span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="eventName">Názov udalosti <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="eventName" name="eventName" type="text" placeholder="Krátky nadpis udalosti" class="form-control input-md" maxlength="200">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="eventDate">Dátum konania <span style="color:red">*</span></label>  
  <div class="col-md-4">
        <input id="eventDate" name="eventDate" type="text" placeholder="Vyberte z kalendára" class="form-control input-md" autocomplete="off">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="eventEnd">Dátum ukončenia <span style="color:red">*</span></label>  
  <div class="col-md-4">
        <input id="eventEnd" name="eventEnd" type="text" placeholder="Vyberte z kalendára" class="form-control input-md" autocomplete="off">
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="eventImage">Titulný obrázok udalosti na upútanie</label>
  <div class="col-md-4">
    <input id="eventImage" name="eventImage" class="input-file" type="file">
  </div>
</div>

<?php
include($_SERVER["DOCUMENT_ROOT"].'/assets/assetsLocations.php');
?>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="eventStreet">Adresa podujatia</label>  
  <div class="col-md-4">
  <input id="eventStreet" name="eventStreet" type="text" placeholder="Ulica a číslo a ďalšie detaily" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="eventFBLink">Odkaz na Facebook udalosť</label>  
  <div class="col-md-4">
  <input id="eventFBLink" name="eventFBLink" type="text" placeholder="Ak bola vytvorená" class="form-control input-md">
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="eventType">Typ udalosti</label>
  <div class="col-md-4">
    <select id="eventType" name="eventType" class="form-control multiselect" multiple="multiple">
        <?php
        foreach($xml->children() as $child)
        {
            if ($child->attributes() == 'events'){
                foreach($child->children() as $searchInput)
                {
                    if ($searchInput->attributes()['type'] == 'multiselect'){
                        foreach($searchInput->children() as $option)
                        {
                            echo '<option value="'.$option->attributes()['name'].'">'.$option->attributes()['name'].'</option>';
                        }
                    }
                }
            }
        }
        ?>
    </select>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" style="max-width:100%;text-align:center;" for="eventDescription">Detaily udalosti</label>
  <div class="">                     
    <textarea class="form-control description" id="eventDescription" name="eventDescription"></textarea>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="eventGallery">Pridajte fotky na upútanie</label>
  <div class="col-md-4">
    <input id="eventGallery" name="eventGallery" class="input-file" type="file" multiple>
  </div>
</div>

</fieldset>
</form>
