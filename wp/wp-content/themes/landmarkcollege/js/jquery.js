/* global $ */
$(document).ready(function() {

    // $('.archives > li').addClass('fa fa-calendar calendar-space');
    // $('.categorias > li').addClass('fa fa-bookmark bookmark-space');
    // $('.author > li').addClass('fa fa-users author-space');
    
    var navegador = Array('menu_link_inicio', 'menu_link_noticias', 'menu_link_colegio', 'menu_link_cursos', 'menu_link_contacto');
    
    for(var i=0; i< navegador.length; i++ ){
        var item= navegador[i];
        if( $('.menu__item').closest('.shy-menu-panel').hasClass(item)){
            $('.'+item).parent().addClass('menu__item--current');
            break;
        }
    }
    
    $('.inicial').find('li').first().toggleClass('showGallery');
   
    $('.galSiguiente').on('click',function(){
       $na = $(this).closest('.inicial').find('.showGallery');
       $na.toggleClass('showGallery');
        $na.next('li').toggleClass('showGallery');
        if($(this).closest('.inicial').find('.showGallery').size()===0){
            $(this).closest('.inicial').find('li').first().toggleClass('showGallery'); 
        }
    });
    
    $('.galAnterior').on('click',function(){
       $na = $(this).closest('.inicial').find('.showGallery');
       $na.toggleClass('showGallery');
       $na.prev('li').toggleClass('showGallery');
       if($(this).closest('.inicial').find('.showGallery').size()===0){
            $(this).closest('.inicial').find('li').last().toggleClass('showGallery'); 
        }
    });
    
    /* ******** CANVAS ******* */
    
    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
  
});