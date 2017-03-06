<tr>
       
            <td class="casillafecha">
                    	<div class="fechaNoticias">
            	        		<p><?php echo get_the_date('j'); ?></p><br/>
            	        		<p><?php echo get_the_date('F'); ?></p>
            	           </div>
                </td>
    
    <td class="casillaPost">
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
   			</a>
   		</div>
	</div>
                <h4 class="exAut"><?php
                the_excerpt();
                ?></h4></div><?php
            }else{
                the_title();
                echo'<span>Page</span>';
            }
        ?>
        <div class="more">
			<a href="<?php echo get_permalink($post->ID) ?>" class="hvr-sweep-to-top"><?php _e('Leer más...', 'landmarkcollege')?></a>
		</div>
    </td>
</tr>