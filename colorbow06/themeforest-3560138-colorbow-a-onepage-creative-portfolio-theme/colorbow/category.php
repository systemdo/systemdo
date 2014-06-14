<?php get_header(); ?>
<?php
    get_ads('logo');
?>
<section id="main">
<div class="article-wrapper no_padding">
    <div class="row">
        <div id="entry-title" class="twelve columns relative">
        
            <?php
                if( have_posts () ){
                    ?><h2 class="content-title twelve columns  category"><?php _e( 'Category archives: ' , 'cosmotheme' ); echo get_cat_name( get_query_var('cat') ); ?></h2><?php

                }else{
                    ?><h2 class="content-title twelve columns  category"><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h2>
            <?php

                }
            ?>
            
        
        </div>    
    </div>
    <div class="row list_view">

        <?php layout::side( 'left' , 0 , 'category' ); ?>

            <div class="<?php echo tools::primary_class( 0 , 'category', $return_just_class = true ); ?>" id="primary">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="container full_content row">
                        <?php 

                            $options = array('resize_method' => 'crop','object_type' => get_post_type($post -> ID), 'object-id' => get_post_type($post -> ID) );
                            post::list_view($post, $options);
                        ?>
                    </div>  
                <?php 
					endwhile; 
					get_template_part('pagination');
				?>
            </div>
        
        <?php layout::side( 'right' , 0 , 'category' ); ?>
    </div>
</div>
</section>
<?php get_footer(); ?>
