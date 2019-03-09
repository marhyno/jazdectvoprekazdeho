<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Bazár jazdeckých potrieb, koní, kníh, jednoducho všetkého čo k jazdectvu patrí.">	
    <meta name="keywords" content="bazar jazdeckych potrieb jazdecke potreby kupim predam jazdectvo kone knihy">
	<title>Bazár - <?php echo $siteName; ?></title>
    <?php
        echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/bazar.php"';
        echo '<meta property="og:title" content="Bazár - Jazdectvo pre každého" />';
        echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/1547163637277.png"/>';
        echo '<meta property="fb:app_id" content="425429784657516"/>';
    ?>	
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
                                    <li id="offerOrSearch">
                                        <label>Ponuka<input type="radio" name="marketOfferOrSearch" class="marketOfferOrSearch" value="Ponúkam"></label>
                                        <label>Dopyt<input type="radio" name="marketOfferOrSearch" class="marketOfferOrSearch" value="Hľadám"></label>
                                    </li>
									<?php
										$xml=simplexml_load_file("assets/marketSearchFilter.xml");
										foreach($xml->children() as $child)
										{
											echo '<li><a class="showHideSubMenu" data-mainMenu="'.$child->attributes()['name'].'">'.$child->attributes()['name'].'<i class="arrow down"></i></a>';
											echo '<ul class="submenu">';
											foreach ($child->children() as $subMenu) {
												echo '<li><a href="" data-subMenu="'.$subMenu .'">'.$subMenu .'</a></li>';
											}
											echo '</ul>
												</li>';
										}
									?>
									</ul>
								</nav>
								<h4 id="assetsFound"></h4>
								<div id="resultsOfMarketSearch"></div>
							</div>
						</div>							
					</div>
				</section>
			<!-- End Search Area -->
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	
            <script>
            $(window).on('load', function () {
                if ($(window).width() < 960) {
                    $('.navigation').insertAfter('#resultsOfMarketSearch')
                }
                fillFilterWithGetValues();
                performSearch();
            });
            </script>
		</body>
	</html>



