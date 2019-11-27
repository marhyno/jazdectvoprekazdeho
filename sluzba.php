<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php 
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://' . $_SERVER['HTTP_HOST'] . '/api/callBackend/getServiceDetails/'.$_GET['ID']
    ));

    // Send the request & save response to $resp
    $resp = json_decode(curl_exec($curl),true);
    echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/sluzba.php?ID=' . $resp['generalDetails'][0]['ID'] . '" />';
    echo '<meta property="og:title" content="Ponuka služby - '.$resp['generalDetails'][0]['type'].' - '.($resp['generalDetails'][0]['barnName'] == "" ? $resp['generalDetails'][0]['fullName'] : $resp['generalDetails'][0]['fullName']) . '" />';
    echo '<meta property="og:description" content="'.substr(strip_tags($resp['generalDetails'][0]['descriptionOfService']),0,150).'" />';
    echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . $resp['generalDetails'][0]['serviceImage'] . '"/>';
    echo '<meta property="fb:app_id" content="425429784657516"/>';
    include('meta.php');
    ?>
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
							<h2 class="text-white" id="serviceName">
								
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="javascript:history.go(-1)">Krok Späť</a></p>
						</div>	
					</div>
				</div>
			</section>
            <!-- Start barn details data -->
				<section>
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex">
								<div id="serviceDetails">
								</div>
						</div>
					</div>
				</section>
			<!-- End profile data -->
			<hr>
			<!-- Start barn services data -->
				<section class="justify-content-center" id="servicesBarnsEvents">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center" id="offeredServices">			                                           
						</div>
					</div>
				</section>
                <!-- End services data -->
                <section class="justify-content-center" style="width:100%;" id="gallery">
                <h3>Galéria</h3>
                    <?php include('gallerySlider.php'); ?>
                </section>
			<?php include('footer.php'); ?>
            <?php include('footerScripts.php'); ?>	

		</body>
	</html>



