<div class="col-md-4 latest-posts-grid animated wow slideInLeft ajusteMedidas not" data-wow-delay=".5s">
					<div class="latest-posts-grid-left">
						<ul class="post-date">
							<?php 
								$diasemana=get_the_time('l');
		                        ?> <span class="mes-pequeno"> <?php $mes=get_the_time('F'); ?></span> <?php
		                        $dia=get_the_time('j');
                  			?>
							<li><?php echo $dia;?> <span><?php echo $mes;?></span></li>
						</ul>
						<ul class="post-date1">
							<li><i class="fa fa-link" aria-hidden="true"></i></li>
						</ul>
						
					</div>
					<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
					<div class="latest-posts-grid-right post-ajuste">
						<a href="<?php echo get_permalink($post->ID) ?>"><div class="img-responsive post-img divImg linkImg"></div></a>
						<h4><a class="titulodestacado" href="<?php echo the_permalink(); ?>"></span><?php the_title(); ?></a></h4>
						<ul>	
							<!--<li>April 15, 2016</li>-->
							<li><a href="single.html" class="fa fa-comments resumen"><?php comments_number(__(' Ningún comentario','landmarkcollege'),__(' 1 comentario','landmarkcollege'),__(' % comentarios','landmarkcollege')); ?></a><span class="separador"> | </span></li>
							<li><a href="single.html" class=" fa fa-eye resumen"> <?php echo bac_PostViews(get_the_ID());  ?></a></li>
						</ul>
						<?php the_excerpt(); ?>
						<div class="more">
							<a href="<?php echo get_permalink($post->ID) ?>" class="hvr-sweep-to-top"><?php _e('Leer más...', 'landmarkcollege')?></a>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>