<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Pridať nový inzerát v bazári</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="marketTitle">Názov inzerátu <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="marketTitle" name="marketTitle" type="text" placeholder="Názov inzerátu" class="form-control input-md" maxlength="200">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="mainCategory">Kategória <span style="color:red">*</span></label>
  <div class="col-md-4">
    <select id="mainCategory" name="mainCategory" class="form-control">
        <option value=""></option>
        <?php
        foreach($xml->children() as $child)
        {
            echo '<option value="' . $child->attributes()['name'] . '">' . $child->attributes()['name'] . '</option>';
        }
        ?>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="subCategory">Podkategória <span style="color:red">*</span></label>
  <div class="col-md-4">
    <select id="subCategory" name="subCategory" class="form-control">
    </select>
  </div>
</div>

<?php
$xml=simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/assets/searchFilter.xml');
include($_SERVER["DOCUMENT_ROOT"].'/assets/assetsLocations.php');
?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="marketPhone">Telefonický kontakt <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="marketPhone" name="marketPhone" type="text" placeholder="Telefonický kontakt" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="marketContactPerson">Vaše meno <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="marketContactPerson" name="marketContactPerson" type="text" placeholder="Kontaktná osoba" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="marketEmail">Email <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="marketEmail" name="marketEmail" type="text" placeholder="Email" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="priceMarket">Cena<span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="priceMarket" name="priceMarket" type="text" placeholder="Presná alebo rozsah od-do alebo dohoda" class="form-control input-md">
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" style="max-width:100%;text-align:center;" for="marketDescription">Detail inzerátu</label>
  <div class="">                     
    <textarea class="form-control description" id="marketDescription" name="marketDescription"></textarea>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="marketGallery">Pridajte fotky </label>
  <div class="col-md-4">
    <input id="marketGallery" name="marketGallery" class="input-file" type="file" multiple>
  </div>
</div>

</fieldset>
</form>
