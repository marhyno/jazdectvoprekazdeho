<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
    <?php 
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://' . $_SERVER['HTTP_HOST'] . '/api/callBackend/getSingleTutorial/'.$_GET['nazov']
    ));
    // Send the request & save response to $resp
    $resp = json_decode(curl_exec($curl));
    echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/navody-a-ziadosti.php?nazov=' . $resp[0] -> ID . '" />';
    echo '<meta property="og:title" content="'.$resp[0] -> title.'" />';
    echo '<meta property="og:description" content="'.substr(strip_tags($resp[0] -> content),0,200).'..." />';
        echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/tutorialCoverImage.png"/>';
    echo '<meta property="fb:app_id" content="425429784657516"/>';
    ?>
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
            <p>Na tejto stránke budú uverejnené rôzne návody ako vybaviť žiadosti - napr. prepis koňa, registrácia farmy, preukaz pre žrebcov, atď.</p>
            <p>Máte nejaký návod, ktorý chcete zdieľať a pomôcť tak ostatným ? <a href="mailto:info@jazdectvoprekazdeho.sk?Subject=Nový návod / žiadosť">Napíšte nám !</a></p>
            <p>Neviete v akej forme nám poslať návod a čo všetko by tam malo byť ? S vytváraním vám radi pomôžeme.</a></p>

            <h3>Vyberte si zo zoznamu návodov / žiadostí</h3>
            <select name="chooseTutorial" id="chooseTutorial" class="mt-10"></select>
            <hr>
            <div class="pt-20" id="tutorialContent">
            <?php 
            echo '<h3>' .$resp[0]->title. '</h3><br>' .$resp[0]->content;
            ?>
            </div>
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



