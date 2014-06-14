
        <div class="article-wrapper">
            <div class="post_<?php echo $post -> ID; ?>">
            <?php
            
                    $post_id = $post -> ID;
                    $template = 'page';                     
                   
                    $zoom = false; 
                    
                    if( options::logic( 'general' , 'enb_featured' ) ){
                        if ( has_post_thumbnail( $post_id ) ) {
                            $src_       = image::thumbnail( $post_id , $template , 'full' );
                            $caption    = image::caption( $post_id );
                            $zoom       = true;
                        }
                    } 
            ?>  
                      
            <div class="article-title">
                <h2>
                <?php
                    the_title();
                ?>
                </h2>
            </div>
            <?php if (meta::logic( $post , 'settings' , 'meta' ) && !is_page()){ ?>
            <div class="article-author">
                <h3> <?php _e('by ', 'cosmotheme'); ?><a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php  the_author(); ?></a></h3>
            </div>
            <?php } if(is_page()) { ?>
                <ul class="page_meta <?php if( !meta::logic( $post , 'settings' , 'meta' ) && !meta::logic( $post , 'settings' , 'love' ) ) echo 'hidden'; ?>">
                    <?php
                        if( meta::logic( $post , 'settings' , 'meta' ) ){
                            post::meta( $post );
                        }
                    ?>
                    <?php if (meta::logic( $post , 'settings' , 'love' ) && options::logic( 'general' , 'enb_likes' )) { ?>
                    <li class="single-meta-details-elem">
                        <span class="metas-big">
                        <?php
                            like::content($post->ID, 3, false);
                        ?>
                        </span>
                    </li>
                    <?php } ?>
                </ul>
            <?php  
            }?>
            <?php
                if( options::logic( 'general' , 'enb_featured' ) ){
                    if ( has_post_thumbnail( $post_id ) && (get_post_format( $post_id ) != 'video'  && get_post_format( $post_id ) != 'gallery' && get_post_format( $post_id ) != 'image') ) {
                        $src = image::thumbnail( $post_id , $template , 'image_single' );
                        $caption = image::caption( $post_id );
            ?> 
                        <div class="img">
   
                            <?php
                                echo '<img src="' . $src[0] . '" alt="' . $caption . '" >';
                                if( options::logic( 'general' , 'enb_lightbox' ) && $zoom  ){
                            ?>
                                    <span class="nav-zoom"><a href="<?php echo $src_[0]; ?>" title="<?php echo $caption;  ?>" rel="prettyPhoto-<?php echo $post_id; ?>"><?php _e( 'Full size' , 'cosmotheme' ); ?></a></span>
                            <?php
                                }
                            if (options::logic('styling', 'stripes')) { ?>
                                <div class="stripes">&nbsp;</div><!--Must put height equal to image-->
                            <?php } ?>
                        </div>
            <?php
                    }
                }                                  
            ?>            


            <div class="single-content row">
                <?php
                    $content_class = ' twelve ';        
                ?>                
                <div class="<?php echo $content_class;   ?> columns">
                    <div class="single-content-description">
                        <?php 
                            echo apply_filters('the_content', $post->post_content);
                        ?>

                        <?php include('social-sharing.php'); ?>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
