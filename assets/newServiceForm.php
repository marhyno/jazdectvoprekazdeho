<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Detaily novej služby</legend>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceProvider">V mene koho ponúkam službu <span style="color:red">*</span></label>
  <div class="col-md-4">
    <select id="serviceProvider" name="serviceProvider" class="form-control inTheNameOf">
      <option value="me">Za seba</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="type">Typ služby <span style="color:red">*</span></label>
  <div class="col-md-4">
    <select id="type" name="type" class="form-control">
        <option value=""></option>
        <?php
        foreach($xml->children() as $child)
        {
            if ($child->attributes()['visibleInMenu'] == 'yes')
            {
                echo '<option value="' . $child->attributes() . '">' . $child->attributes() . '</option>';
            }
        }
        ?>
    </select>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceImage">Titulný obrázok ktorým zaujmete</label>
  <div class="col-md-4">
    <input id="serviceImage" name="serviceImage" class="input-file" type="file">
  </div>
</div>


<?php
include($_SERVER["DOCUMENT_ROOT"].'/assets/assetsLocations.php');
?>


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="street">Ulica a číslo</label>  
  <div class="col-md-4">
  <input id="street" name="street" type="text" placeholder="popis kde sídlite" class="form-control input-md">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="isWillingToTravel">Som ochotný cestovať</label>
  <div class="col-md-4">
    <select id="isWillingToTravel" name="isWillingToTravel" class="form-control">
      <option value="Áno">Áno</option>
      <option value="Nie">Nie</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rangeOfOperation">Som ochotný cestovať do vzdialenosti</label>  
  <div class="col-md-4">
  <input id="rangeOfOperation" name="rangeOfOperation" type="text" placeholder="v km" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="price">Cena služby <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="price" name="price" type="text" placeholder="presná alebo rozsah od-do alebo dohoda" class="form-control input-md">
    
  </div>
</div>

<!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="specialServiceCriteria">Pridajte detaily služby</label>
  <div class="col-md-4">
    <select id="specialServiceCriteria" name="specialServiceCriteria" class="form-control multiselect" multiple="multiple">
    </select>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" style="max-width:100%;text-align:center;" for="descriptionOfService">Popis služby</label>
  <div class="">                     
    <textarea class="form-control description" id="descriptionOfService" name="barnDescription"></textarea>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceGallery">Pridajte fotky na upútanie</label>
  <div class="col-md-4">
    <input id="serviceGallery" name="serviceGallery" class="input-file" type="file" multiple>
  </div>
</div>

</fieldset>
</form>
