<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
            <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
            
	<?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
	<meta name="description" content="Jazdectvo je pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
    <title>Vytvoriť novinku / článok - <?php echo $siteName; ?></title>
    <?php
    include($_SERVER["DOCUMENT_ROOT"].'/styleSheets.php');
    ?>
    </head>
		<body>
		<?php 
			$news = "menu-active";
			include($_SERVER["DOCUMENT_ROOT"].'/header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Vytvoriť novinku / článok
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">Vytvoriť novinku / článok</a></p>
						</div>	
					</div>
				</div>
			</section>
            <!-- End banner Area -->
            <section class="newArticle" style="padding-top:30px;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-9 pb-40 header-text text-center">
                        <h2>Detaily článku / novinky</h2>
                        <form class="form-horizontal">
                        <fieldset>
                        <!-- Text input-->
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="newsTitle">Názov článku</label>  
                        <div class="col-md-5">
                        <input id="newsTitle" name="newsTitle" type="text" placeholder="Názov článku" class="form-control input-md" required="">
                            
                        </div>
                        </div>

                        <!-- Button Drop Down -->
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="categories">Kategória/-e článku</label>
                        <div class="col-md-5">
                            <div class="input-group">
                            <select multiple="multiple" id="categories" class="multiselect" name="">
                            </select>
                            </div>
                        </div>
                        </div>

                        <!-- File Button --> 
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="titleImage">Vybrať titulnú fotku</label>
                        <div class="col-md-4">
                            <input id="titleImage" name="titleImage" class="input-file" type="file">
                            <br>
                            <span>Optimálne rozlíšenie titulnej fotky je <b>700 x 400 (šírka x výška) </b></span>
                        </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group" style="display: block;text-align: center;">
                        <label class="col-md-4 control-label" for="body" style="display: block;max-width: 100%;text-align:center;font-weight:bold;font-size: 18px;">Obsah novinky</label>
                        <div class="col-md-4" style="max-width: 100%;text-align: center;">                     
                            <textarea class="form-control" id="body" name="body"></textarea>
                        </div>
                        <p>Článok po pridaní bude čakať na schválenie majiteľom iba kvôli kontrole chýb, ktoré sa sem tam prehliadnu :)</p>
                         <button type="button" class="btn btn-success submitButtons addNewArticle">Pridať</button>
                        </div>

                        </fieldset>
                        </form>
                    </div>
                </div>
            </section>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>	
            <script>
            fillCategories();
            initiateTinyMCE('#body');
            </script>
		</body>
	</html>



