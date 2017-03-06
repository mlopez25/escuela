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
							<li><i class="fa fa-camera" aria-hidden="true"></i></li>
						</ul>
					</div>
					<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
					<div class="latest-posts-grid-right post-ajuste">
						<div class="img-responsive post-img divImg">
							<div class="inicial">
								<ul>
								<?php 
								$contenido = get_post()->post_content;
								$content = mb_convert_encoding( $contenido ,'HTML-ENTITIES',"UTF-8");
		                        $document = new DOMDocument();
		                        libxml_use_internal_errors(true);
		                        $document->loadHTML(utf8_decode($content));
		                        $node = $document->getElementsByTagName('img');
		                        foreach($node as $n){
		                        	$newdoc = new DOMDocument;
									$newdoc->formatOutput = true;
									$newdoc->loadHTML('<span></span>');
									$n = $newdoc->importNode($n, true);
									$newdoc->documentElement->appendChild($n);
									 ?><li><div class="tema"><?php echo $newdoc->saveHTML();  ?></div></li><?php
		                        }
								?>
				                   
				                 </ul>
				                 <button class="galAnterior"></button>
				                 <button class="galSiguiente"></button>
				            </div>
						</div>
						<h4><a class="titulodestacado" href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
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