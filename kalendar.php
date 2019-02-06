<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Kalendár podujatí od naších členov a tiež od SJF, FEI a EuroRodeo.">	
	<title>Udalosti - <?php echo $siteName; ?></title>
    <?php
        echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/kalendar.php>"';
        echo '<meta property="og:title" content="Kalendár podujatí - Jazdectvo pre každého" />';
        echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/1547163637277.png"/>';
        echo '<meta property="fb:app_id" content="425429784657516"/>';
    ?>
		<?php
        include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$events = "menu-active";
			include('header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Nadchádzajúce udalosti		
                            </h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Nadchádzajúce udalosti</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start upcoming-event Area -->
				<section class="upcoming-event-area" style="padding-top:30px;">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pt-10 pb-40 header-text text-center" id="lastEvents">
								<h2 class="pb-10">Nadchádzajúce udalosti od naších členov</h2>
								<p>
									Vyhľadajte udalosti / kurzy / tréningy od naších členov vo Vašom okolí
								</p>
								<?php
									$_GET['what'] = 'events';
									include('filter.php');
                                ?>
                                <h4 id="assetsFound"></h4>
                                <div id="eventSearchResults"></div>
							</div>
						</div>							
						
					</div>
					<hr>
					<div class="container">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pt-20 header-text text-center">
								<h2 class="pb-10">Kalendár SJF</h2>
								<p>
									Kalendár je aktualizovaný Slovenskou Jazdeckou Federáciou (SJF)
								</p>
							</div>
						</div>							
						<div id="divContainer" style="left: 50px; border: solid 2px #000;">
								<div id="frameContainer" style="overflow:hidden;">
                                    <div id="sjfIframe" class="iframeLoader"><h3>Kliknite sem pre načítanie SJF kalendára</h3></div>
								</div>
						</div>
						<p>* V prípade, že vám kalendár nefunguje, skontrolujte či prehliadač nevyhadzuje hlášku o zablokovaných oknách - je potrebné povoliť</p>
					</div>
                    <hr>
                    <div class="container">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pt-20 header-text text-center">
								<h2 class="pb-10">Kalendár EuroRodeo</h2>
								<p>
									Na portáli EuroRodeo nájdete všetky slovenské a niekoľko českých podujatí vo westernovom jazdení
								</p>
							</div>
						</div>							
						<div id="divContainer" style="left: 50px; border: solid 2px #000;">
                                <div id="frameContainer" style="overflow:hidden;">
                                    <div id="euroRodeoIframe" class="iframeLoader"><h3>Kliknite sem pre načítanie EuroRodeo kalendára</h3></div>
								</div>
						</div>
						<p>* V prípade, že vám kalendár nefunguje, skontrolujte či prehliadač nevyhadzuje hlášku o zablokovaných oknách - je potrebné povoliť</p>
					</div>
                    <hr>
                    <div class="container">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pt-20 header-text text-center">
								<h2 class="pb-10">Kalendár FEI</h2>
								<p>
									Kalendár je aktualizovaný svetovou jazdeckou organizáciou FEI (Fédération Equestre Internationale) - je potrebné zadať kritéria hľadania
								</p>
							</div>
						</div>							
						<div id="divContainer" style="left: 50px; border: solid 2px #000;">
                                <div id="frameContainer" style="overflow:hidden;">
                                    <div id="feiIframe" class="iframeLoader"><h3>Kliknite sem pre načítanie FEI kalendára</h3></div>
								</div>
						</div>
						<p>* V prípade, že vám kalendár nefunguje, skontrolujte či prehliadač nevyhadzuje hlášku o zablokovaných oknách - je potrebné povoliť</p>
					</div>
				</section>
			<!-- End upcoming-event Area -->
										
			<?php include('feedBacks.php'); ?>
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>	
        </body>
        <script>
        $(window).on('load', function () {
            fillFilterWithGetValues();
            performSearch();
        });
        $("#sjfFrame").on("load", function () {
            $('html,body').scrollTop(0); 
        });

        $(document).on('click','#sjfIframe',function(){
            $(this).parent().html('<iframe src="https://www.sjf.sk/sutaze/kalendar/" id="sjfFrame" scrolling="yes" style="width: 100%; height: 800px; margin-top: -200px;"></iframe>');
        });

        $(document).on('click','#euroRodeoIframe',function(){
             $(this).parent().html('<iframe src="https://www.eurorodeo.eu/kalendar" scrolling="yes" style="width: 100%; height: 900px;width: 110%;height: 900px;-webkit-transform: scale(1.3);transform: scale(0.95);-webkit-transform-origin: 0 0;"></iframe>');
        });    
        
        $(document).on('click','#feiIframe',function(){
             $(this).parent().html('<iframe src="https://data.fei.org/Calendar/Search.aspx" scrolling="yes" style="width: 100%; height: 900px;width: 110%;height: 900px;-webkit-transform: scale(1.3);transform: scale(0.92);-webkit-transform-origin: 0 0;"></iframe>');
        });   
        </script>
	</html>