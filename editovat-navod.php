<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
            <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
            
	<?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
    <title>Editovať návod - <?php echo $siteName; ?></title>
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
								Vytvoriť návod
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">Vytvoriť návod</a></p>
						</div>	
					</div>
				</div>
			</section>
            <!-- End banner Area -->
            <section class="newArticle" style="padding-top:30px;">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-9 pb-40 header-text text-center">
                        <h2>Detaily návodu</h2>
                        <form class="form-horizontal">
                        <fieldset>
                        <!-- Text input-->
                        <div class="form-group">
                        <label class="col-md-4 control-label" for="tutorialTitle">Názov návodu</label>  
                        <div class="col-md-5">
                        <input id="tutorialTitle" name="tutorialTitle" type="text" placeholder="Názov návodu" class="form-control input-md" required="">
                            
                        </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group" style="display: block;text-align: center;">
                        <label class="col-md-4 control-label" for="body" style="display: block;max-width: 100%;text-align:center;font-weight:bold;font-size: 18px;">Obsah návodu</label>
                        <div class="col-md-4" style="max-width: 100%;text-align: center;">                     
                            <textarea class="form-control" id="body" name="body"></textarea>
                        </div>
                         <button type="button" class="btn btn-success submitButtons updateTutorial">Upraviť</button>
                        </div>

                        </fieldset>
                        </form>
                    </div>
                </div>
            </section>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>	
            <script>
            initiateTinyMCE('#body');
            $(window).on('load', function () {
                fillEditTutorial();
            });
            </script>
		</body>
	</html>



