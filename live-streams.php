 <!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Live Streams - <?php echo $siteName; ?></title>
		<?php
        	include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$liveStreams = "menu-active";
			include('header.php'); 
		?>
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								LIVE STREAMY		
							</h2>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Live Streams</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start Live Streams Area -->
				<section class="upcoming-event-area" style="padding-top:30px;">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pb-40 header-text text-center">
								<h2 class="pb-30">Zoznam Live Streamov</h2>
								<div id="feiChannel"><h4>FEI Streams<br>(Fédération Equestre Internationale)</h4></div>
							</div>
						</div>							
					</div>
				</section>
			<!-- End Live Streams Area -->
										
 			<?php include('feedBacks.php'); ?>
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>
			<script>
			$(document).ready(function () {		
				//FEI LIVE STREAMS
				$.ajax({
					processData: false,
					contentType: false,
					type: 'GET',
					url: 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCb3uedNKWKG7gGDYQJ1VsWg&eventType=live&type=video&key=AIzaSyBT_NSLzSvpELApIh4Aqc1S5hS02521kZI',
					data: {},
					success: function (liveVideos) {
						$('#feiChannel').append('<br><h5><u>Prebiehajúce FEI LIVE Streamy</u></h5>');	
						if (liveVideos.items.length > 0){	
							for (var x = 0; x < liveVideos.items.length; x++) {
								$('#feiChannel').append('<br><h6>'+liveVideos.items[x].snippet.title+'</h6><br><iframe width="80%" height="500px" src="https://www.youtube.com/embed/'+liveVideos.items[x].id.videoId+'" frameborder="0" allowfullscreen></iframe><br><hr>')
							}
						}else{
							$('#feiChannel').append('<br><p>Momentálne nie sú žiadne live streamy k dispozícii</p>');
						}
						$('.loading').fadeOut(400);
					},
					error: function (data) {
						$('.loading').fadeOut(400);
						warningAnimation('Vyskytol sa problém s preberaním youtube live streamov. Chyba:' + data.responseText);
					},
					complete: function(data) {
						fetchUpcomingStreams();
					}
				});

				//UPCOMING FEI LIVE STREAMS
				function fetchUpcomingStreams() {
					$.ajax({
						processData: false,
						contentType: false,
						type: 'GET',
						url: 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=UCb3uedNKWKG7gGDYQJ1VsWg&eventType=upcoming&type=video&key=AIzaSyBT_NSLzSvpELApIh4Aqc1S5hS02521kZI',
						data: {},
						success: function (liveVideos) {
							$('#feiChannel').append('<br><h5><u>Pripravované FEI LIVE Streamy (vrátane repríz)</u></h5>');	
							if (liveVideos.items.length > 0){
								for (var x = 0; x < liveVideos.items.length; x++) {
									$('#feiChannel').append('<br><h6>'+liveVideos.items[x].snippet.title+'</h6><br><iframe width="80%" height="500px" src="https://www.youtube.com/embed/'+liveVideos.items[x].id.videoId+'" frameborder="0" allowfullscreen></iframe><br><hr>')
								}
							}else{
								$('#feiChannel').append('<br><p>Momentálne sa nepripravujú žiadne live streamy</p>');
							}
							$('.loading').fadeOut(400);
						},
						error: function (data) {
							$('.loading').fadeOut(400);
							warningAnimation('Vyskytol sa problém s preberaním youtube live streamov. Chyba:' + data.responseText);
						}
					});
				}
			});
			</script>	
		</body>
	</html>



