<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Všetky potrebné informácie o skúške. Online Test. Skúška základného výcviku jazdca (SZVJ) je vstupnou bránou do súťažného jazdectva. Po úspešnom absolvovaní, jazdec získa oprávnenie súťažiť v súťažiach usporiadaných Slovenskou jazdeckou federáciou. Taktiež slúži ako predpoklad k získaniu trénerskej licencie.">
    <?php
        echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/szvj.php>"';
        echo '<meta property="og:title" content="SZVJ - Jazdectvo pre každého" />';
        echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/1547163637277.png"/>';
        echo '<meta property="fb:app_id" content="425429784657516"/>';
    ?>	
	<title>Skúšky základného výcviku jazdca - <?php echo $siteName; ?>
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
					<h2 class="text-white">
						Skúšky základného výcviku jazdca
					</h2>
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
                    <h5>Skúšky základného výcviku jazdca (SZVJ) je vstupnou bránou do súťažného jazdectva. Po úspešnom absolvovaní, jazdec získa oprávnenie súťažiť v súťažiach usporiadaných Slovenskou jazdeckou federáciou. Taktiež slúži ako predpoklad k získaniu trénerskej licencie.</h5>
					<p>
						<div id="szvj-load-pdf"></div>
						<h4>* Chyba v otázke č.45 - Jazdci sa stretávajú na ľavé ruky</h4>
					</p>
					<hr>
					<br>
					<h3>Ukážkové video z jazdy (predvádzanie koňa chýba)</h3><br>
					<iframe width="100%" height="480" src="https://www.youtube.com/embed/2NJYCyGe9-c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<br><br>
					<h2 class="pb-10">Online test</h2>
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
                    <br>
                    <hr>
                    <br>
                    <h3 class="pb-20">Doplňte písmená do drezúrnych obdĺžnikov</h3>
                    <div class="col-md-6 pb-30" style="float: left;">
                        <h4 class="pb-10">Drezúrny obdĺžnik veľký - 20m x 60m</h4>
                        <div id="dressageArenaLarge">
                            <img src="/img/dressageArenaLarge.png" alt="">
                            <input type="text" style="left: 70px ;top: -5px;" class="largeDressageArenaLetters dressageLetter" id="C">
                            <input type="text" style="left: 7px;top: 40px;" class="largeDressageArenaLetters dressageLetter" id="H">
                            <input type="text" style="left: 7px;top: 90px;" class="largeDressageArenaLetters dressageLetter" id="S">
                            <input type="text" style="left: 7px;top: 145px;" class="largeDressageArenaLetters dressageLetter" id="E">
                            <input type="text" style="left: 7px;top: 195px;" class="largeDressageArenaLetters dressageLetter" id="V">
                            <input type="text" style="left: 7px;top: 245px;" class="largeDressageArenaLetters dressageLetter" id="K">
                            <input type="text" style="left: 70px;top: 40px;" class="largeDressageArenaLetters dressageLetter" id="G">
                            <input type="text" style="left: 70px;top: 90px;" class="largeDressageArenaLetters dressageLetter" id="I">
                            <input type="text" style="left: 70px;top: 145px;" class="largeDressageArenaLetters dressageLetter" id="X">
                            <input type="text" style="left: 70px;top: 195px;" class="largeDressageArenaLetters dressageLetter" id="L">
                            <input type="text" style="left: 70px;top: 245px;" class="largeDressageArenaLetters dressageLetter" id="D">
                            <input type="text" style="left: 130px;top: 40px;" class="largeDressageArenaLetters dressageLetter" id="M">
                            <input type="text" style="left: 130px;top: 90px;" class="largeDressageArenaLetters dressageLetter" id="R">
                            <input type="text" style="left: 130px;top: 145px;" class="largeDressageArenaLetters dressageLetter" id="B">
                            <input type="text" style="left: 130px;top: 195px;" class="largeDressageArenaLetters dressageLetter" id="P">
                            <input type="text" style="left: 130px;top: 245px;" class="largeDressageArenaLetters dressageLetter" id="F">
                        </div>
                        <button class="btn" id="checkLargeArena">Vyhodnotiť</button>
                        <button class="btn" id="resetLargeArena">Odznovu</button>
                    </div>
                    <div class="col-md-6" style="float: right;">
                        <h4 class="pb-10">Drezúrny obdĺžnik malý - 20m x 40m</h4>
                        <div id="dressageArenaSmall" style="right: 30px;">
                            <img src="/img/dressageArenaSmall.png" alt="">
                            <input type="text" style="left: 112px;top: -5px;" class="smallDressageArenaLetters dressageLetter" id="C">
                            <input type="text" style="left: 45px;top: 40px;" class="smallDressageArenaLetters dressageLetter" id="H">
                            <input type="text" style="left: 45px;top: 120px;" class="smallDressageArenaLetters dressageLetter" id="E">
                            <input type="text" style="left: 45px;top: 200px;" class="smallDressageArenaLetters dressageLetter" id="K">
                            <input type="text" style="left: 112px;top:40px;" class="smallDressageArenaLetters dressageLetter" id="G">
                            <input type="text" style="left: 112px;top:120px;" class="smallDressageArenaLetters dressageLetter" id="X">
                            <input type="text" style="left: 112px;top:200px;" class="smallDressageArenaLetters dressageLetter" id="D">
                            <input type="text" style="left: 178px;top: 40px;" class="smallDressageArenaLetters dressageLetter" id="M">
                            <input type="text" style="left: 178px;top: 120px;" class="smallDressageArenaLetters dressageLetter" id="B">
                            <input type="text" style="left: 178px;top: 200px;" class="smallDressageArenaLetters dressageLetter" id="F">
                        </div>
                        <button class="btn" id="checkSmallArena">Vyhodnotiť</button>
                        <button class="btn" id="resetSmallArena">Odznovu</button>
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