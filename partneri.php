<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
	<meta name="description" content="Podporujeme a zároveň nás podporujú partneri, ktorí robia koňský svet krajším a lepším.">
    <?php
        echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/partneri>"';
        echo '<meta property="og:title" content="Partneri - Jazdectvo pre každého" />';
        echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/1547163637277.png"/>';
        echo '<meta property="fb:app_id" content="425429784657516"/>';
    ?>	
		<title>Partneri - <?php echo $siteName; ?></title>
		<?php
        include($_SERVER["DOCUMENT_ROOT"].'/styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$hladam = "menu-active";
			include($_SERVER["DOCUMENT_ROOT"].'/header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Spolupráca
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="javascript:history.go(-1)">Krok Späť</a></p>
						</div>	
					</div>
				</div>
			</section>
            <section>
            <p>
            <h3 class="text-center pb-10 text-black" style="text-decoration:underline;">Podporujú nás partneri</h3>
            </p>
            <a class="partnersLinks" href="http://www.podkuvaci.sk" target="_blank">
                <h4>Slovenský Podkúvačský Cech</h4>
                <img src="/img/partners/spc.png" alt="">
                <p>Slovenský Podkúvačský Cech (SPC) je organizácia zameraná na presadzovanie profesijného rozvoja podkúvačov, poskytuje vedenie a zdroje v prospech podkúvačstva a taktiež zlepšuje životné podmienky koňa cez vzdelávanie podkúvačov.</p>
            </a>
			<hr>
            <a class="partnersLinks" href="http://http://www.infoendurance.sk" target="_blank">
                <h4>Slovenská komisia vytrvalostného jazdenia</h4>
                <img src="/img/partners/endurance.png" alt="">
                <p>Oficiálna stránka komisie vytrvalostného jazdenia na Slovensku.</p>
            </a>
			<hr>
            <a class="partnersLinks" href="http://organicgreenfeed.eu" target="_blank">
                <h4>Organic green feed</h4>
                <img src="/img/partners/ogf.jpg" alt="">
                <p>Výrobca a dodávateľ širokej škály hydroponických zelených krmív ako je mladý ovos, mladá pšenica, mladý jačmeň, mladá kukurica atď.</p>
            </a>
            <hr>
            <a class="partnersLinks" href="http://www.icsr.sk" target="_blank">
                <h4>Írsky Cob Slovenská republika</h4>
                <img src="/img/partners/icsr.png" alt="">
                <p>Združujeme majiteľov, chovateľov a priaznivcov plemena.</p>
            </a>
            </section>
			<!-- End banner Area -->
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>	

		</body>
	</html>



