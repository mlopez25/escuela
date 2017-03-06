<!--<form role="search" method="get" class="searchform group" action="<?php echo home_url('/'); ?>">-->
<!--    <div class="formwrapper formwrapper-field">-->
<!--       <span class="input-group-addon"> <input type="search" class="search-field" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />-->
<!--        <button class="search-button">-->
<!--            <img class="submitbutton" id="subform" alt="Submit search query" src="<?php echo get_template_directory_uri(); ?>/images/search.svg">-->
<!--        </button></span>-->
<!--    </div>-->
<!--</form>-->
<!--<form role="search" method="get" class="searchform group" action="<?php echo home_url('/'); ?>">-->
<!--<div class="input-group">-->
<!--      <input type="search" class="form-control" placeholder="¿Necesitas buscar algo?" value="<?php echo get_search_query() ?>" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">-->
<!--      <span class="input-group-btn">-->
<!--        <button class="btn btn-default" type="button"><?php _e( 'Buscar' , 'landmarkcollege') ?></button>-->
<!--    </div>-->
<!--    </span>-->
<!--</form>-->

<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
    <div class="input-group">
        <input type="search" class="form-control"
            placeholder="<?php echo esc_attr_x( '¿Necesitas buscar algo?', 'placeholder' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    <span class="input-group-btn">-->
        <button class="btn btn-default">
            <?php _e( 'Buscar' , 'landmarkcollege') ?>
        </button>
    </span>
    </div>
</form>