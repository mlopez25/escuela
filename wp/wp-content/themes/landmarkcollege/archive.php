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
            <div class="col-lg-8 archiveNot">
            	
                <?php 
                    if(is_category()){
                        printf('<h3>'.__('Entradas de la Categoría: %s', 'landmarkcollege'),single_cat_title('',false).'</h3>');
                    }elseif(is_tag()){
                        printf('<h3>'.__('Entradas de la Etiqueta: %s', 'landmarkcollege'),single_tag_title('',false).'</h3>');
                    }elseif(is_author()){
                        the_post();
                        printf('<h3>'.__('Entradas del Autor: %s', 'landmarkcollege'), get_the_author().'</h3>');
                        rewind_posts();
                    }elseif(is_day()){
                        printf('<h3>'.__('Entradas del Día: %s', 'landmarkcollege'),get_the_date().'</h3>');
                    }elseif(is_month()){
                        printf('<h3>'.__('Entradas del Mes: %s', 'landmarkcollege'),get_the_date('F Y').'</h3>');
                    }elseif(is_year()){
                        printf('<h3>'.__('Entradas del año: %s', 'landmarkcollege'),get_the_date('Y').'</h3>');
                    }else{
                        _e('<h3>Entradas: </h3>', 'landmarkcollege');
                    }
                ?>
                
	                <?php while (have_posts()): 
	                    the_post();
	                    ?>
	                    <div class="col-lg-12 estr-archive">
	                    	<div class="fechaNoticiasDest col-lg-2">
            	        		<p><?php echo get_the_date('j'); ?></p>
            	        		<p><?php echo get_the_date('F'); ?></p>
            	          	</div>
	                    
		                    <div class="col-lg-10 content-archive">
			                    <a class="titulodestacado" href=<?php the_permalink();?>>
				                	<h3> <?php the_title(); ?></h3>
			                    </a>
			                   
			                    <div class="infoAut">
							   		<div class="infoAutoLink authorDest">
							   			<?php echo the_author_posts_link(); ?>
							   		</div>
							   		<span class="separador">|</span>
							   		<div>
							   			<a class="infoAutoLink" href="single.html">
							   				<span class="fa fa-comments"></span>
							   				<?php comments_number(__('Ningún comentario', 'landmarkcollege'),__(' 1 comentario', 'landmarkcollege'),__(' % comentarios', 'landmarkcollege')); ?>
							   			</a>
							   		</div>
								</div>
			                     <?php the_excerpt(); ?>
			                     <div class="more">
			<a href="<?php echo get_permalink($post->ID) ?>" class="hvr-sweep-to-top"><?php _e('Leer más...', 'landmarkcollege')?></a>
		</div>
		                    </div>
	                    </div> <?php
	               endwhile;
	                ?>
                
            </div>
            <div class="col-lg-4 margin-top">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
        <hr>
        
        <!--The Loop-->
        
 <?php get_footer(); ?>