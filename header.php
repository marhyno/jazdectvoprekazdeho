<header id="header" id="home">
			    <div class="container">
			    	<div class="row header-top align-items-center">
			    		<div class="col-lg-4 col-sm-4 menu-top-left">
			    		</div>
			    		<div class="col-lg-4 menu-top-middle justify-content-center d-flex">
							<a href="/">
								<img class="img-fluid" src="img/logo.png" alt="">	
							</a>			    			
			    		</div>
			    		<div class="col-lg-4 col-sm-4 menu-top-right">
			    			<!--<a class="tel" href="tel:+880 123 12 658 439">+880 123 12 658 439</a>
			    			<a href="tel:+880 123 12 658 439"><span class="lnr lnr-phone-handset"></span></a>-->
			    		</div>
			    	</div>
			    </div>	
			    	<hr>
			    <div class="container">	
			    	<div class="row align-items-center justify-content-center d-flex">
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          	<li class="<?php echo $home; ?>"><a href="/">Domov</a></li>
				        	<li class="<?php echo $about; ?>"><a href="o-stranke.php">O stránke</a></li>	          
							<li class="<?php echo $education; ?> menu-has-children"><a href="#">Vzdelávanie</a>
									<ul>
										<li><a href="chcem-vlastnit-kona.php">Chcem vlastniť koňa</a></li>			
										<li><a href="chcem-jazdit-a-sutazit.php">Chcem súťažiť</a></li>
										<li><a href="szvj.php">Skúšky ZVJ + Online Test</a></li>
										<li><a href="http://www.sjf.sk/sjf/dokumenty/" target="_blank">Dokumenty SJF</a></li>
									</ul>									
							</li>
							<li class="<?php echo $hladam; ?> menu-has-children"><a href="#">Hľadám</a>
									<ul>
										<?php
										$xml=simplexml_load_file("assets/searchFilter.xml");
										foreach($xml->children() as $child)
										{
											if ($child->attributes() != 'bazar'){
												echo '<li><a href="vyhladat.php?what=' . $child->attributes() . '">' . $child->attributes() . '</a></li>';
											}
										}
										?>
									</ul>
							</li>
							<li class="<?php echo $events; ?>"><a href="events.php">Kalendár podujatí</a></li>
							<li class="<?php echo $liveStreams; ?>"><a href="live-streams.php"><span class="dot"></span>LIVE STREAMS</a></li>
							<li class="<?php echo $news; ?>"><a href="novinky-clanky.php">Novinky / Články</a></li>
							<li class="<?php echo $market; ?>"><a href="bazar.php">Bazár</a></li>
							<li class="<?php echo $contact; ?>"><a href="kontakt.php">Kontakt</a></li>
							<li><a class="primary-btn loginButton loginButtonMenu" href="prihlasenie/">Prihlásiť sa / Registrovať</a></li>
				          <!--<li><a href="elements.php">Elements</a></li>-->
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
</header><!-- #header -->

<!-- ANIMATIONS AND MESSAGES -->
<?php
include('animationsAndMessages.php');
?>
