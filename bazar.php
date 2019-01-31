<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Bazár - <?php echo $siteName; ?></title>
		<?php
        	include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$market = "menu-active";
			include('header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home" style="display:none">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Bazár - predám & kúpim		
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Bazár</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start Search Area -->
				<section class="marketArea section-gap">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center">
							<div class="col-md-12 pb-40 header-text text-center">
                                <h3 class="pb-10">Bazár - predám & kúpim</h3>
								<?php
								$_GET['what'] = 'bazar';
								include('filter.php');
								?>
								<nav class="navigation">
                                    <h3>Kategórie</h3>
									<ul class="mainmenu">
									<?php
										$xml=simplexml_load_file("assets/marketSearchFilter.xml");
										foreach($xml->children() as $child)
										{
											echo '<li><a class="showHideSubMenu">'.$child->attributes()['name'].'<i class="arrow down"></i></a>';
											echo '<ul class="submenu">';
											foreach ($child->children() as $subMenu) {
												echo '<li><a href="">'.$subMenu .'</a></li>';
											}
											echo '</ul>
												</li>';
										}
									?>
									</ul>
								</nav>
								<h4 id="marketFoundHeader">Nájdené Výsledky <span id="resultNumber"></span></h4>
								<div id="resultsOfMarketSearch"></div>
							</div>
						</div>							
					</div>
				</section>
			<!-- End Search Area -->
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	
		</body>
	</html>



