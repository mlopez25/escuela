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
							<div class="shy-menu-panel menu_link_colegio">
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
								<p class="title"><?php _e('Colegio', 'landmarkcollege'); ?></p>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
<!-- banner -->
<div class="banner-bottom">
		<div class="container">
			<h3 class="animated wow zoomIn" data-wow-delay=".5s">Landmark College<span>Historia</span></h3>
			<div class="banner-bottom-grids">
				<div class="banner-bottom-grid animated wow slideInRight content-historia" data-wow-delay=".5s">
						
					<div class="historia">
						<p><?php _e('Landmark College fue inaugurado el 22 de Agosto de 2010 en Soria.', 'landmarkcollege'); ?></p>
						<p><?php _e('Pero aunque es un instituto construido hace poco tiempo desde el momento en el que comenzó a construirse ya tenía una historia sobre él.', 'landmarkcollege'); ?></p>
						<p><?php _e('En 1984 se inauguró el Colegio "San Saturio" sobre el mismo suelo en el que posteriormente se construyó el actual instituto. Se trataba de un colegio católico, el cual estaba bajo la dirección del vicario de Soria. Cuando se construyó se hizo para escolarizar a los niños de la zona y los niños de los alrededores que tenían dificultad para desplazarse. Por ello era importante la localización en la que se construyera. Pero debido a la gran acogida que tuvo a lo largo de los años tuvo que ser ampliada en varias ocasiones.', 'landmarkcollege'); ?></p>
						<p><?php _e('Desgraciadamente el colegio tuvo que cerrar sus puertas el 20 de Marzo de 2003 debido a que un fuerte terremoto dañó parte de la estructura y se temía por la seguridad de los estudiantes. ', 'landmarkcollege'); ?></p>
						<p><?php _e('Se mantuvo cerrado hasta que en 2008 el empresario noruego Arne Landmark decidió invertir el suficiente dinero para su reconstrucción.', 'landmarkcollege'); ?></p>
						<p><?php _e('Gracias a la ayuda que se consiguió por parte del Gobierno y el Señor Landmark, se pudo construir un instituto con una gran capacidad y los recursos necesarios para que los alumnos puedan cursar la Secundaria y Bachillerato con los mejores recursos de toda la Comunidad Autónoma.', 'landmarkcollege'); ?></p>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
	</div>
<!-- //banner-bottom -->

<!-- services -->
	<div class="services instalacion">
		<div class="container">
			<div class="services-grids">
				
				<div class="contenedor-canvas">
					
					<div class="contador">
			            <div id="shiva">
			                <span class="count">23784</span>
			            </div>
			            <p class="leyenda"><?php _e('Estudiantes Matriculados', 'landmarkcollege'); ?></p>
			        </div>
			        
			        <div class="contador">
			            <div id="shiva">
			                <span class="count">37</span>
			            </div>
			            <p class="leyenda"><?php _e('Profesores que imparten', 'landmarkcollege'); ?></p>
			        </div>
			        
			        <div class="contador">
			            <div id="shiva">
			                <span class="count">18794</span>
			            </div>
			            <p class="leyenda"><?php _e('Número de visitas a la página', 'landmarkcollege'); ?></p>
			        </div>
			        
			        <div class="contador">
			            <div id="shiva">
			                <span class="count">48</span>
			            </div>
			            <p class="leyenda"><?php _e('Número de Asignaturas', 'landmarkcollege'); ?></p>
			        </div>
				</div>

				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //services -->

	<div id="cursos" class="banner-bottom">
		<div class="container">
			<h3 class="animated wow zoomIn" data-wow-delay=".5s">Landmark College <span><?php _e('Nuestros Cursos', 'landmarkcollege'); ?></span></h3>
			<div class="containerCursos">
				<div class="paralelogramo eso">
					<p><?php _e('SECUNDARIA', 'landmarkcollege'); ?></p>
				</div>
				<div class="paralelogramo bach">
					<p><?php _e('BACHILLERATO', 'landmarkcollege'); ?></p>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>