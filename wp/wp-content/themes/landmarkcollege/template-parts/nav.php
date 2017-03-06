<nav class="menu menu--horatio">
	<ul class="menu__list">
		<li class="menu__item"><a href="<?php echo esc_url(home_url()); ?>" class="menu__link menu_link_inicio"><?php _e('Inicio', 'landmarkcollege')?></a></li>
		<li class="menu__item"><a href="<?php echo get_page_link(get_page_by_title('Noticias')->ID); ?>" class="menu__link menu_link_noticias"><?php _e('Noticias', 'landmarkcollege')?></a></li> 
		<li class="menu__item"><a href="https://proyect-school-krast.c9users.io/actividades/index.php" class="menu__link menu_link_actividades"><?php _e('Actividades', 'landmarkcollege')?></a></li> 
		<li class="menu__item"><a href="<?php echo get_page_link(get_page_by_title('Colegio')->ID); ?>" class="menu__link menu_link_colegio"><?php _e('Colegio', 'landmarkcollege')?></a></li>
		<li class="menu__item"><a href="<?php echo get_page_link(get_page_by_title('Colegio')->ID); ?>#cursos" class="menu__link menu_link_cursos"><?php _e('Cursos', 'landmarkcollege')?></a></li> 
		<li class="menu__item"><a href="<?php echo get_page_link(get_page_by_title('Contacto')->ID); ?>" class="menu__link menu_link_contacto"><?php _e('Contacto', 'landmarkcollege')?></a></li>
	</ul>
</nav>