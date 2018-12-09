	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<?php include('meta.php'); ?>
		<title>Kontakt - <?php echo $siteName; ?></title>

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
								Kontaktujte nás
							</h1>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Kontaktujte nás</a></p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start contact-page Area -->
			<section class="contact-page-area section-gap">
				<div class="container">
					<div class="row">
						<!--<div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>-->
						<div class="col-lg-4 d-flex flex-column address-wrap">
							<div class="single-contact-address d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-home"></span>
								</div>
								<div class="contact-details">
									<h5>Košice</h5>
								</div>
							</div>
							<div class="single-contact-address d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-envelope"></span>
								</div>
								<div class="contact-details">
									<h5>info@jazdectvoprekazdeho.sk</h5>
									<p>Pošlite nám Váš odkaz kedykoľvek</p>
								</div>
							</div>														
						</div>
						<div class="col-lg-8">
							<form class="form-area " id="myForm" action="mail.php" method="post" class="contact-form text-right">
								<div class="row">	
									<div class="col-lg-6 form-group">
										<input name="name" placeholder="Vaše meno" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" required="" type="text">
									
										<input name="email" placeholder="Vaša emailová adresa" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="email">

										<input name="subject" placeholder="Predmet" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your subject'" class="common-input mb-20 form-control" required="" type="text">
										<div class="mt-20 alert-msg" style="text-align: left;"></div>
									</div>
									<div class="col-lg-6 form-group">
										<textarea class="common-textarea form-control" name="message" placeholder="Správa" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Správa'" required=""></textarea>
										<button class="primary-btn mt-20 text-white" style="float: right;">Odoslať správu</button>
																				
									</div>
								</div>
							</form>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End contact-page Area -->

			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>
		</body>
	</html>


