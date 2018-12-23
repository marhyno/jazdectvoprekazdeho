<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title><?php echo $siteName; ?></title>
		<?php
        include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			include('header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white" id="barnName">
								Test
							</h1>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="javascript:history.go(-1)">Krok Späť</a></p>
						</div>	
					</div>
				</div>
			</section>
            <!-- Start barn details data -->
				<section>
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex">
								<div id="barnDetails">
								</div>
						</div>
					</div>
				</section>
			<!-- End profile data -->
			<hr>
			<!-- Start barn services data -->
				<section class="justify-content-center" id="servicesAndBarns">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center" id="offeredServices">			                                           
						</div>
					</div>
				</section>
                <!-- End services data -->
                <section class="justify-content-center" style="width:100%;" id="gallery">
                    <?php include('gallerySlider.php'); ?>
                </section>
			<?php include('footer.php'); ?>
            <?php include('footerScripts.php'); ?>	

		</body>
	</html>



