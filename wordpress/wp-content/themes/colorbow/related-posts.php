<?php
    /* related posts by herarchical taxonomy */
    /* get tax slugs and number of similar posts  */ 
    global $first_term;
    $first_term = '';
    function similar_query( $post_id , $taxonomy , $nr ){
        global $first_term;
        if( $nr > 0 ){
            $topics = wp_get_post_terms( $post_id , $taxonomy );

            $terms = array();
            if( !empty( $topics ) ){
                foreach ( $topics as $topic ) {
                    $term = get_category( $topic );
                    array_push( $terms, $term -> slug );
                    if(!strlen($first_term)){
                        $first_term = $term -> term_id;
                    }
                }
            }

            if( !empty( $terms ) ){
                $query = new WP_Query( array(
                    'post__not_in' => array( $post_id ) ,
                    'posts_per_page' => $nr,
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                        'taxonomy' => $taxonomy ,
                        'field' => 'slug',
                        'terms' => $terms ,
                        )
                    )
                ));
            }else{
                $query = array();
            }
        }else{
            $query = array();
        }

        return $query;
    }

    /* post taxonomy */
    $tax = options::get_value( 'blog_post' , 'similar_type' );
    
    if(get_post_type($post->ID) == 'portfolio'){
        if($tax == 'category'){
            $tax = 'portfolio-category';
        }elseif($tax == 'post_tag'){
            $tax = 'portfolio-tag';
        }    
    }

    $layout = meta::get_meta( $post -> ID , 'layout' );
    
    if( isset( $layout['type'] ) ){
        if( $layout['type'] != 'full' ){
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_side' );
        }else{
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_full' );
        }
    }else{
        $layout = options::get_value( 'layout' , 'single' );
        if( $layout != 'full' ){
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_side' );
        }else{
            $nr = (int)options::get_value( 'blog_post' , 'post_similar_full' );
        }
    }
    
    $label  = __( 'Related Posts' , 'cosmotheme' );
    $query  = similar_query( $post -> ID , $tax , $nr );
    $length = layout::length( $post -> ID , 'single' );

    if( !empty( $query ) ){
        if( $query -> found_posts < $nr ){
            $nr = $query -> found_posts;
        }

        $result = $query -> posts;
    }
        


    

    if( !empty( $result) && meta::logic( $post , 'settings' , 'related' ) ){
?>
    
            <h3 class="related-title"><?php _e( 'Related posts' , 'cosmotheme' ); ?></h2>
            
            <?php 
                if( $length == layout::$size['large'] ){
                    $div = 4;
                }else{
                    $div = 3;
                }

                $i = 1;
                
                
                
                foreach( $result as $similar ){
                    if( $i % $div == 1 ){
                        
                        echo '<div  class="horizontal-posts row thumb_view no-overflow">';
                    }

                    
                    $options = array('use_filter' => false, 'enable_masonry' => "", 'number_columns' => $div, 'resize_method' => 'crop','object_type' => $tax, 'object-id' => $first_term); 
                    
                    post::thumb_view( $similar , $options );
                    
                    if( $i % $div == 0 ){
                        echo '</div>';
                        $i = 0;
                    }
                    $i++;
                    
                }

            /* if div container is open */
            if( $i > 1 ){
                echo '</div>';
            }

            ?>
        
    
    
<?php

        wp_reset_postdata();
    }
?>
    