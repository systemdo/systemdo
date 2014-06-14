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
                    ?>
                    <h2 class="content-title twelve columns  archive">
                        <?php
                            if ( is_day() ) {
                                echo  __( 'Daily archives' , 'cosmotheme' ) . ': <span>' . get_the_date();
                            }else if ( is_month() ) {
                                echo  __( 'Monthly archives' , 'cosmotheme' ) . ': <span>' . get_the_date( 'F Y' );
                            }else if ( is_year() ) {
                                echo  __( 'Yearly archives' , 'cosmotheme' ) . ': <span>' . get_the_date( 'Y' ) ;
                            }else if (is_tax( 'post_format' )){
                                echo  __( 'Post format archives' , 'cosmotheme' ) . ': <span>' . get_post_format().'</span>' ; 
                            }else if(is_post_type_archive()){    
                                echo  sprintf(__( '%s archives' , 'cosmotheme' ), post_type_archive_title())  ;
                            }else {
                                echo  __( 'Blog archives' , 'cosmotheme' ) ;
                            }
                        ?>

                    </h2><?php

                }else{
                    ?><h2 class="content-title twelve columns  search"><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h2><?php

                }
            ?>
            
        
        </div>    
    </div>
    <div class="row list_view">
<?php  //var_dump($wp_query); ?>
        <?php layout::side( 'left' , 0 , 'archive' ); ?>
        <div class="<?php echo tools::primary_class( 0 , 'archive', $return_just_class = true ); ?>" id="primary">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="container full_content row">
                    <div class="container-wrapper">
                    <?php 

                        $options = array('resize_method' => 'crop','object_type' => get_post_type($post -> ID), 'object-id' => get_post_type($post -> ID) );
                        post::list_view($post, $options);
                    ?>
                    </div>
                </div>  
            <?php endwhile; 
                get_template_part('pagination');
            ?>

        </div>

        <?php layout::side( 'right' , 0 , 'archive' ); ?>
    </div>
</div>    
</section>
<?php get_footer(); ?>
