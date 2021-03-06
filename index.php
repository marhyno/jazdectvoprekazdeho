	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<?php include('meta.php'); ?>
        <meta property="og:description" content="Novinky a články zo sveta koní, vzdelávanie, vyhľadávanie služieb, bazár. Všetko pod jednou strechou." />
		<meta name="description" content="Novinky a články zo sveta koní, vzdelávanie, vyhľadávanie služieb, bazár. Všetko pod jednou strechou.">
        <?php
        echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '" />';
        echo '<meta property="og:title" content="Jazdectvo pre každého" />';
        echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . '/img/1547163637277.png"/>';
        echo '<meta property="fb:app_id" content="425429784657516"/>';
        ?>
		<!-- Site Title -->
		<title>Vitajte - <?php echo $siteName; ?></title>
		<?php
        include('styleSheets.php');
        ?>
		</head>
		<body>
			<?php 
			$home = "menu-active";
			include('header.php'); 
			?>

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row fullscreen d-flex align-items-center justify-content-start" style="max-height: 650px;">
						<div class="banner-content col-lg-12">
							<h6>Spoznajte svet koní a urobte ho s nami krajší</h6>
							<span class="bar"></span>
							<h1 class="text-white" id="frontPageTitle">
								Najkrajší pohľad na svet<br> je z konského chrbta
							</h1>
							<a href="#learnMore" class="genric-btn scroll">Dozvedieť sa viac</a>
						</div>
						<a class="primary-btn loginButton" href="prihlasenie/">Prihlásiť sa / Registrovať</a>
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<section class="section-gap" id="rekl">
				<div class="container">
					<div class="row d-flex justify-content-center text-center">
						<div class="col-sm reklBanner">
							<a href="https://cleverhorse.sk" target="_blank"><img src="img/reklImages/cleverHorse.sk.png" alt=""></a>
						</div>
						<div class="col-sm reklBanner">
							<div>
							Priestor pre Vašu reklamu<br>
							<span>Kontaktujte nás!</span>
							</div>
						</div>
						<div class="col-sm reklBanner">
							<div>
							Priestor pre Vašu reklamu<br>
							<span>Kontaktujte nás!</span>
							</div>
						</div>
					</div>
				</div>	
			</section>
			<hr>

						<!-- Start latest-blog Area -->
			<section class="latest-blog-area section-gap" id="blog">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-20 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Najnovšie články</h1>
							</div>
						</div>
					</div>					
					<div class="row twoLastNews">		
                    </div>
                    <a class="primary-btn allNews" href="/novinky-clanky.php">Všetky novinky a články</a>
				</div>	
			</section>
			<!-- End latest-blog Area -->	
			<div tabindex="-1" role="dialog" style=" background: rgba(0, 0, 0, 1);">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header" style="background: black; border: none; color: white; text-align: center; display: inline-block; padding-bottom: 0px;">
							<h3 style="color: white; text-align: center; width: 100%;">Spustili sme prvú aplikáciu svojho druhu na Slovensku</h3>
							<h2 style="color: white; font-style: italic; padding: 13px;">My Horse</h2>

							<p>Stiahnite si aplikáciu, vďaka ktorej si už nebudete lámať hlavu kedy má prísť podkúvač, kedy bolo očkovanie alebo či náhodou nelonžujete už 4 krát v rade.</p>
						</div>
						<div class="modal-body" style="padding: 0px; background: black;">
							<img src="/img/appTeaser.jpg" />
						</div>
						<div class="modal-footer" style="background: black; justify-content: center; border: 0px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">
							<a target="_blank" href="https://apps.apple.com/us/app/id1526577637" class="btn btn-neutral" style="/* float: left; */ background: #ffffff; /* Old browsers */
			background: -moz-linear-gradient(top,  #ffffff 0%, #e2e2e2 50%, #ffffff 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#e2e2e2), color-stop(100%,#ffffff)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  #ffffff 0%,#e2e2e2 50%,#ffffff 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  #ffffff 0%,#e2e2e2 50%,#ffffff 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  #ffffff 0%,#e2e2e2 50%,#ffffff 100%); /* IE10+ */
			background: linear-gradient(to bottom,  #ffffff 0%,#e2e2e2 50%,#ffffff 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */; color: black; border: none; font-size: 18px;width: 120px;margin-left: 20px;">Apple</a>
							<a target="_blank" href="https://play.google.com/store/apps/details?id=sk.jazdectvoprekazdeho.myhorse&hl=en_US" style="font-size: 18px;background:#A4C639;margin-left: 20px; width: 120px;" class="btn btn-success">Android</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Start about-video Area -->
			<section class="about-video-area section-gap" id="learnMore">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 about-video-left">
							<h1>
								Vykročte do nového sveta, <br>
								ktorý vás naplní vášňou 
							</h1>
							<p>
								<span>Vytvorte si púto medzi sebou a majestátnym tvorom</span>
							</p>
							<p>
								Všetko je to o porozumení, spolupráci, potešení a dosiahnutí výsledkov a bezpečia
							</p>
							<a class="primary-btn scroll" href="chcem-vlastnit-kona.php">Dozvedieť sa viac</a>
						</div>
						<div class="col-lg-6 about-video-right justify-content-center align-items-center d-flex">
							<a class="play-btn" href="https://www.youtube.com/watch?v=CaIfgl3eTlo"><img class="img-fluid mx-auto" src="img/play.png" alt=""></a>
						</div>
					</div>
				</div>	
			</section>
			<!-- End about-video Area -->
			
			<!-- Start feature Area -->
			<section class="feature-area relative pt-100 pb-20">
				<div class="overlay overlay-bg"></div>
				<h2 class="text-white centeredHeading" style="top: 30px;">Všetky informácie v jednej stajni</h2>
				<div class="container">
					<div class="row align-items-center justify-content-center" style="padding-top:20px;">
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Ustajnenie"><h4 class="text-white">Stajne & Jazdiarne</h4></a>
								<p class="silver-text">
									Vyhľadajte si pre svojho miláčika ustajnenie podľa vaších predstáv. Nájdite si miesto kde sa naučíte jazdiť.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Tréner"><h4 class="text-white">Tréneri</h4></a>
								<p class="silver-text">
									Vyberte si z ponuky trénerov podľa klasifikácie, zamerania, skúseností a hodnotenia.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Veterinár"><h4 class="text-white">Veterinári</h4></a>
								<p class="silver-text">
									Nájdite pre svojho miláčika Vášho anjela strážneho.
								</p>
							</div>
						</div>	
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Fyzioterapeut"><h4 class="text-white">Fyzioterapeuti</h4></a>
								<p class="silver-text">
									Dornova metóda a fyzioterapeuti sú Vám k dispozícii.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Kováč"><h4 class="text-white">Kováči</h4></a>
								<p class="silver-text">
									Nájdite si toho najlepšieho podkúvača vo Vašom okolí.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Prevoz"><h4 class="text-white">Prevoz & Preprava koní</h4></a>
								<p class="silver-text">
									Jednorázová preprava koní ? Pravidelná preprava na súťaže ? Vyberte si tú správnu službu.
								</p>
							</div>
						</div>																		
					</div>
				</div>	
			</section>
			<!-- End feature Area -->
			
			<!-- Start home-about Area -->
			<section class="home-about-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 home-about-left">
							<img class="mx-auto d-block img-fluid" src="img/about-img.png" alt="">
						</div>
						<div class="col-lg-6 home-about-right">
							<h1>Nezáleží na tom či si začiatočník,
							pokročilý <br> alebo profesionál</h1>
							<p>
								<span>Všetkých nás spája jedna spoločná vec</span>
							</p>
							<p>
							najkrajší pohľad na svet je z konského chrbta a prechádza pomedzi uši koňa. Kôň je elegantné zviera s obrovskou silou a čistou dušou a nekonečnou trpezlivosťou a ochotou. Priláka svojou zaujímavosťou a bude vás učiť stále niečo nové. Na človeka pôsobí antistresovo. Kto dokáže pochopiť zmýšľanie koní, dokáže objaviť aj sám seba. Objavte základy chovu, jazdy a starostlivosti o kone.
							</p>
							<a class="primary-btn" href="chcem-jazdit-a-sutazit.php">Dozvedieť sa viac</a>
						</div>
					</div>
				</div>	
			</section>
			<!-- End home-about Area -->
			
			<!-- Start price Area -->
			<section class="price-area pt-20 pb-30">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-20 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Dajte o sebe vedieť</h1>
								<p>Ponúkate výuku jazdenia ? Rekreačné jazdenie ? Ustajnenie ? Ste veterinár ? Tréner ? Zviditeľnite sa</p>
								<p>Zaregistrujte sa a dajte na známosť svoje ponúkané služby, pridávajte novinky, aktualizujte dáta.</p>
								<h6>Čo získam registráciou ako osoba ? </h6>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<div class="single-price">
								<div class="top-part">
									<h1 class="package-no">01</h1>
									<h4>Ponuka</h4>
									<p>Ponúkam služby</p>
								</div>
								<div class="package-list">
									<ul>
										<li>Ponúkam výcvik jazdcov / rekreačné jazdenie</li>
										<li>Správa svojej stajne - pridávanie noviniek, spravovať ustajnenie</li>
										<li>Som veterinár / kováč / fyzioterapeut</li>
										<li>Ponúkam prevoz koní</li>
										<li>Vytvoriť udalosť / kurz</li>
									</ul>
								</div>
								<div class="bottom-part">
									<h4><a class="price-btn text-uppercase" href="/prihlasenie/?register=register">Registrovať</a></h4>
								</div>								
							</div>
						</div>
						<div class="col-lg-6 col-md-6">
							<div class="single-price">
								<div class="top-part">
									<h1 class="package-no">02</h1>
									<h4>Dopyt</h4>
									<p>Hľadám služby - som jazdec</p>
								</div>
								<div class="package-list">
									<ul>
										<li>Hľadám jazdenie</li>
										<li>Hľadám ustajnenie</li>
										<li>Hľadám kováča / veterinára / fyzioterapeuta</li>
                                        <li>Hľadám prevoz</li>
                                        <li>Prispievať do fóra</li>
									</ul>
								</div>
								<div class="bottom-part">
									<h4><a class="price-btn text-uppercase" href="/prihlasenie/?register=register">Registrovať</a></h4>
								</div>								
							</div>
						</div>																		
					</div>
				</div>	
			</section>
			<!-- End price Area -->

			<?php include('feedBacks.php');	 ?>

			<!-- Start gallery Area -->
			<section class="gallery-area">
				<div class="container-fluid">
					<div class="row no-padding">
						<div class="active-gallery">
							<div class="item single-gallery">
							    <div class="thumb">
							        <img src="img/g1.jpg" alt="">
							        <div class="align-items-center justify-content-center d-flex">
							        </div>
							    </div>
							</div>	
							<div class="item single-gallery">
							    <div class="thumb">
							        <img src="img/g2.jpg" alt="">
							        <div class="align-items-center justify-content-center d-flex">
							        </div>
							    </div>
							</div>	
							<div class="item single-gallery">
							    <div class="thumb">
							        <img src="img/g3.jpg" alt="">
							        <div class="align-items-center justify-content-center d-flex">
							        </div>
							    </div>
							</div>	
							<div class="item single-gallery">
							    <div class="thumb">
							        <img src="img/g4.jpg" alt="">
							        <div class="align-items-center justify-content-center d-flex">
							        </div>
							    </div>
							</div>	
							<div class="item single-gallery">
							    <div class="thumb">
							        <img src="img/g5.jpg" alt="">
							        <div class="align-items-center justify-content-center d-flex">
							        </div>
							    </div>
							</div>	
							<div class="item single-gallery">
							    <div class="thumb">
							        <img src="img/g6.jpg" alt="">
							        <div class="align-items-center justify-content-center d-flex">
							        </div>
							    </div>
							</div>								

						</div>
					</div>
				</div>	
			</section>
			<!-- End gallery Area -->
			<?php include('teaserBanner.php'); ?>
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>
            <script type='text/javascript'>
                getTwoLastNewsForIndexPage();
            </script>
        </body>
	</html>



