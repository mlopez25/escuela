<?php 
    get_header();
?>
<body>

    <div class="banner1">
		<div class="container">
			
			<div class="banner-main">
				<div class="banner-main1">
					<div class="logo animated wow slideInLeft" data-wow-delay=".5s">
						<a href="https://proyect-school-krast.c9users.io/wp/"><div class="logoBanner"></div></a>
					</div>
					<div class="header-right">
						<div class="shy-menu">
							<a class="shy-menu-hamburger">
								<span class="layer top"></span>
								<span class="layer mid"></span>
								<span class="layer btm"></span>
							</a>
							<div class="shy-menu-panel">
							<?php get_template_part('template-parts/nav'); ?>

							</div>
							<div class="clearfix" id="cuadroMenu"> </div>
						</div>
						<div class="menu open">
						  <a class="hamburger">
							<span class="layer top"></span>
							<span class="layer mid"></span>
							<span class="layer btm"></span>
						  </a>
						</div>
						<script>
							$(function() {
								initDropDowns($("div.shy-menu"));
							});

							function initDropDowns(allMenus) {
								allMenus.children(".shy-menu-hamburger").on("click", function() {
									var thisTrigger = jQuery(this),
										thisMenu = thisTrigger.parent(),
										thisPanel = thisTrigger.next();
									if (thisMenu.hasClass("is-open")) {
										thisMenu.removeClass("is-open");
									} else {			
										allMenus.removeClass("is-open");	
										thisMenu.addClass("is-open");
										thisPanel.on("click", function(e) {
											e.stopPropagation();
										});
									}
									return false;
								});
							}
						</script>
					</div>
					<div class="clearfix"> </div>
					<div class="flexslider-info animated wow zoomIn" data-wow-delay=".5s">
					<section class="slider">
						<div class="flexslider">
							<div class="banner-info">
								<p class="title"><?php _e('Noticias', 'landmarkcollege'); ?></p>
							</div>
						</div>
					</section>
				</div>
				</div>
			</div>
		</div>
	</div>
    <div class="container CSingle">
        
                <div class="col-lg-8 contS">
                    <?php
                        the_post();
                        	?><div class="singleThumb"><?php
                        	echo the_post_thumbnail();
                            ?></div>
                            <div class="col-lg-2">
            	        	<div class="fechaNoticias">
            	        		<p><?php echo get_the_date('j'); ?></p>
            	        		<p><?php echo get_the_date('F'); ?></p>
            	        		</div>
            	        </div>
            	        
            	        
            	        <div class="col-lg-10">
            	        <h2 class="tituloSingle"><?php the_title(); ?></h2><div class="infoAutS">
                       		<div class="infoAutoLink authorDest">
                       			<?php echo the_author_posts_link(); ?>
                       		</div>
                       		
            	        </div><div class="postCont">
            	        <?php
                            the_content();
                            ?></div><?php
                    if( comments_open() /*|| get_comments_number()*/):
                            comments_template();
                    endif;
                    ?></div>
            </div>

            <div class="col-lg-4 CSingle">
                <?php get_sidebar(); ?>

            </div>
        
        </div>

        <hr>
        
        <!--The Loop-->
        
 <?php get_footer(); ?>