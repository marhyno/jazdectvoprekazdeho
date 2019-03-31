<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Návody a žiadosti - <?php echo $siteName; ?></title>
		<?php
        include($_SERVER["DOCUMENT_ROOT"].'/styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$education = "menu-active";
			include($_SERVER["DOCUMENT_ROOT"].'/header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Návody a žiadosti
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="javascript:history.go(-1)">Krok Späť</a></p>
						</div>	
					</div>
				</div>
			</section>
            <section class="text-center pb-10 pt-10">
            <h3>Pripravujeme</h3>
            <br>
            <p>Na tejto stránke budú uverejnené rôzne návody ako vybaviť žiadosti - napr. prepis koňa, registrácia farmy, preukaz pre žrebcov, atď.</p>
            <p>Máte nejaký návod, ktorý chcete zdieľať a pomôcť tak ostatným ? <a href="mailto:info@jazdectvoprekazdeho.sk?Subject=Nový návod / žiadosť">Napíšte nám !</a></p>
            <p>Neviete v akej forme nám poslať návod a čo všetko by tam malo byť ? S vytváraním vám radi pomôžeme.</a></p>

            <h3>Vyberte si zo zoznamu návodov / žiadostí</h3>
            <select name="chooseTutorial" id="chooseTutorial" class="mt-10"></select>
            <div class="pt-20" id="tutorialContent"></div>
            </section>
			<!-- End banner Area -->
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>	
            <script>
            $(window).on('load', function () {
               fillTutorialsMenu();
            });
            </script>
		</body>
	</html>



