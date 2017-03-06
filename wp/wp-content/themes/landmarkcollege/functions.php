<?php
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats',array('image','gallery','audio','video','link','quote'));
    
    
    function agregarJQuery(){
    //Aqui quitamos primero el jquery que viene, y evitamos que los plugins agreguen otros, y le ponemos el de google
    wp_deregister_script('jquery');
    wp_register_script('jquery',"http".($_SERVER['SERVER_PORT']==443?"s":"")."://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js",false,null);
    wp_enqueue_script('jquery');
    }
    if(!is_admin()){
        add_action('wp_enqueue_scripts','agregarJQuery',11);
    }
    
    function add_responsive_class($content){
    if($content) {
        $post_format = get_post_format();
        switch ($post_format){
            case 'quote':
                //Añadimos la clase my_quote al primer párrafo del post tipo quote
                $newcontent = preg_replace('/<p([^>]+)?>/', '<p$1 class="my_quote">', $content, 1);
                //Añadimos la clase my_quote_author al segundo párrafo del post tipo quoted_printable_decode
                return preg_replace('/<p([^>]+)?>/','<p$1 class="my_quote_author">', $newcontent, 2);
                break;
            
            default:
                //Convertimos el contenido a una codificación HTML en UTF8
                $content = mb_convert_encoding($content,'HTML-ENTITIES',"UTF-8");
                $document = new DOMDocument();
                libxml_use_internal_errors(true);
                $document->loadHTML(utf8_decode($content));
                $imgs=$document->getElementsByTagName('img');
               // $video = $document->getElementsByClassName('wp-video');
                //Para IMG
                foreach($imgs as $img){
                    $img->setAttribute('class','img-responsive');
                }
                //Para Video
               // $video->setAttribute('style','width: 100% !important;');
                $html=$document->saveHTML();
                return $html;
            }
        }
    }
    add_filter('the_content','add_responsive_class');
    
    function excerpt_short($length) {
    if(!is_home()) {
        return 20;
    } else {
        return 30;
    }
    }

    add_filter('excerpt_length', 'excerpt_short', 999);
    
    function has_gravatar($email){
    //Ciframos la cuenta de email
    $hash = md5(strtolower(trim($email)));
    //Generamos la supuesta uri del avatar si existe
    $uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
    //Guardamos todas la cabeceras enviadas por el servidor, de las cuales sacaremos después su primer parámetro que es la url
    $headers = @get_headers($uri);
    //Si tiene gravatar aparecerá un 200 en la uri
    if(!preg_match('|200|', $headers[0])){
        $has_valid_avatar = FALSE;
    }else{
        $has_valid_avatar = TRUE;
        }
    }
    
    
    //FUNCION PARA LAS VIEWS DE NOTICIAS
    function bac_PostViews($post_ID) {
 
    $count_key = 'post_views_count'; 
     
    $count = get_post_meta($post_ID, $count_key, true);
     
    if($count == ''){
        $count = 0;
         
        delete_post_meta($post_ID, $count_key);
         
        add_post_meta($post_ID, $count_key, '0');
        return $count . ' Visitas';
     
    }else{
        $count++;
        update_post_meta($post_ID, $count_key, $count);
         
        if($count == '1'){
        return $count . ' Visita';
        }
        else {
        return $count . ' Visitas';
        }
    }
}

//METER EL CONTADOR EN EL BACKEND
function get_PostViews($post_ID){
    $count_key = 'post_views_count';
    $count = get_post_meta($post_ID, $count_key, true);
 
    return $count;
}
 
function post_column_views($newcolumn){
    $newcolumn['post_views'] = __('Views');
    return $newcolumn;
}
 
function post_custom_column_views($column_name, $id){
     
    if($column_name === 'post_views'){
        echo get_PostViews(get_the_ID());
    }
}

add_filter('manage_posts_columns', 'post_column_views');
 
add_action('manage_posts_custom_column', 'post_custom_column_views',10,2);

function inicializar_widgets() {
    register_sidebar(array(
    'name' => __('Sidebar Widgets'),
    'id' => 'sidebar',
    'description' => __('Sidebar Widget Area'),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    ));
}
add_action('widgets_init', 'inicializar_widgets');

