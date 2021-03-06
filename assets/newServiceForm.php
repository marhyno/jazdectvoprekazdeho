<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend><?php echo $title = basename($_SERVER['PHP_SELF']) == 'editovat.php' ? "Upraviť údaje služby" : "Detaily novej služby"; ?></legend>
<p class="text-center">Novú službu je možné pridať vo svojom mene alebo v mene stajne. Vo svojom mene znamená, že som kováč alebo fyzioterapeut koní, ponúkam jazdenie, atď. a ponúkam svoje služby ako súkromník. Pridanie služby v menej stajne znamená, že stajňa zahrňuje túto službu. V tomto prípade budú kontaktné údaje použité z existujúcej stajne.</p>
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceProvider">V mene koho ponúkam službu <span style="color:red">*</span></label>
  <div class="col-md-4">
    <select id="serviceProvider" name="serviceProvider" class="form-control inTheNameOf">
      <option value="me">Za seba</option>
    </select>
    <span class="help-block"><img src="img/questionMark.png">
        <span class="tooltiptext">Zvoliť si môžete seba, alebo jednu zo stajní, ktorú spravujete.</span>
    </span>
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

<!-- Text input-->
<div class="form-group" id="serviceNameFormGroup">
  <label class="col-md-4 control-label" for="serviceNameForm">Názov služby</label>  
  <div class="col-md-4">
  <input id="serviceNameForm" name="serviceNameForm" type="text" placeholder="napr. Strihanie, Fotenie, Psychológ" class="serviceNameForm form-control input-md">
    
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
  <input id="street" name="street" type="text" placeholder="popis kde sídlite" class="street form-control input-md">
    
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

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceFacebook">Odkaz na Facebook</label>  
  <div class="col-md-4">
  <input id="serviceFacebook" name="serviceFacebook" type="text" placeholder="Vložte link na FB stránku" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceInstagram">Odkaz na Instagram</label>  
  <div class="col-md-4">
  <input id="serviceInstagram" name="serviceInstagram" type="text" placeholder="Vložte link na Instagram" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceTwitter">Odkaz na Twitter</label>  
  <div class="col-md-4">
  <input id="serviceTwitter" name="serviceTwitter" type="text" placeholder="Vložte link na Twitter" class="form-control input-md">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="serviceYoutube">Odkaz na Youtube kanál</label>  
  <div class="col-md-4">
  <input id="serviceYoutube" name="serviceYoutube" type="text" placeholder="Vložte odkaz na Youtube" class="form-control input-md">
  </div>
</div>


<!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="specialServiceCriteria">Pridajte detaily služby</label>
  <div class="col-md-4">
    <select id="specialServiceCriteria" name="specialServiceCriteria" class="form-control multiselect" multiple="multiple">
    </select>
    <span class="help-block"><img src="img/questionMark.png">
        <span class="tooltiptext">Možnosti sa objavia po vybratí typu služby v menu vyššie.</span>
  </span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="workHours" style="vertical-align: top;">V ktorých časoch ponúkam službu</label>  
  <div class="col-md-4">
        <table id='workHours' class="openHours">
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
