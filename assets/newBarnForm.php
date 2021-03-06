<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend><?php echo $title = basename($_SERVER['PHP_SELF']) == 'editovat.php' ? "Upraviť údaje stajne" : "Detaily novej stajne"; ?></legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnName">Názov stajne <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="barnName" name="barnName" type="text" placeholder="Názov stajne" class="form-control input-md" maxlength="200">
    
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="barnImage">Titulný obrázok stajne</label>
  <div class="col-md-4">
    <input id="barnImage" name="barnImage" class="input-file" type="file">
  </div>
</div>

<?php
include($_SERVER["DOCUMENT_ROOT"].'/assets/assetsLocations.php');
?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnStreet">Ulica a číslo</label>  
  <div class="col-md-4">
  <input id="barnStreet" name="barnStreet" type="text" placeholder="Ulica a číslo a ďalšie detaily" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnPhone">Telefonický kontakt <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="barnPhone" name="barnPhone" type="text" placeholder="Telefonický kontakt" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnContactPerson">Kontaktná osoba </label>  
  <div class="col-md-4">
  <input id="barnContactPerson" name="barnContactPerson" type="text" placeholder="Kontaktná osoba" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnEmail">Email <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="barnEmail" name="barnEmail" type="text" placeholder="Email" class="form-control input-md">
  </div>
</div>

<!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnRidingStyle">Jazdecké štýly</label>
  <div class="col-md-4">
    <select id="barnRidingStyle" name="barnRidingStyle" class="form-control multiselect" multiple="multiple">
      <option value="Anglické jazdenie">Anglické jazdenie</option>
      <option value="Westernové jazdenie">Westernové jazdenie</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnHorseTypes">Aké typy koní máme</label>  
  <div class="col-md-4">
  <input id="barnHorseTypes" name="barnHorseTypes" type="text" placeholder="napr. Quarter Horses, Slovenské teplokrvníky, hucule, rôzne, atď." class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnFacebook">Odkaz na Facebook</label>  
  <div class="col-md-4">
  <input id="barnFacebook" name="barnFacebook" type="text" placeholder="Vložte link na FB stránku" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnInstagram">Odkaz na Instagram</label>  
  <div class="col-md-4">
  <input id="barnInstagram" name="barnInstagram" type="text" placeholder="Vložte link na Instagram" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnTwitter">Odkaz na Twitter</label>  
  <div class="col-md-4">
  <input id="barnTwitter" name="barnTwitter" type="text" placeholder="Vložte link na Twitter" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnYoutube">Odkaz na Youtube kanál</label>  
  <div class="col-md-4">
  <input id="barnYoutube" name="barnYoutube" type="text" placeholder="Vložte odkaz na Youtube" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="barnOpenHours" style="vertical-align: top;">Otváracie hodiny</label>  
  <div class="col-md-4">
        <table id='barnOpenHours' class="openHours">
        <tr><th>Pondelok</th><td><select><?php include('openHours.php') ?></select></td><td>-</td><td><select><?php include('openHours.php') ?></select></td></tr>
        <tr><th>Utorok</th><td><select><?php include('openHours.php') ?></select></td><td>-</td><td><select><?php include('openHours.php') ?></select></td></tr>
        <tr><th>Streda</th><td><select><?php include('openHours.php') ?></select></td><td>-</td><td><select><?php include('openHours.php') ?></select></td></tr>
        <tr><th>Štvrtok</th><td><select><?php include('openHours.php') ?></select></td><td>-</td><td><select><?php include('openHours.php') ?></select></td></tr>
        <tr><th>Piatok</th><td><select><?php include('openHours.php') ?></select></td><td>-</td><td><select><?php include('openHours.php') ?></select></td></tr>
        <tr><th>Sobota</th><td><select><?php include('openHours.php') ?></select></td><td>-</td><td><select><?php include('openHours.php') ?></select></td></tr>
        <tr><th>Nedeľa</th><td><select><?php include('openHours.php') ?></select></td><td>-</td><td><select><?php include('openHours.php') ?></select></td></tr>
        </table>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" style="max-width:100%;text-align:center;" for="barnDescription">Popis stajne</label>
  <div class="">                     
    <textarea class="form-control description" id="barnDescription" name="barnDescription"></textarea>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="barnGallery">Pridajte fotky do galérie stajne</label>
  <div class="col-md-4">
    <input id="barnGallery" name="barnGallery" class="input-file" type="file" multiple>
  </div>
</div>

</fieldset>
</form>