<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Všetky novinky & články - <?php echo $siteName; ?></title>
		<?php
        include($_SERVER["DOCUMENT_ROOT"].'/styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$news = "menu-active";
			include($_SERVER["DOCUMENT_ROOT"].'/header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Všetky novinky & články
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">Všetky novinky & články</a></p>
						</div>	
					</div>
				</div>
            </section>
            <section class="relative">
				<div class="container">		
					<div class="row d-flex align-items-center justify-content-center">
                        <h3 class="noPadding">Zoznam všetkých noviniek</h3>
                        <div class="col-lg-12" id="allNews">
						</div>
					</div>
				</div>
			</section>
			<!-- End banner Area -->
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>	

        </body>
        <script>
        getAllNewsList();
		</script>
	</html>



