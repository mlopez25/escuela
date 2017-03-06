<?php
if(post_password_required())
    return;
?>
<div>
    
</div>
 
<?php 
    echo '<ul>';
?>
    <div class="comment list">
        <h3>
            <?php 
                comments_number(__('No hay comentarios', 'landmarkcollege'),__('1 Comentario', 'landmarkcollege'),__('% Comentarios', 'landmarkcollege'));
                _e(' en "', 'landmarkcollege'); 
                the_title(); 
            ?>" 
        </h3>
        <?php comment_form(); 
            if(have_comments()):?>
                <ol class="">
        <?php
                wp_list_comments( array( 'style' => 'ol', 'avatar_size' => 50, ) );  ?>
        </ol>
        <?php endif; ?>
    </div>
<?php
    echo '</ul>';
?>