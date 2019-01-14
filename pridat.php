<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include($_SERVER["DOCUMENT_ROOT"].'/meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Pridať <?php echo urldecode($_GET['what']); ?> - <?php echo $siteName; ?></title>
		<?php
        include($_SERVER["DOCUMENT_ROOT"].'/styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			include($_SERVER["DOCUMENT_ROOT"].'/header.php'); 
		?>
			<!-- start banner Area -->
			<!--<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Pridať novú <?php echo urldecode($_GET['what']); ?>
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="javascript:history.go(-1)">Krok Späť</a></p>
						</div>	
					</div>
				</div>
			</section>-->
			<!-- End banner Area -->
            <!-- Start Add New -->
				<section class="newAsset">
					<div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-9 pb-40 header-text text-center">
                                <?php
                                $xml=simplexml_load_file($_SERVER["DOCUMENT_ROOT"].'/assets/searchFilter.xml');

                                switch (urldecode($_GET['what'])) {
                                    case 'stajňu':
                                        include($_SERVER["DOCUMENT_ROOT"].'/assets/newBarnForm.php');
                                        break;
                                    case 'službu':
                                        include($_SERVER["DOCUMENT_ROOT"].'/assets/newServiceForm.php');
                                        break;
                                    case 'udalosť':
                                        include($_SERVER["DOCUMENT_ROOT"].'/assets/newEventForm.php');
                                        break;
                                    default:
                                        break;
                                }
                                ?>
                            <button type="button" class="btn btn-success submitButtons addAsset">Pridať</button>	
							</div>
                        </div>						
					</div>
				</section>
			<!-- End Add New -->

			<?php include($_SERVER["DOCUMENT_ROOT"].'/footer.php'); ?>
			<?php include($_SERVER["DOCUMENT_ROOT"].'/footerScripts.php'); ?>	

        </body>
        <script>
            initiateTinyMCE('.description');
            $(document).ready(function () {
                $('.locationRegion,.locationLocalCity').prop('disabled',true);
                $(document).on('change','.locationProvince',function () {  
                    $('.locationRegion').prop('disabled',false);
                });

                $(document).on('change','.locationRegion',function () {  
                    $('.locationLocalCity').prop('disabled',false);
                });

                $(document).on('change','#type',function () {  
                    getSpecialServiceCriteria();
                });

                console.log(findGetParameter('what'));
                
                switch (decodeURIComponent(findGetParameter('what'))) {
                    case 'stajňu':
                        $('.newAsset').append('<img class="assetBackground" src="/img/stables.jpg">');
                        break;
                    case 'službu':
                        $('.newAsset').append('<img class="assetBackground" src="/img/blacksmith.jpg">');
                        getUserBarns(fillOrganizerDropdown); 
                        break;
                    case 'udalosť':
                        $('.newAsset').append('<img class="assetBackground" src="/img/event.jpg">');
                        getUserBarns(fillOrganizerDropdown); 
                        break;
                    default:
                        break;
                }
            });

        </script>
	</html>



