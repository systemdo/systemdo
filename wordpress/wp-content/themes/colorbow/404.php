<?php get_header(); ?>
<section id="main">
<div class="article-wrapper no_padding">
    <div class="row">
        <div id="entry-title" class="twelve columns relative">
        
            <h2 class="content-title twelve columns  search"><?php _e( 'Error 404, page, post or resource can not be found' , 'cosmotheme' ); ?></h2>
            
        </div>    
    </div>

    <div class="row list_view">
        <?php layout::side( 'left' , 0 , '404' ); ?>
                   
            <div class="<?php echo tools::primary_class( 0 , '404', $return_just_class = true ); ?>" id="primary">
                
            </div> 
        <?php layout::side( 'right' , 0 , '404' ); ?>
    </div>
</div>    
</section>
<?php get_footer(); ?>