<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Vyhľadať - <?php echo $siteName; ?></title>

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
								Hľadám službu		
							</h1>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Hľadám</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start Search Area -->
				<section class="upcoming-event-area section-gap">
					<div class="container">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pb-40 header-text text-center">
								<h1 class="pb-10">Vyhľadať <?php echo urldecode($_GET['what']); ?></h1>
								<div class="filter">
								<?php
									$xml=simplexml_load_file("assets/searchFilter.xml");
									foreach($xml->children() as $child)
									{
										if ($child->attributes() == urldecode($_GET['what'])){
											foreach($child->children() as $searchInput)
											{
												if ($searchInput->attributes()['type'] == 'select'){
													echo '<label><span class="filterName">'.$searchInput->attributes()['name'] . '</span><select class="'.$searchInput->attributes()['class'] . '" name="'.$searchInput->attributes()['name'] . '"></select></label><br>';
												}else{
													echo '<label><span class="filterName">'.$searchInput->attributes()['name'] . '</span><input placeholder="' . $searchInput->attributes()['placeholder'] . '" type="'.$searchInput->attributes()['type'] . '"></label><br>';
												}
											}
										}
									}
								?>
								<hr>
								</div>	
								<h4>Nájdené Výsledky</h4>
							</div>
						</div>							
					</div>
				</section>
			<!-- End Search Area -->
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	
		</body>
	</html>



