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
    

    <!-- Page Content -->
    <div class="container">
        
    
        <!-- Ultima entrada -->
        <div class="row archive-row">
        	
        </div>
        <div class="col-md-9 text-center searchcont">
            <div class="lead">
                <?php if(have_posts()) : ?>
                <h2 class="searchtitle">
                    <?php printf(__('Resultados de busqueda para: %s'),'<span class="busq">'.esc_html(get_search_query()).'</span></h2>'); ?>
                
                <?php 
                while (have_posts()): 
                    the_post();
                ?>
            <table class="listposts" center>
                <?php 
                get_template_part('template-parts/content','list'); 
                ?>
            </table>
            <?php  endwhile; endif;?>
            </div>
            
        </div>
    <div class="col-md-3 sidesearch">
            <?php get_sidebar(); ?>
            </div>
        <hr>
        <?php echo '<div class="col-lg-12 pagination"><span class="input-group">';
                    echo get_paginate_page_links();
                    echo '</span></div>';
                    
                    wp_reset_postdata(); ?>
                    
      </div>  
      
 <?php get_footer(); ?>