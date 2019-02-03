	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<?php include('meta.php'); ?>
		<!-- Site Title -->
		<title>O stránke - <?php echo $siteName; ?></title>
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
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								O projekte				
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">O stránke</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
			
			<!-- Start home-about Area -->
			<section class="home-about-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 home-about-left">
							<img class="mx-auto d-block img-fluid" src="img/about-img.png" alt="">
						</div>
						<div class="col-lg-6 home-about-right">
							<h6 class="text-uppercase">Prečo táto stránka vznikla</h6>
							<h1>Zlepšiť koňský svet a<br>
							nájsť všetko na jednom mieste</h1>
							<p>
								<span>Urobme ho spolu krajší odstránením starých zvykov</span>
							</p>
							<p>
								Stránka vznikla po tom ako som sa dostal ku koňom v dospelom veku, kedy už je človek uvedomelý a všíma si okolie. Prvý dojem zo sveta koní a jazdcov nebol najlepší. Uzavretá skupina ľudí, v ktorej nepanujú najlepšie vzťahy medzi členmi. Neustále ohováranie, porovnávanie a zisťovanie kto je lepší alebo kto si môže dovoliť drahšieho koňa a drahšiu výbavu vrhlo veľmi zlé svetlo na túto skupinu ľudí. Aj takouto formou by sme chceli zlepšiť situáciu, vzťahy a dostupnosť informácií. Odstránením zvykov a "klapiek" z očí, kedy si jazdec / tréner myslí, že už vie všetko a všetci ostatní to robia zle. Prinavrátime pohodu a radosť z jazdenia späť.
							</p>
							<p>
								Misiou stránky je nájsť všetko pod jednou strechou, uľahčiť štart do sveta jazdenia a výchovy koní pre začiatočníkov, ponúknuť vzdelanie pre jazdcov, rozšíriť obzor, odstrániť mýty a povery. Taktiež združiť všetkých ľudí, ktorí svojou činnosťou zasahujú do sveta koní - kováči, veterinári, ľudia ponúkajúci prepravu koní, atď. To všetko chceme ponúknuť ľudom <b>zadarmo</b>.
							</p>
							<p>
								<span>Keď zmeníte spôsob, akým sa pozeráte na veci, veci, na ktoré sa pozeráte, sa zmenia. - <small>Warwick Schiller</small></span>
							</p>
						</div>
					</div>
				</div>	
            </section>
            <hr>
            <section class="home-about-area section-gap">
                <div class="container">
					<div class="row" style="display: block;text-align: left;width: 100%;">
                            <h3 class="text-center pb-10">Ako stránka funguje ?</h3>
                            <p>Aby sme na Slovensku urobili jazdectvo populárnejším, vytvorili sme systém, aby si každý prišiel na svoje.
                            Služby a produkty spolu súvisia a sú navzájom prepojené. Človek sa môže zaregistrovať a ponúkať svoje služby v menej stajne alebo v menej svojom. Stajňa je virtuálny objekt, ktorý môže ale nemusí reprezentovať reálnu stajňu (napr. "NŽ Topolčianky" alebo "Súkromná stajňa na rohu ulice").</p>
                            <p>Poďme teda na to.</p>
                            <h4 class="pb-10 pt-10"><b>Zastupujem stajňu, jazdiareň, ranč, a pod. ?</b></h4>
                            <p>Ak chcem ponúkať služby v mene stajne, vytvorím si v mojom profile stajňu, kde vyplním všetky potrebné údaje a pridám čo najlepšie fotky aby som vedel zaujať. Následne ak chcem ponúkať napr. jazdenie, oznámiť, že v stajni sa nachádza kováč alebo chcem usporiadať udalosť, tak ich vytvrím a priradím k mojej stajni. V tom prípade bude pri položkách zobrazený kontakt stajne. Graficky je to znázornené na obrázku.</p>
                            <img src="/img/introUserBarn.png" alt="Som vlastník stajne a poskytujem služby v mene stajne" style="margin-left: auto;display: block;margin-right: auto;">
                            <h4 class="pb-10 pt-10"><b>Chcem ponúkať služby vo vlastnom mene (kováč, veterinár, súkromné jazdenie a pod.) ?</b></h4> 
                            <p>V tomto prípade nemusím vytvárať stajňu. Služby a udalosti môžem ponúkať ako osoba a pri položkách sa zobrazia moje kontaktné údaje. Príklad ponuky jednej alebo viacerých služieb je zobrazený na obrázku.</p>
                            <img src="/img/introUserService.png" alt="Som súkromník a poskytujem služby v mojom mene" style="margin-left: auto;display: block;margin-right: auto;">
                            <p>Užívaťeľ môže pridávať položky (služby, udalosti) v mene stajne a zároveň aj vo svojom mene. <br>Nezabudnite navštíviť aj naše <a href="/forum">fórum</a> kde nájdete rôzne rady a informácie.
                            Ak budete mať akúkoľvek otázku, neváhajte nás kontaktovať.</p>
                    </div>
				</div>
            </section>
			<!-- End home-about Area -->		
			<?php include('feedBacks.php'); ?>
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>
		</body>
	</html>



