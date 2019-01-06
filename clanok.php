<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
	<?php include('meta.php'); ?>
	<meta name="description" content="Jazdectvo je naozaj pre všetkých, nie len pre určitú skupinu ľudí. Objavte čaro prepojenia medzi človekom a koňom. Všetky potrebné informácie, udalosti, blogy nájdete na tejto stránke.">	
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
												<li><a href="#"><span class="lnr lnr-heart"></span>	4 likes</a></li>
												<li><a href="#"><span class="lnr lnr-bubble"></span> 06 Comments</a></li>
											</ul>
										</div>
										<div class="social-wrap col-lg-6">
											<ul>
                                                <li id="dateAdded"></li>
												<li><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											</ul>
											
										</div>
									</div>
								</div>

                            <!-- Start nav Area -->
                            <section class="nav-area pt-50 pb-100">
                                <div class="nextPrevArticles">
                                    <div class="row justify-content-between">
                                        <div class="col-sm-6 nav-left d-flex previousArticle">
                                            <div class="thumb">
                                                <a><img alt=""></a>
                                            </div>
                                            <div class="post-details">
                                                <p></p>
                                                <h5 class="text-uppercase"><a></a></h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 nav-right justify-content-end d-flex nextArticle">
                                            <div class="post-details">
                                                <p></p>
                                                <h5 class="text-uppercase"><a></a></h5>
                                            </div>             
                                            <div class="thumb">
                                                <img alt="">
                                            </div>                         
                                        </div>
                                    </div>
                                </div>    
                            </section>
                            <!-- End nav Area -->

                            <!-- Start comment-sec Area -->
                            <!--<section class="comment-sec-area pt-80 pb-80">
                                <div class="container">
                                    <div class="row flex-column">
                                        <h5 class="text-uppercase pb-80">05 Comments</h5>
                                        <br>
                                        <div class="comment-list">
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb">
                                                        <img src="img/blog/c1.jpg" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        <h5><a href="#">Emilly Blunt</a></h5>
                                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                                        <p class="comment">
                                                            Never say goodbye till the end comes!
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="reply-btn">
                                                       <a href="" class="btn-reply text-uppercase">reply</a> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-list left-padding">
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb">
                                                        <img src="img/blog/c2.jpg" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        <h5><a href="#">Emilly Blunt</a></h5>
                                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                                        <p class="comment">
                                                            Never say goodbye till the end comes!
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="reply-btn">
                                                       <a href="" class="btn-reply text-uppercase">reply</a> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-list left-padding">
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb">
                                                        <img src="img/blog/c3.jpg" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        <h5><a href="#">Emilly Blunt</a></h5>
                                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                                        <p class="comment">
                                                            Never say goodbye till the end comes!
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="reply-btn">
                                                       <a href="" class="btn-reply text-uppercase">reply</a> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-list">
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb">
                                                        <img src="img/blog/c4.jpg" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        <h5><a href="#">Emilly Blunt</a></h5>
                                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                                        <p class="comment">
                                                            Never say goodbye till the end comes!
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="reply-btn">
                                                       <a href="" class="btn-reply text-uppercase">reply</a> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-list">
                                            <div class="single-comment justify-content-between d-flex">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb">
                                                        <img src="img/blog/c5.jpg" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        <h5><a href="#">Emilly Blunt</a></h5>
                                                        <p class="date">December 4, 2017 at 3:12 pm </p>
                                                        <p class="comment">
                                                            Never say goodbye till the end comes!
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="reply-btn">
                                                       <a href="" class="btn-reply text-uppercase">reply</a> 
                                                </div>
                                            </div>
                                        </div>                                                                                                                                                                
                                    </div>
                                </div>
                            </section>-->
                            <!-- End comment-sec Area -->
                            
                            <!-- Start commentform Area -->
                            <section class="commentform-area pt-80">
                                <?php include('contactForm.php'); ?>
                            </section
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
            <script>
                getNumberOfNewsByCategories();
                getLatestNewsSideBar();
                getNewsArchiveList();
                getSingleNewsArticle();
            </script>
        </body>
    </html>

