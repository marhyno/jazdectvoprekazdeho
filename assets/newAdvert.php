<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend><?php echo $title = basename($_SERVER['PHP_SELF']) == 'editovat.php' ? "Upraviť inzerát" : "Pridať inzerát do bazáru"; ?></legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="marketTitle">Názov inzerátu <span style="color:red">*</span></label>  
  <div class="col-md-4">
    <input id="marketTitle" name="marketTitle" type="text" placeholder="Názov inzerátu" class="form-control input-md" maxlength="200">
    <span class="help-block"><img src="img/questionMark.png">
        <span class="tooltiptext">Použite čo najvýstižnejší názov, napr. Predávam dámske rajtky / Hľadám ohlávku veľkost cob</span>
    </span>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="offerOrSearch">Ponuka / Dopyt <span style="color:red">*</span></label>
  <div class="col-md-4">
    <select id="offerOrSearch" name="offerOrSearch" class="form-control">
    <option value="Ponúkam">Ponúkam</option>
    <option value="Hľadám">Hľadám</option>
    </select>
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
  <label class="col-md-4 control-label" for="priceMarket">Cena <span style="color:red">*</span></label>  
  <div class="col-md-4">
    <input id="priceMarket" name="priceMarket" type="text" placeholder="Cena" class="form-control input-md">
    <span class="help-block"><img src="img/questionMark.png">
        <span class="tooltiptext">Presná cena alebo rozsah od-do alebo dohoda alebo zadarmo</span>
    </span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="advertPassword">Heslo <span style="color:red">*</span></label>  
  <div class="col-md-4">
  <input id="advertPassword" name="advertPassword" type="password" placeholder="Zvoľte heslo kvôli editácii inzerátu" class="form-control input-md">
  <span class="help-block"><img src="img/questionMark.png">
    <span class="tooltiptext">Heslo je potrebné na editovanie inzerátu a zmazanie inzerátu ak nebudete prihlásený. Ináč ho môžete editovať cez Váš profil.</span>
  </span>
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
  <label class="col-md-4 control-label" for="marketGalleries">Pridajte fotky </label>
  <div class="col-md-4">
    <input id="marketGalleries" name="marketGalleries" class="input-file" type="file" multiple>
  </div>
</div>

</fieldset>
</form>
