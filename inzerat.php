<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php 
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://' . $_SERVER['HTTP_HOST'] . '/api/callBackend/getAdvertInfo/'.$_GET['ID']
        ));
        // Send the request & save response to $resp
        $resp = json_decode(curl_exec($curl),true);
        echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/inzerat.php?ID=' . $resp['generalDetails'][0]['ID'] . '" />';
        echo '<meta property="og:title" content="'.$resp['generalDetails'][0]['title'].' - Inzerát" />';
        echo '<meta property="og:description" content="'.substr(strip_tags($resp['generalDetails'][0]['details']),0,150).'" />';
        echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . $resp['gallery'][0]['imageLink'] . '"/>';
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
							<h2 class="text-white" id="advert">
								
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="javascript:history.go(-1)">Krok Späť</a></p>
						</div>	
					</div>
				</div>
			</section>
            <!-- Start event details data -->
            <section>
                <div class="container" style="max-width: 100%;">
                    <div class="row d-flex">
                            <div id="advertDetails">
                            </div>
                    </div>
                </div>
            </section>
			<!-- End event data -->
            <section class="justify-content-center" style="width:100%;" id="gallery">
            <h3>Galéria</h3>
                <?php include('gallerySlider.php'); ?>
            </section>
            <section>
                <div class="container" style="max-width: 100%;">
                    <div class="row d-flex">
                            <div id="advertContact">
                            </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="container" style="max-width: 100%;">
                    <div class="row d-flex">
                        <div id="sendMessageToAdvertiser">
                                <label class="col-md-6 control-label" style="max-width:100%;text-align:center;" for="messageArea">Kontaktovať inzerenta</label>
                                <div class="">       
                                    <label for="messageEmail">Váš email</label><br>
                                    <input type="text" name="messageEmail" style="min-width:300px;" placeholder="meno@email" id="messageEmail"><br>
                                    <label for="messageArea">Vaša správa</label>
                                    <textarea class="form-control description" id="messageArea" name="messageArea">Dobrý deň,&#13;kontaktujem Vás ohľadom inzerátu - </textarea>
                                    <div class="g-recaptcha" data-sitekey="6LerPp0UAAAAALOnCmJdw47wU_Yt_6zWfAsqx0Ze" style="margin: 5px;"></div>
                                    <p class="msg-error"></p>
                                    <a class="primary-btn" id="sendMessage">Odoslať</a>
                                </div>
                        </div>
                    </div>
                </div>
            </section>
			<?php include('footer.php'); ?>
            <?php include('footerScripts.php'); ?>	

		</body>
	</html>