function filter_get_pages($pages,$r){
    
    foreach($pages as $page){
        if(!is_admin()){
            $colegio = get_page_link(get_page_by_title('Colegio')->ID);;
            $link = get_page_link($page->ID);
            if($page->post_title=='Cursos'){
                echo '<li><a href="'.$colegio.'"#cursos">'.$page->post_title.'</a></li>';
            }else if($page->post_title=='Actividades'){
                echo '<li><a href="https://proyect-school-krast.c9users.io/actividades/index.php">Actividades</a></li>';
            }else{
                if($page->post_title != 'Archives'){
                echo '<li><a href="'.$link.'">'.$page->post_title.'</a></li>';
            }
            }
        }
        }
        return $pages;
    
};

add_filter('get_pages', 'filter_get_pages', 10, 2);

function get_paginate_page_links($type = 'plain', $endsize = 1, $midsize = 1){
    global $wp_query, $wp_rewrite;
    $current = get_query_var('paged') > 1 ? get_query_var('paged') : 1;
    if(!in_array($type, array('plain','list','array'))) $type='plain';
    $endsize = absint($endsize);
    $midsize = absint($midsize);
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format'=> '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'show_all' => false,
    'end_size' => $endsize,
    'mid_size' => $midsize,
    'type' => $type,
    'prev_text' => '<img class="flecha" src="/wp/wp-content/themes/landmarkcollege/images/chevronI.svg"></img>',
    'next_text' => '<img class="flecha" src="/wp/wp-content/themes/landmarkcollege/images/chevron.svg"></img>',        
    );
    if($wp_rewrite->using_permalinks()){
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s', get_pagenum_link(1))).'page/%#%','paged');
    }
    if(!empty($wp_query->query_vars['s'])){
        $pagination['add_args'] = array('s' => get_query_var('s'));
    }
    return paginate_links($pagination);
}


    function new_excerpt_more ($more) {
    global $post;
    return '...';
}
add_filter('excerpt_more','new_excerpt_more');

function tiene_foto($nickname){
    if(file_exists("/home/ubuntu/workspace/wp/wp-content/themes/landmarkcollege/images/".$nickname.".jpg")){
        return "/wp/wp-content/themes/landmarkcollege/images/".$nickname.".jpg";
    }else{
        return false;
    }
}


load_theme_textdomain('landmarkcollege', get_template_directory() . '/languages');

add_action('after_setup_theme', 'my_theme_setup');

function my_theme_setup(){
    load_theme_textdomain('landmarkcollege', get_template_directory() . '/languages');
}

//CUSTOM FIELDS
function add_custom_fields($user) {
    ?><h2>Extra profile information<h2>
    <table class="form-table">
        <tr>
            <th><label for="Gmail">Gmail: </label></th>
            <td><input type="text" name="gmail" id="gmail" class="regular-text" value="<?php echo esc_attr(the_author_meta('gmail', $user->ID)); ?>"/><br>
            <span class="informacion">Enter your gmail account.</span></td>
        </tr>
        <tr>
           <th><label for="linkedin">Linkedin: </label></th>
            <td><input type="text" name="linkedin" id="linkedin" class="regular-text" value="<?php echo esc_attr(the_author_meta('linkedin', $user->ID)); ?>"/><br>
            <span class="informacion">Enter your Linkedin username.</span></td> 
        </tr>
        <tr>
           <th><label for="blogger">Blogger: </label></th>
            <td><input type="text" name="blogger" id="blogger" class="regular-text" value="<?php echo esc_attr(the_author_meta('blogger', $user->ID)); ?>"/><br>
            <span class="informacion">Enter your Blogger username.</span></td> 
        </tr>
    </table>
    
<?php
}
add_action('show_user_profile','add_custom_fields');
add_action('edit_user_profile','add_custom_fields');

function save_custom_fields($user_id) {
    if ( !current_user_can('edit_user', $user_id) )
        return false;
    update_usermeta( $user_id, 'gmail', $_POST['gmail']);
    update_usermeta( $user_id, 'linkedin', $_POST['linkedin']);
    update_usermeta( $user_id, 'blogger', $_POST['blogger']);
}

add_action( 'personal_options_update', 'save_custom_fields');
add_action( 'edit_user_profile_update', 'save_custom_fields');



?>
