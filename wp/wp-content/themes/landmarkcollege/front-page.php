<?php
	get_header();
?>

<body>

<!-- banner -->
	<div class="banner">
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
							<div class="shy-menu-panel menu_link_inicio">
							<!----******************************************* AQUÍ EL NAVEGADOR ********** -->
							<?php get_template_part('template-parts/nav'); ?>
							<!----******************************************* FIN DEL NAVEGADOR ********** -->
							</div>
							<div class="clearfix"> </div>
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
				</div>
				<div class="flexslider-info animated wow zoomIn" data-wow-delay=".5s">
					<section class="slider">
						<div class="flexslider">
							<ul class="slides">
								<li>
									<div class="banner-info">
										<h4>Landmark College</h4>
										<p><?php _e('Alcanza', 'landmarkcollege'); ?><span><?php _e('tus metas', 'landmarkcollege'); ?></span></p>
									</div>
								</li>
								<li>
									<div class="banner-info">
										<h4>Landmark College</h4>
										<p><?php _e('Un lugar', 'landmarkcollege'); ?> <span><?php _e('para el progreso', 'landmarkcollege'); ?></span></p>
									</div>
								</li>
								<li>
									<div class="banner-info">
										<h4>Landmark College</h4>
										<p><?php _e('Investiga, aprende', 'landmarkcollege'); ?> <span><?php _e('Sueña', 'landmarkcollege'); ?></span></p>
									</div>
								</li>
							</ul>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
<!-- banner -->
<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<h3 class="animated wow zoomIn" data-wow-delay=".5s">Bienvenido a<span>Landmark College</span></h3>
			<div class="banner-bottom-grids">
				<div class="banner-bottom-grid">
					<div class="col-md-4 banner-bottom-grid-left animated wow slideInLeft" data-wow-delay=".5s">
						<img src="<?php bloginfo( 'template_url' ); ?>/images/studentfront.jpg" alt=" " class="img-responsive" />
						
					</div>
					<div class="col-md-8 banner-bottom-grid-right animated wow slideInRight" data-wow-delay=".5s">
						<h4 id="educh4"><?php _e('Un centro comprometido con la educación', 'landmarkcollege'); ?></h4>
						<p><?php _e('Landmark College es un centro ubicado en Soria, España. Destaca del resto, debido a que ha sido 
							construido recientemente y ha sido equipado con los últimos recursos disponibles en educación. Lo que lo sitúa como el instituto
							más prestigioso de España siendo de carácter público.', 'landmarkcollege'); ?></p>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
							  <h4 class="panel-title asd">
								<a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i><label class="horse1">Nuevas Instalaciones</label></label>
								</a>
							  </h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
							  <div class="panel-body panel_text">
								<div class="scrollbar" id="style-2">
									<?php _e('
									El instituto cuenta con varias aulas habilitadas para que el alumnado pueda aprender de la mejor forma. Estas aulas se encuentran distribuidas en los diferentes edificios.<br/>
									Quizás las instalaciones más destacadas es que todas las aulas están informatizadas, cuentan con proyectores, pizarras táctiles, y portátiles a disposición del alumnado.<br/>
									Algunas de las aulas habilitadas para el alumnado que pueden encontrar son: gimnasio, piscina, laboratorio de física y química, auditorio, sala de informática, biblioteca, laboratorio de biología y geología, taller de tecnología…
									', 'landmarkcollege'); ?>
								</div>
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingTwo">
							  <h4 class="panel-title asd">
								<a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								  <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i><label class="horse2">Zonas Deportivas</label>
								</a>
							  </h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							   <div class="panel-body panel_text">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingThree">
							  <h4 class="panel-title asd">
								<a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								  <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span><i class="glyphicon glyphicon-menu-up" aria-hidden="true"></i><label class="horse3">Nuestras clases</label>
								</a>
							  </h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							   <div class="panel-body panel_text">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
							  </div>
							</div>
						  </div>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
<!-- //banner-bottom -->
<!-- services -->
	<div class="services">
		<div class="container">
			<h3 class="animated wow zoomIn" data-wow-delay=".5s">Landmark College <span><?php _e('NOTICIAS', 'landmarkcollege')?></span></h3>
			<div class="services-grids">
				
				<?php $args = array(
               		
                     'nopaging'=>false,
                     'post_type' => array('post'),
                     'posts_per_page' => 4,
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
                           ?> 
                            <div class="col-md-3 services-grid animated wow slideInLeft front-notice" data-wow-delay=".5s">
					<div class="services-grid1">
						<div class="item item-type-zoom">
							<a class="item-hover" href="<?php echo get_permalink($post->ID)  ?>">
								<div class="item-info">
									<div class="headline">
										
										<div class="date"><?php echo get_the_date('j F, Y'); ?></div>			
									</div>
								</div>
								<div class="mask"></div>
							</a>
							<div class="item-img imagedepost"><?php the_post_thumbnail(); ?></div>
						</div>	
					</div>
					<h4><a href="single.html"  class="notfront"><?php the_title(); ?></a></h4>
					<p><?php the_excerpt(); ?></p>
					<div class="more m1">
						<a href="<?php echo get_permalink($post->ID) ?>" class="hvr-sweep-to-top"><?php _e('Leer más...', 'landmarkcollege')?></a>
					</div>
				</div>
                    <?php        
                            endwhile;
                   endif;  
                   wp_reset_postdata();
                   ?>

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //services -->
<!-- latest-posts -->
	<div class="latest-posts">
		<div class="container">
			<div class="menuCuadros">
				
					<div class="itemCuadro" id="c1" onclick="window.location='/wp/';">
						<i class="fa fa-home"></i><p><?php _e('Inicio', 'landmarkcollege')?></p>
					</div>
				
				
					<div class="itemCuadro" id="c2" onclick="window.location='/wp/noticias/';">
						<i class="fa fa-book"></i><p><?php _e('Noticias', 'landmarkcollege')?></p>
					</div>
				
			
					<div class="itemCuadro" id="c3" onclick="window.location='/actividades/';">
						<i class="fa fa-paper-plane"></i><p><?php _e('Actividades', 'landmarkcollege')?></p>
					</div>
				
			
					<div class="itemCuadro" id="c4" onclick="window.location='/wp/colegio';">
						<i class="fa fa-cubes"></i><p><?php _e('Colegio', 'landmarkcollege')?></p>
					</div>
			
				
					<div class="itemCuadro" id="c5" onclick="window.location='/wp/colegio#cursos';">
						<i class="fa fa-bookmark"></i><p><?php _e('Cursos', 'landmarkcollege')?></p>
					</div>
				
		
					<div class="itemCuadro" id="c6" onclick="window.location='/wp/contacto/';">
						<i class="fa fa-envelope"></i><p><?php _e('Contacto', 'landmarkcollege')?></p>
					</div>
			
			</div>
		</div>
	</div>
<?php get_footer(); ?>