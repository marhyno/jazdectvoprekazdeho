	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<?php include('meta.php'); ?>
		<title>Novinky <?php echo urldecode($_GET['category']) == "" ? "zo sveta koní" : "z kategórie - " . urldecode($_GET['category']); ?> - <?php echo $siteName; ?></title>
		<?php
        	include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$news = "menu-active";
			include('header.php'); 
		?>

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h2 class="text-white">
								Novinky a články <?php echo urldecode($_GET['category']) == "" ? "zo sveta koní" : "z kategórie - " . urldecode($_GET['category']); ?>		
                            </h2>
							<p class="text-white link-nav"><a href="/">Domov </a>  <span class="lnr lnr-arrow-right"></span>  <a href="">Novinky / Články</a></p>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
			
			<!-- Start blog-posts Area -->
			<section class="blog-posts-area section-gap noPadding">
				<div class="container">
					<div class="row">
                        <h4 style="display:none;" id="assetsFound"></h4>
						<div class="col-lg-8 post-list blog-post-list" id="newsList">																			
						</div>
						<?php
						include('newsSideBar.php');
						?>
					</div>
				</div>	
			</section>
			<!-- End blog-posts Area -->
		
			<?php include('footer.php'); ?>
			<?php include('footerScripts.php'); ?>
		</body>
		<script>
		getNumberOfNewsByCategories();
		getLatestNewsSideBar();
        //getNewsArchiveList();
        getFiveNewsInNewsPage();
		</script>
	</html>



