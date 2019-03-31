<header id="header" id="home">
			    <div class="container" style="padding-left:0px;">
			    	<div class="row header-top align-items-center">
			    		<div class="col-lg-4 col-sm-4 menu-top-left">
			    		</div>
			    		<div class="col-lg-4 logo">
							<a href="/">
								<img class="img-fluid" src="/img/logo.png" alt="">	
							</a>			    			
			    		</div>
			    		<div class="col-lg-4 col-sm-4 menu-top-right">
			    		</div>
			    	</div>
			    </div>	
			    <hr style="margin-top: 5px;margin-bottom: 10px;">
			    <div class="container">	
			    	<div class="row align-items-center justify-content-center d-flex">
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
                            <li class="<?php echo $home; ?> menu-has-children"><a href="/">Domov</a>
                                <ul>
                                    <li><a href="/o-stranke.php">O stránke</a></li>
                                    <li><a href="/partneri.php">Partneri</a></li>
                                </ul>
                            </li>	          
							<li class="<?php echo $education; ?> menu-has-children"><a href="#">Vzdelávanie</a>
									<ul>
										<li><a href="/chcem-vlastnit-kona.php">Chcem vlastniť koňa</a></li>			
										<li><a href="/chcem-jazdit-a-sutazit.php">Chcem jazdiť a súťažiť</a></li>
										<li><a href="/szvj.php">Skúšky ZVJ + Online Test</a></li>
                                        <li class="menu-has-children"><a href="#">Odvetvia</a>
                                            <ul>
										        <li><a href="/anglicke-jazdenie.php">Anglické jazdenie</a></li>			
										        <li><a href="/westernove-jazdenie.php">Westernové jazdenie</a></li>
										        <li><a href="/working-equitation.php">Working equitation</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="/navody-a-ziadosti.php">Návody a žiadosti</a></li>
										<li><a href="http://www.sjf.sk/sjf/dokumenty/" target="_blank">Dokumenty SJF</a></li>
                                        
									</ul>									
							</li>
							<li class="<?php echo $hladam; ?> menu-has-children"><a href="#">Hľadám</a>
									<ul>
										<?php
										$xml=simplexml_load_file($_SERVER["DOCUMENT_ROOT"] . "/assets/searchFilter.xml");
										foreach($xml->children() as $child)
										{
											if ($child->attributes()['visibleInMenu'] == 'yes'){
                                                if ($child->attributes() == 'Stajne / Ranče'){
                                                    echo '<li><a href="/stajne-a-rance.php">' . $child->attributes() . '</a></li>';
                                                }else{
                                                    echo '<li><a href="/vyhladat.php?what=' . $child->attributes() . '">' . $child->attributes() . '</a></li>';
                                                }
											}
                                        }
                                        echo '<li><a href="https://www.agroconsulting.sk" target=_blank>Poistenie koní a jazdcov</a></li>';
										?>
									</ul>
							</li>
							<li class="<?php echo $events; ?>"><a href="/kalendar.php">Kalendár podujatí</a></li>
							<li class="<?php echo $liveStreams; ?>"><a href="/live-streams.php"><span class="dot"></span>Live streams</a></li>
							<li class="<?php echo $news; ?>"><a href="/novinky-clanky.php">Novinky / Články</a></li>
                            <li class="<?php echo $market; ?>"><a href="/bazar.php">Bazár</a></li>
                            <li><a href="/forum/">Fórum</a></li>
							<li class="<?php echo $contact; ?>"><a href="/kontakt.php">Kontakt</a></li>
							<li><a class="primary-btn loginButton loginButtonMenu" href="prihlasenie/">Prihlásiť sa / Registrovať</a></li>
				          <!--<li><a href="elements.php">Elements</a></li>-->
				        </ul>
				      </nav><!-- #nav-menu-container -->		    		
			    	</div>
			    </div>
</header><!-- #header -->

<!-- ANIMATIONS AND MESSAGES -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/animationsAndMessages.php');
?>
