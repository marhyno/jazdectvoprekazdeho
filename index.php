	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<?php include('meta.php'); ?>
		<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">
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
					<div class="row fullscreen d-flex align-items-center justify-content-start">
						<div class="banner-content col-lg-12">
							<h6>Spoznajte svet koní a urobte ho s nami krajší</h6>
							<span class="bar"></span>
							<h1 class="text-white" id="frontPageTitle">
								Jazdectvo  <br> je naozaj pre každého
							</h1>
							<a href="#learnMore" class="genric-btn scroll">Dozvedieť sa viac</a>
						</div>
						<a class="primary-btn loginButton" href="prihlasenie/">Prihlásiť sa / Registrovať</a>
					</div>
				</div>
			</section>
			<!-- End banner Area -->

						<!-- Start latest-blog Area -->
			<section class="latest-blog-area section-gap" id="blog">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-60 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Najnovšie články</h1>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-lg-6 single-blog">
							<img class="img-fluid" src="img/b1.jpg" alt="">
							<ul class="tags">
								<li><a href="#">Travel</a></li>
								<li><a href="#">Life style</a></li>
							</ul>
							<a href="#"><h4>Horse news title 1</h4></a>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore.
							</p>
							<p class="post-date">31st January, 2018</p>
						</div>
						<div class="col-lg-6 single-blog">
							<img class="img-fluid" src="img/b2.jpg" alt="">
							<ul class="tags">
								<li><a href="#">Travel</a></li>
								<li><a href="#">Life style</a></li>
							</ul>
							<a href="#"><h4>Horse news title 2</h4></a>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore.
							</p>
							<p class="post-date">22nd January, 2018</p>
						</div>						
					</div>
				</div>	
			</section>
			<!-- End latest-blog Area -->	
			<hr style="border: 5px solid black;">
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
							<a class="play-btn" href="https://www.youtube.com/watch?v=mJfldn7W9oE"><img class="img-fluid mx-auto" src="img/play.png" alt=""></a>
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
								<a href="vyhladat.php?what=Trénera"><h4 class="text-white">Tréneri</h4></a>
								<p class="silver-text">
									Vyberte si z ponuky trénerov podľa klasifikácie, zamerania, skúseností a hodnotenia.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Veterinára"><h4 class="text-white">Veterinári</h4></a>
								<p class="silver-text">
									Nájdite pre svojho miláčika Vášho anjela strážneho.
								</p>
							</div>
						</div>	
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Fyzioterapeuta"><h4 class="text-white">Fyzioterapeuti</h4></a>
								<p class="silver-text">
									Dornova metóda a fyzioterapeuti sú Vám k dispozícii.
								</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 frontPageCell">
							<div class="single-feature">
								<a href="vyhladat.php?what=Kováča"><h4 class="text-white">Kováči</h4></a>
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
			<section class="price-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
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
										<li>Ponúkam krmivo</li>
										<li>Vytvoriť udalosť / kurz</li>
									</ul>
								</div>
								<div class="bottom-part">
									<h2><a class="price-btn text-uppercase" href="/prihlasenie/?register=register">Registrovať</a></h2>
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
										<li>Hľadám kováča / veterinára / fyzioterapeut</li>
										<li>Hľadám prevoz</li>
									</ul>
								</div>
								<div class="bottom-part">
									<h2><a class="price-btn text-uppercase" href="/prihlasenie/?register=register">Registrovať</a></h2>
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
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>
		</body>
	</html>



