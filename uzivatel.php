<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Profil užívateľa - <?php echo $siteName; ?></title>
        <?php
        include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			//no menu selected
			include('header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white" id="usersFullName">  		
							</h2>	
						</div>	
					</div>
                    <div id="imageBorder"><img src="/img/userImages/noProfilePicture.png" alt=""></div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start profile data -->
				<section class="section-gap justify-content-center">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center">
								<div id="userDetails">
									<h3>Detaily užívateľa</h3>
								</div>
						</div>
						<div class="row d-flex justify-content-center">
						</div>
					</div>
				</section>
			<!-- End profile data -->
			<hr>
			<!-- Start services data -->
            <section class="justify-content-center" id="servicesBarnsEvents">
                <div class="container" style="max-width: 100%;">
                </div>
            </section>
			<!-- End services data -->

			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	
		</body>
	</html>



