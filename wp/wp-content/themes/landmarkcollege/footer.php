<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="col-md-4 footer-grid animated wow slideInLeft" data-wow-delay=".5s">
				<h2><a href="https://proyect-school-krast.c9users.io/wp/" id="footlogo">Landmark<span>College</span></a></h2>
				<p class="footer_des"><?php _e('Landmark College se trata de uno de los institutos más importantes de la provincia de Soria. Con más de cincuenta aulas pone a disposición del alumnado una gran cantidad de recursos que ayudará con su educación.', 'landmarkcollege'); ?></p>
				<ul class="social">
					<li>Búscanos en:</li>
					<li><a class="social-linkedin" href="#">
						<i></i>
						<div class="tooltip"><span>Facebook</span></div>
						</a></li>
					<li><a class="social-twitter" href="#">
						<i></i>
						<div class="tooltip"><span>Twitter</span></div>
						</a></li>
					<li><a class="social-google" href="#">
						<i></i>
						<div class="tooltip"><span>Google+</span></div>
						</a></li>
					<li><a class="social-facebook" href="#">
						<i></i>
						<div class="tooltip"><span>Pinterest</span></div>
						</a></li>
					<li><a class="social-instagram" href="#">
						<i></i>
						<div class="tooltip"><span>Instagram</span></div>
						</a></li>
				</ul>
				<div class="newsletter">
					<form>
						<input type="email" value="Introduzca su email..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Introduzca su email...';}" required="">
						<input type="submit" value="Suscríbete">
					</form>
				</div>
			</div>
			<div class="col-md-4 footer-grid animated wow slideInLeft" data-wow-delay=".6s">
				<h3 class="instafoot">instagram posts</h3>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
					
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
					
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
					
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
					
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
				
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
					
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
					
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
				
				</div>
				<div class="footer-grid-left fotos" style="background-image: url('/wp/wp-content/themes/landmarkcollege/footimg/<?php $random = random_int(30,60); $subclase = $random; echo $subclase ?>.jpg')">
					
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-4 footer-grid animated wow slideInLeft" data-wow-delay=".7s">
				<h3 class="instafoot">Contacto</h3>
				<ul class="footer-address">
					<li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 23 Nicolás Rabal, Soria, España</li>
					<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:info@example.com">landmark_college@gmail.com</a></li>
					<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> +34 980 928 829</li>
				</ul>
				
				<!-- ******************** BOTÓN PARA ACCEDER A LA PARTE DEL PROFESORADO ************ -->
				<div class="more center-elements m1">
					<a href="https://proyect-school-krast.c9users.io/acceso/" class="hvr-sweep-to-top"><?php _e('Acceso para profesores', 'landmarkcollege'); ?></a>
				</div>
				<!-- ******************** FIN DEL BOTÓN PARA ACCEDER **************** -->
				
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="footer-copy">
		<div class="container">
			<p class="animated wow slideInLeft" data-wow-delay=".5s">Landmark College © 2017 . <?php _e('Todos los derechos reservados | Grupo', 'landmarkcollege'); ?> <a href="#">Landmark College</a></p>
		</div>
	</div>
<!-- //footer -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		/* global $ */
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>