<section class="col-lg-12">
    <?php get_search_form() ?>
</section>

<section class="col-lg-12 rellenar">
    <h3><?php _e('Últimos posts', 'landmarkcollege'); ?></h3>
    <div id="recent-posts">
        <?php $postslist = get_posts('numberposts=3&order=DESC'); 
        foreach ($postslist as $post) : setup_postdata($post); ?>
            <div class="col-lg-12 divUltPost">
                <div class="recent-post-thumbnail"><?php if ( has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?> </a> <?php endif; ?>
                </div>
                <div class="sideLastPosts">
                <a title="Post: <?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
                <div class="side-comments">
                <p><?php $fechapost = get_the_date( $format, $post_id ); echo $fechapost ?> &nbsp; / &nbsp; <span class="fa fa-comments-o"></span>
   				<?php comments_number(__('0', 'landmarkcollege'),__(' 1', 'landmarkcollege'),__(' %', 'landmarkcollege')); ?></p>
   				</div>
   				
            </div>

        <?php endforeach; ?>
    </div>

</section>

<section class="col-lg-12 archives rellenar">
    <h3><?php _e('Archivos', 'landmarkcollege'); ?></h3>
    <?php wp_get_archives(); ?>
    
</section>

<section class="col-lg-12 categorias rellenar">
    <h3><?php _e('Categorías', 'landmarkcollege'); ?></h3>
    <?php wp_list_categories('title_li='); ?>
</section>

<section class="col-lg-12 author rellenar">
    <h3><?php _e('Autores', 'landmarkcollege'); ?></h3>
    <?php 
    $args = array(
        "hide_empty" => false,
        "exclude_admin" => false
    );
    wp_list_authors($args); ?>
</section>

<section class="col-lg-12 rellenar">
    <h3><?php _e('Páginas', 'landmarkcollege'); ?></h3>
    <?php get_pages('title_li=&sort_column=menu_order'); ?>
</section>