<?php
	get_header();
?>

<body>
	
<!-- banner -->
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
							<div class="shy-menu-panel menu_link_noticias">
							<!----******************************************* AQUÍ EL NAVEGADOR ********** -->
							<?php get_template_part('template-parts/nav'); ?>
							<!----******************************************* FIN DEL NAVEGADOR ********** -->
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
<!-- banner -->
<div class="container">
            <div class="col-lg-12 PostDestacado">
               <?php $args = array(
               		
                     'nopaging'=>false,
                     'post_type' => array('post'),
                     'posts_per_page' => 1,
                     'tax_query' => array(
                                        array(
                                            'taxonomy'=>'post_format',
                                            'field' => 'slug',
                                            'terms' => array(
                                                            'post-format-aside',
                                                            'post-format-gallery',
                                                            'post-format-link',
                                                            'post-format-image',
                                                            'post-format-quote',
                                                            'post-format-status',
                                                            'post-format-audio',
                                                            'post-format-chat',
                                                            'post-format-video'
                                            ),
                                            'operator' => 'NOT IN'
                                        )
                    )
                    );
                    $custom_query = new WP_Query($args);
                    if($custom_query->have_posts()):
                        while($custom_query->have_posts()):
                            $custom_query->the_post();
                            $format = get_post_format();
                            $idDestacado = get_the_ID();
                        	get_template_part('template-parts/content','postdest');   
                            endwhile;
                   endif;  
                   wp_reset_postdata();
                   ?>
                <div class="">
                 
                </div>
            </div>
            
        </div>
        <div class="container rowGeneral">
            <div class="col-lg-8 prueba1">
        	<?php	
        		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
        		$args = array(
                'post__not_in'=>array($idDestacado),
                'post_type' => array('post'),  
                'nopaging'=>false,
                'paged' => $paged,
            );
            $custom_query = new WP_Query($args);
            if($custom_query->have_posts()):
                while($custom_query->have_posts()):
                    $custom_query->the_post();?>
                    <?php get_template_part('template-parts/content', get_post_format())?>
                    <?php
                    endwhile;
                    echo '<div class="col-lg-12 pagination"><span class="input-group">';
                    echo get_paginate_page_links();
                    echo '</span></div>';
                    endif;
                    wp_reset_postdata(); ?>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>

<?php get_footer(); ?>
