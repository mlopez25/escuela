<?php get_header();
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>
<body>
<div class="banner1">
		<div class="container author_container">
			
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
								<p class="title"><?php _e($curauth->nickname, 'landmarkcollege') ?></p>
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
        <div class="col-lg-4 author_all">
                
                    <div class="col-lg-6">
                    <?php
                    if(has_gravatar($curauth->user_email)){
                        echo get_avatar($curauth->ID);
                    }else if(tiene_foto($curauth->nickname)===FALSE){
                        _e('No Tiene foto', 'landmarkcollege');
                    }else{
                        ?> <img src="<?php echo tiene_foto($curauth->nickname)?>" width="150px" class="author_img"> <?php
                    }
                        ?>
                    </div>
                    <div class="col-lg-6 author_desc_all">
                        <div class="row">
                                <h3 class="author_nick">
                            <?php 
                            echo $curauth->display_name;
                            ?>
                                </h3>
                                <hr>
                            </div>
                            <div class="row author_description">
                            <?php
                            echo $curauth->description; 
                            ?><hr>
                        </div>
                    
                </div>
                <div class="col-lg-6 author_social"><a href="mailto:<?php echo esc_attr(the_author_meta('gmail', $user->ID)); ?>"><img class="social-icon" src="/wp/wp-content/themes/landmarkcollege/images/gmail.svg"></a>
                <a href="http://<?php echo esc_attr(the_author_meta('linkedin', $user->ID)); ?>"><img class="social-icon" src="/wp/wp-content/themes/landmarkcollege/images/linkedin.svg"></a>
                <a href="http://<?php echo esc_attr(the_author_meta('blogger', $user->ID)); ?>"><img class="social-icon" src="/wp/wp-content/themes/landmarkcollege/images/blogger.svg"></a></div>
            </div>
            <div class="col-lg-8 author_posts">
                <h2>Últimos posts de: <?php echo $curauth->display_name ?></h2><table>
                <?php 
                    
                	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $args = array(
                     'posts_per_page'=>'6',
                     'nopaging'=> false,
                     'author'=> $curauth->ID,
                     'paged' => $paged,
                    );
                    $custom_query = new WP_Query($args);
                    if($custom_query->have_posts()):
                        while($custom_query->have_posts()):
                            $custom_query->the_post();
                            get_template_part('template-parts/content','authorlist');
                        endwhile;
                        echo '</table><div class="col-lg-12 pagination"><span class="input-group">';
                    echo get_paginate_page_links();
                    echo '</span></div>';
                   endif;
                wp_reset_postdata();    
                ?>
            </div>
            
  </div>

 <?php get_footer(); ?>
