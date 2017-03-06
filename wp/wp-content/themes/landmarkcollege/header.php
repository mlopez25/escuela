<!DOCTYPE html>
<html>
<head>
<title>Landmark College</title>
<link rel="icon" type="image/png" href="<?php bloginfo( 'template_url' ); ?>/images/favi.png" size="32x32" />


<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Fleece Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- //for-mobile-apps -->
<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" media="all"/>

<!-- js -->
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jquery.js"></script>
<!-- //js -->

<!-- animation-effect -->
<script src="<?php bloginfo( 'template_url' ); ?>/js/wow.min.js"></script>
<script>
 new WOW().init();
</script>

<!-- //animation-effect -->
<!--FlexSlider-->
		<script defer src="<?php bloginfo( 'template_url' ); ?>/js/jquery.flexslider.js"></script>
		<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>


<!--End-slider-script-->
<link href='//fonts.googleapis.com/css?family=Nixie+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

<!-- start-smoth-scrolling -->
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/move-top.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

<?php
    wp_head();
?>

</head>