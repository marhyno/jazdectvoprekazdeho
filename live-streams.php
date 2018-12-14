 <!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
		<title>Live Streams - <?php echo $siteName; ?></title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">					
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	
			<link rel="stylesheet" href="css/owl.carousel.css">
			<link rel="stylesheet" href="css/main.css">
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
							<h1 class="text-white">
								LIVE STREAMY		
							</h1>	
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href=""> Live Streams</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start Live Streams Area -->
				<section class="upcoming-event-area" style="padding:30px;">
					<div class="container" style="max-width: 100%;">
						<div class="row d-flex justify-content-center">
							<div class="col-md-9 pb-40 header-text text-center">
								<h1 class="pb-30">Zoznam Live Streamov</h1>
								<div id="feiChannel"><h3>FEI Streams<br>(Fédération Equestre Internationale)</h3></div>
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
						$('.loading').hide();
					},
					error: function (data) {
						$('.loading').hide();
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
							$('#feiChannel').append('<br><h5><u>Pripravované FEI LIVE Streamy</u></h5>');	
							if (liveVideos.items.length > 0){
								for (var x = 0; x < liveVideos.items.length; x++) {
									$('#feiChannel').append('<br><h6>'+liveVideos.items[x].snippet.title+'</h6><br><iframe width="80%" height="500px" src="https://www.youtube.com/embed/'+liveVideos.items[x].id.videoId+'" frameborder="0" allowfullscreen></iframe><br><hr>')
								}
							}else{
								$('#feiChannel').append('<br><p>Momentálne sa nepripravujú žiadne live streamy</p>');
							}
							$('.loading').hide();
						},
						error: function (data) {
							$('.loading').hide();
							warningAnimation('Vyskytol sa problém s preberaním youtube live streamov. Chyba:' + data.responseText);
						}
					});
				}
			});
			</script>	
		</body>
	</html>



