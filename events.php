<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Udalosti - <?php echo $siteName; ?></title>
		<?php
        include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$events = "menu-active";
			include('header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Nadchádzajúce udalosti		
							</h1>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Nadchádzajúce udalosti</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start upcoming-event Area -->
				<section class="upcoming-event-area section-gap">
					<div class="container">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pb-40 header-text text-center">
								<h1 class="pb-10">Nadchádzajúce udalosti od naších členov</h1>
								<p>
									Vyhľadajte udalosti / kurzy / tréningy od naších členov vo Vašom okolí
								</p>
								<?php
									$_GET['what'] = 'events';
									include('filter.php');
								?>
							</div>
						</div>							
						
					</div>
					<hr>
					<div class="container">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pb-40 header-text text-center">
								<h1 class="pb-10">Kalendár Slovenskej Jazdeckej Federácie</h1>
								<p>
									Kalendár je aktualizovaný Slovenskou Jazdeckou Federáciou
								</p>
							</div>
						</div>							
						<div id="divContainer" style="left: 50px; border: solid 2px #000;">
								<div id="frameContainer" style="overflow:hidden;">
									<iframe src="https://www.sjf.sk/sutaze/kalendar/" scrolling="yes" style="width: 100%; height: 900px; margin-top: -200px;">
									</iframe>
								</div>
						</div>
						<p>* V prípade, že vám kalendár nefunguje, skontrolujte či prehliadač nevyhadzuje hlášku o zablokovaných oknách - je potrebné povoliť</p>
					</div>
				</section>
			<!-- End upcoming-event Area -->
										
			<?php include('feedBacks.php'); ?>
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	
		</body>
	</html>



