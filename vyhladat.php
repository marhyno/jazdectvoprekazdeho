<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Vyhľadať - <?php echo urldecode($_GET['what']); ?> - <?php echo $siteName; ?></title>
		<?php
        include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$hladam = "menu-active";
			include('header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home" style="display:none;">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Hľadám službu		
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Hľadám</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start Search Area -->
            <section class="search-service section-gap">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-9 pb-40 header-text text-center">
                            <h3 class="pb-10">Vyhľadať - <span id="serviceType"><?php echo urldecode($_GET['what']); ?></span></h3>
                            <?php
                            include('filter.php');
                            ?>
                            <h4 id="assetsFound"></h4>
                            <div id="serviceSearchResults">
                            </div>	
                        </div>
                    </div>							
                </div>
            </section>
			<!-- End Search Area -->
			<?php include('footer.php'); ?>
            <?php include('footerScripts.php'); ?>	
            <script>
            $(window).on('load', function () {
                fillFilterWithGetValues();
                performSearch();
            });
            </script>
        </body>
	</html>



