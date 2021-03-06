            <div class="dropup">
                <button class="dropbtn">
                <img src="/img/plus.png" id="plusNewAsset" alt="">
                </button>
                <div class="dropup-content" id="fastAddMenu">
                    <a href="moj-profil.php#offeredServices" id="rider">MOJE POLOŽKY</a>
                    <a href="pridat.php?what=inzerát" id="addMarket">Inzerát v bazári</a>
                    <a href="pridat.php?what=stajňu" id="addBarn">Novú Stajňu</a>
                    <a href="pridat.php?what=službu" id="addService">Novú Službu</a>
                    <a href="pridat.php?what=udalosť" id="addEvent">Novú Udalosť</a>
                </div>
            </div>            
            
            <!-- start footer Area -->		
			<footer class="footer-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-3  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>O stránke</h4>
								<p>
									Stránka vznikla s cieľom nájsť všetky informácie na jednom mieste, pomáhať a vzdelávať.
								</p>
							</div>
						</div>
						<div class="col-lg-4  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Kontaktujte nás</h4>
								<p>
									Odpíšeme na každú otázku, požiadavku, dopyt, ponuku, atď.
								</p>
								<a class="tel" href="/kontakt.php">Kontaktný formulár</a><br>
								Email: <a class="tel" href="mailto:info@jazdectvoprekazdeho.sk">info@jazdectvoprekazdeho.sk</a><br>
							</div>
						</div>						
						<div class="col-lg-5  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Newsletter</h4>
								<p>Buďte informovaný o zaujímavých udalostiach a novinkách</p>
								<div class="d-flex flex-row" id="mc_embed_signup">


									  <form class="navbar-form" novalidate="true" action="">
									    <div class="input-group add-on align-items-center d-flex">
									      	<input class="form-control" name="EMAIL" placeholder="Váš email" id="newsLetterEmail" autocomplete="off" type="email">
									      <div class="input-group-btn">
									        <button class="genric-btn addToNewsLetter" type="button" title="Uložiť">&gt;</button>
									      </div>
									    </div>
									      <div class="info mt-20"></div>									    
									  </form>
								</div>
							</div>
						</div>						
					</div>
					<div class="footer-bottom row">
						<p class="footer-text m-0 col-lg-6 col-md-12">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Všetky práva vyhradené
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						<br>
						<a href="/ochrana-udajov.php">Ochrana osobných údajov</a><br>
						<a href="/sitemap-html.php">Sitemap</a>
                        </p>
						<div class="footer-social col-lg-6 col-md-12">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="float: left;width: auto;display:table">
                            <span style="display: table-cell;vertical-align: middle;padding-right:10px;font-weight: 500;">Prispieť na chod stránky</span>
                            <input type="hidden" name="cmd" value="_s-xclick" />
                            <input type="hidden" name="hosted_button_id" value="RP7XDCNL6M4JU" />
                            <input type="image" id="donateButton" src="https://jazdectvoprekazdeho.sk/img/button_prispiet.png" border="0" name="submit" title="Váš príspevok pomáha rozvíjať jazdeckú scénu" />
                        </form>
							<a target="_blank" style="float: right;position: absolute;bottom: 5px;" title="Facebook stránka" href="https://www.facebook.com/Jazdectvo-pre-každého-1096185167215068/"><i class="fa fa-facebook"></i></a>
						</div>
					</div>
				</div>
			</footer>	
			<!-- End footer Area -->

<?php
include('welcomeMessage.php');
?>