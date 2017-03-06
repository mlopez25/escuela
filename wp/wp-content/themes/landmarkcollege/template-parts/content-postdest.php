
<div class="col-lg-12">
    
	<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
	<div class="">
		<a href="<?php echo get_permalink($post->ID) ?>">
			<div style="background-image:url(<?php echo $thumb['0'];?>)" class="imgDest divImg"/>
			</div>
		</a>
	</div>
</div>

 <div class="contFecha col-lg-2">
            	        	<div class="fechaNoticiasDest">
            	        		<p><?php echo get_the_date('j'); ?></p>
            	        		<p><?php echo get_the_date('F'); ?></p>
            	        		</div>
  </div>
<div class="col-lg-10 textoDestacado">
	<a class="titulodestacado" href=" <?php echo the_permalink(); ?>">
	    <h3  class="tituloD">
	        <?php the_title(); ?>
	    </h3>
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
	<div class="">
		 <p><?php echo the_excerpt(); ?></p>
  	</div>
</div>