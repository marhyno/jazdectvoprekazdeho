<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">
	<title>Skúška základného výcviku jazdca -
		<?php echo $siteName; ?>
	</title>
	<?php
        include('styleSheets.php');
    ?>
</head>

<body>
	<?php 
        $education = "menu-active";
        include('header.php'); 
    ?>
	<!-- start banner Area -->
	<section class="banner-area relative" id="home">
		<div class="overlay overlay-bg"></div>
		<div class="container">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 class="text-white">
						Skúška základného výcviku jazdca
					</h1>
					<p class="text-white link-nav"><a href="/">Domov </a> <span class="lnr lnr-arrow-right"></span> <a href="">
							SZVJ</a></p>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- Start Live Streams Area -->
	<section class="upcoming-event-area section-gap">
		<div class="container" style="max-width: 100%;">
			<div class="row d-flex justify-content-center">
				<div class="col-md-9 pb-40 header-text text-center">
					<h1 class="pb-10">Popis skúšky od SJF</h1>
					<p>
						<div id="pdfViewer"></div>
						<h4>* Chyba v otázke č.45 - Jazdci sa stretávajú na ľavé ruky</h4>
					</p>
					<hr>
					<br>
					<h2>Ukážkové video z jazdy (predvádzanie koňa chýba)</h2>
					<iframe width="100%" height="480" src="https://www.youtube.com/embed/2NJYCyGe9-c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<br><br>
					<h1 class="pb-10">Online test</h1>
					<p>Vyskúšajte svoje znalosti. Test obsahuje 46 otázok, ktoré sa pri každom spustení premiešajú.</p>
					<button class="onlineTestButton">Spustiť test</button>
					<div id='onlineTest' style="display:none;">
						<br />
						<div id='quiz'></div>
                        <div class='button' id='next'><a href='#'>Ďalšia >></a></div>
                        <div class='button' id='showAnswer' style="margin-right: 50px;"><a href='#'>Ukázať odpoveď</a></div>
						<div class='button' id='prev' style="float: left;"><a href='#'><< Predchádzajúca </a></div>
						<div class='button' id='start'> <a href='#'>Začať znovu</a></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Live Streams Area -->

	<?php include('feedBacks.php'); ?>
	<?php include('footer.php'); ?>
	<?php include('footerScripts.php'); ?>
</body>

</html>