<div class="my-search-list">
    <div class="search-date">
        <p class="searchday"><?php echo get_the_date('j'); ?></p><br/>
        <p class="searchmonth"><?php echo get_the_date('F'); ?></p>
</div>
    <div class="casillaPost">
        <?php 
            if($post->post_type != 'page'){
                ?><h3 class="titAut"><?php
                
                the_title(sprintf('<a href="%s" rel="bookmark">',
                esc_url(get_permalink())),'</a>');
                ?></h3>
                <div class="infoAut">
   		
   		<div>
   			<a class="infoAutoLink" href="single.html">
   				<span class="fa fa-comments"></span>
   				<?php comments_number(__('Ningún comentario', 'landmarkcollege'),__(' 1 comentario', 'landmarkcollege'),__(' % comentarios', 'landmarkcollege')); ?>
   				&nbsp;
   				<span class="fa fa-user"></span>
   				<?php the_author(); ?>
   			</a>
   		</div>
	</div>
                <h4 class="exAut"><?php
                the_excerpt();
                ?></h4> <div class="more sidemore">
			<a href="<?php echo get_permalink($post->ID) ?>" class="hvr-sweep-to-top"><?php _e('Leer más...', 'landmarkcollege')?></a>
		</div></div><?php
            }else{
                the_title();
                echo'<span>Page</span>';
            }
        ?>
        
    </div>
</div>