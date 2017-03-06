<?php
/* Template Name: College Template */
	get_header();
?>

<body>
	
<!-- banner -->
	<div class="banner1">
		<div class="container">
			<div class="banner-main">
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
							<div class="shy-menu-panel menu_link_contacto">
							<!----******************************************* AQUÍ EL NAVEGADOR ********** -->
							<?php get_template_part('template-parts/nav'); ?>
							<!----******************************************* FIN DEL NAVEGADOR ********** -->
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
								<p class="title"><?php _e('Contacto', 'landmarkcollege'); ?></p>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
<!-- banner -->


<!-- contact -->
	<div class="contact-sub">
		<div class="contact">
			<div class="container">
				<h3 class="animated wow zoomIn" data-wow-delay=".5s"><?php _e('Landmark College', 'landmarkcollege'); ?><span><?php _e('Contacto', 'landmarkcollege'); ?></span></h3>
				<div class="contact-grids">
					<div class="col-md-4 contact-grid-left animated wow slideInLeft" data-wow-delay=".5s">
						<h4><?php _e('Información de Contacto.', 'landmarkcollege'); ?></h4>
						<ul>
							<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>23 Nicolás Rabal,<span>Soria, España.</span></li>
							<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">landmark_college@gmail.com</a></li>
							<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+34 980 928 829</li>
						</ul>
						<br/>
						<ul>
							<li><?php _e('Horario de Secretaria:', 'landmarkcollege'); ?></li>
							<li><i class="glyphicon" aria-hidden="true"></i></i><?php _e('Lunes a Viernes: 8.00 a 14.00h', 'landmarkcollege'); ?></li>
						</ul>
					</div>
					<div class="col-md-8 contact-grid-right animated wow slideInRight" data-wow-delay=".5s">
						<form>
							<input type="text" value="Nombre" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nombre';}" required="">
							<input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
							<textarea type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Comentario...';}" required=""><?php _e('Comentario...', 'landmarkcollege'); ?></textarea>
							<input type="submit" value="Enviar">
							<input type="reset" value="Limpiar">

						</form>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
<!-- //contact -->

<!-- footer -->
<?php get_footer(); ?>
<!-- //fin footer -->