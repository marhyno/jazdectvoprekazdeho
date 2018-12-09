<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Bazár - <?php echo $siteName; ?></title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>
		<?php include('header.php'); ?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Bazár - predám & kúpim		
							</h1>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Bazár</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start Search Area -->
				<section class="upcoming-event-area section-gap">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pb-40 header-text text-center">
								<h1 class="pb-10">Bazár</h1>
								<hr>
								<nav class="navigation">
									<ul class="mainmenu">
									<?php
										$xml=simplexml_load_file("assets/marketSearchFilter.xml");
										foreach($xml->children() as $child)
										{
											echo '<li><a class="showHideSubMenu" href="#a">'.$child->attributes()['name'].'</a>';
											echo '<ul class="submenu">';
											foreach ($child->children() as $subMenu) {
												echo '<li><a href="#a">'.$subMenu .'</a></li>';
											}
											echo '</ul>
												</li>';
										}
									?>
									</ul>
								</nav>
								<h4 id="marketFoundHeader">Nájdené Výsledky</h4>
							</div>
						</div>							
					</div>
				</section>
			<!-- End Search Area -->
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	
		</body>
	</html>



