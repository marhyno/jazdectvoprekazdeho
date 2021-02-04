<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php 
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://' . $_SERVER['HTTP_HOST'] . '/api/callBackend/getAllArticlesSlugAndTitle'
	));
    // Send the request & save response to $resp
	$resp = json_decode(curl_exec($curl));
	?>
	<?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Sitemap - <?php echo $siteName; ?></title>
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
								Sitemap
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="javascript:history.go(-1)">Krok Späť</a></p>
						</div>	
					</div>
				</div>
			</section>
			<section>
			<div class="container">
			<br>
			<h4>Základné</h4>
			<br><a href="https://jazdectvoprekazdeho.sk/">Index</a>
			<br><a href="https://jazdectvoprekazdeho.sk/o-stranke.php">O Stránke</a>
			<br><a href="https://jazdectvoprekazdeho.sk/partneri.php">Partneri</a>
			<br><a href="https://jazdectvoprekazdeho.sk/chcem-vlastnit-kona.php">Chcem vlastniť koňa</a>
			<br><a href="https://jazdectvoprekazdeho.sk/chcem-jazdit-a-sutazit.php">Chcem jazdiť a súťažiť</a>
			<br><a href="https://jazdectvoprekazdeho.sk/szvj.php">Skúšky základného výcviku jazdca</a>
			<br><a href="https://jazdectvoprekazdeho.sk/anglicke-jazdenie.php">Anglické jazdenie</a>
			<br><a href="https://jazdectvoprekazdeho.sk/westernove-jazdenie.php">Westernové jazdenie</a>
			<br><a href="https://jazdectvoprekazdeho.sk/working-equitation.php">Working Equitation</a>
			<br><a href="https://jazdectvoprekazdeho.sk/navody-a-ziadosti.php">Návody a žiadosti</a>
			<br><br>

			<h4>Služby</h4>
			<br><a href="https://jazdectvoprekazdeho.sk/stajne-a-rance.php">Stajne a ranče</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Jazdenie / Výcvik">Jazdenie / Výcvik</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Prenájom koňa">Prenájom koňa</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Ustajnenie">Ustajnenie</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Tréner">Tréner</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Kováč">Kováč</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Sedlár">Sedlár</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Fyzioterapeut">Fyzioterapeut</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Veterinár">Veterinár</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Prevoz">Prevoz</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Strihač">Strihač</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Práca / Brigáda">Práca / Brigáda</a>
			<br><a href="https://jazdectvoprekazdeho.sk/vyhladat.php?what=Ostatné">Ostatné služby</a>
			<br><a href="https://jazdectvoprekazdeho.sk/pridat.php?what=inzerát">Pridať inzerát</a>
			<br><a href="https://jazdectvoprekazdeho.sk/pridat.php?what=stajňu">Pridať stajňu</a>
			<br><a href="https://jazdectvoprekazdeho.sk/pridat.php?what=službu">Pridať službu</a>
			<br><a href="https://jazdectvoprekazdeho.sk/pridat.php?what=udalosť">Pridať udalosť</a>
			<br><br>

			<h4>Ostatné</h4>
			<br><a href="https://jazdectvoprekazdeho.sk/kalendar.php">Kalendár</a>
			<br><a href="https://jazdectvoprekazdeho.sk/live-streams.php">Live Streamy</a>
			<br><a href="https://jazdectvoprekazdeho.sk/novinky-clanky.php">Novinky a články</a>
			<br><a href="https://jazdectvoprekazdeho.sk/bazar.php">Bazár</a>
			<br><a href="https://jazdectvoprekazdeho.sk/kontakt.php">Kontakt</a>
			<br><a href="https://jazdectvoprekazdeho.sk/prihlasenie/">Prihlásenie</a>
			<br><a href="https://jazdectvoprekazdeho.sk/prihlasenie/?register=register">Registrácia</a>
			<br><a href="https://jazdectvoprekazdeho.sk/ochrana-udajov.php">Ochrana údajov</a>
			</div>

			<br><br>

			<h4>Články</h4>
			<?php 
			foreach($resp[0] as $singleArticle){
				echo '<br><a href="https://jazdectvoprekazdeho.sk/clanok.php?nazov='. $singleArticle['slug'].'">'. $singleArticle['title'].'</a>';
			}
			?>
			</div>
			</section>
			<!-- End banner Area -->
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>	

		</body>
	</html>



