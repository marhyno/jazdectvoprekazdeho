<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
    <?php 
    $curl = curl_init();
    // Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://' . $_SERVER['HTTP_HOST'] . '/api/callBackend/getSingleNewsArticle/'.$_GET['nazov']
    ));
    // Send the request & save response to $resp
    $resp = json_decode(curl_exec($curl));
    echo '<meta property="og:url" content="https://' . $_SERVER['HTTP_HOST'] . '/clanok.php?nazov=' . $resp[0] -> slug . '" />';
    echo '<meta property="og:title" content="'.$resp[0] -> title.'" />';
    echo '<meta property="og:description" content="'.substr(strip_tags($resp[0] -> body),0,200).'..." />';
    echo '<meta property="og:image" content="https://' . $_SERVER['HTTP_HOST'] . $resp[0] -> titleImage . '"/>';
    echo '<meta property="fb:app_id" content="425429784657516"/>';
    include('meta.php'); 
    ?>
        <meta property="og:type" content="article" />
		<title><?php echo $siteName; ?></title>
        <?php
        	include('styleSheets.php');
        ?>
		</head>
		<body>
		<?php 
			$news = "menu-active";
			include('header.php'); 
		?>
			
			<!-- Start blog-posts Area -->
			<section class="blog-posts-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 post-list blog-post-list">
							<div class="single-post">
                                <img class="img-fluid" src="" alt="">
								<ul class="tags">
								</ul>
                                <h1 id="title">
                                </h1>
								<div class="content-wrap"> <!-- TO DO ADD <blockquote class="generic-blockquote">-->								
								</div>
								<div class="bottom-meta">
									<div class="user-details row align-items-center">
										<div class="comment-wrap col-lg-6 col-sm-6">
											<ul>
                                                <li id="writtenBy"></li>
												<!--<li><a href="#"><span class="lnr lnr-heart"></span>	4 likes</a></li>-->
												<!--<li><a href="#"><span class="lnr lnr-bubble"></span> 06 Comments</a></li>-->
											</ul>
										</div>
										<div class="social-wrap col-lg-6">
											<ul>
                                                <li id="dateAdded"></li>
												<li><a class="facebookShare" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'https://' . $_SERVER['HTTP_HOST'] . '/clanok.php?nazov=' . $resp[0] -> slug; ?>" title="Zdielať na Facebooku"><i class="fa fa-facebook"></i></a> - Zdieľané <span id="shareCount"></span>x</li>
												<!--<li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
											</ul>
										</div>
									</div>
								</div>
                            <hr>
                            <!-- Start nav Area -->
                            <section class="nav-area pt-50 pb-100">
                                <div class="nextPrevArticles">
                                    <div class="row justify-content-between">
                                        <div class="col-sm-6 nav-left d-flex previousArticle">
                                            <a>
                                                <div class="thumb" style="width: fit-content;float: left;">
                                                    <img alt="">
                                                </div>
                                                <div class="post-details">
                                                    <p></p>
                                                    <h5 class="text-uppercase"></h5>
                                                </div>  
                                            </a>
                                        </div>
                                        <div class="col-sm-6 nav-right justify-content-end d-flex nextArticle">
                                            <a>   
                                                <div class="thumb" style="width: fit-content;float: right;">
                                                    <img alt="">
                                                </div>
                                                <div class="post-details">
                                                    <p></p>
                                                    <h5 class="text-uppercase"></h5>
                                                </div>     
                                            </a>
                                        </div>
                                    </div>
                                </div>    
                            </section>
                            <!-- End nav Area -->

                            <!-- Start comment-sec Area -->
                            <section class="comment-sec-area pt-20 pb-20">
                                <div class="container">
                                    <div class="row flex-column">
                                        <h5 class="text-uppercase pb-20">Komentáre</h5>
                                        <a class="primary-btn" id="addComment">Pridať komentár</a>
                                        <div class="comment-list">
                                        </div>                                                                                                               
                                    </div>
                                </div>
                            </section>
                            <!-- End comment-sec Area -->
                            
                            <!-- Start commentform Area -->
                            <section class="commentform-area pt-80">
                                <?php include('contactForm.php'); ?>
                            </section>
                            <!-- End commentform Area -->


							</div>																		
						</div>
						<?php
						include('newsSideBar.php');
						?>
					</div>
				</div>	
			</section>
			<!-- End blog-posts Area -->

            <?php
            include('footer.php');
            include('footerScripts.php');
            ?>
            <script>
            $(document).ready(function(){
                $("#header").addClass("header-scrolled");
            })
            </script>
            <script src="/js/lightbox.min.js"></script>
            <link rel="stylesheet" href="/css/lightbox.min.css">
            <script>
                getNumberOfNewsByCategories();
                getLatestNewsSideBar();
                //getNewsArchiveList();
                getSingleNewsArticle();
                loadComments();
            </script>
        </body>
    </html>

