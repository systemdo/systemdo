        <div class="article-wrapper">
            <div class="post_<?php echo $post -> ID; ?>">

            <?php
                //while( have_posts () ){
                    //the_post();
                    $post_id = $post -> ID;
                    if (is_single()) {
                        $template = 'single';
                    } elseif(is_page()) {
                        $template = 'page';
                    } elseif(is_front_page()) { $template = 'single';}                      
                   
                    $zoom = false; 
                    
                    if( options::logic( 'general' , 'enb_featured' ) ){
                        if ( has_post_thumbnail( $post_id ) && get_post_format( $post_id ) != 'video' ) {
                            $src_       = image::thumbnail( $post_id , $template , 'full' );
                            $caption    = image::caption( $post_id );
                            $zoom       = true;
                        }
                    } 
            ?>  
                      
            <div class="article-title">
                <h2>
                <?php
                    //like::content( $post->ID , 1 );
                    the_title();
                ?>
                </h2>
            </div>
            <?php if (meta::logic( $post , 'settings' , 'meta' ) && !is_page()){ ?>
            <div class="article-author">
                <h3> <?php _e('by ', 'cosmotheme'); ?><a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php  the_author(); ?></a></h3>
            </div>
            <?php if(strlen(trim($post->post_excerpt))){ ?>
            <div class="subtext st">
                <?php echo apply_filters('the_excerpt', $post->post_excerpt); ?>
            </div>
            <?php } ?>            
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
                    <?php }?>
                </ul>
            <?php 
            }?>
            <?php

                if( options::logic( 'general' , 'enb_featured' ) ){
                    if ( has_post_thumbnail( $post_id ) && (get_post_format( $post_id ) != 'video'  && get_post_format( $post_id ) != 'gallery' ) ) {
                        $src = image::thumbnail( $post_id , $template , 'image_single' );
                        $caption = image::caption( $post_id );
            ?> 
                        <div class="img">
                            <div class="img-wrapper">
   
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
                        </div>
            <?php
                    }
                }                                  
            ?>     

                    <?php if(get_post_format($post->ID)=="gallery" ) {
                        $image_format = meta::get_meta( $post_id , 'format' );
                        $caption = image::caption( $post_id );
                        if(isset($image_format['images']) && is_array($image_format['images'])){
                            echo "<div class=\"single-slider-container\">";
                            echo "<ul class=\"single-slider\">";
                            foreach($image_format['images'] as $index=>$img_id){
                                $thumbnail= wp_get_attachment_image_src( $img_id, 'gallery_single');
                                $full_image=wp_get_attachment_url($img_id);
                                $url=$thumbnail[0];
                                $width=$thumbnail[1];
                                $height=$thumbnail[2];

                                echo "<li class=\"single-slider-elem\">";
                                ?>
                                <a href="<?php echo $full_image; ?>" title="<?php echo $caption;  ?>" rel="prettyPhoto[gallery_<?php echo $post_id?>]"><?php echo "<img alt=\"\" src=\"$url\">"; ?></a>
                            <?php
                                echo "</li>";

                            }
                            echo "</ul>";
                            echo "</div>";                                
                        }      
                    }elseif( get_post_format( $post_id ) == 'video' ){

                        $video_format = meta::get_meta( $post_id , 'format' );
                    ?>
                        <div class="videos">
                            <div class="embedded_videos">    
                            <?php
                                $format=$video_format;
                                if( isset( $format['video'] ) && !empty( $format['video'] ) && post::isValidURL( $format['video'] ) ){
                                    $vimeo_id = post::get_vimeo_video_id( $format['video'] );
                                    $youtube_id = post::get_youtube_video_id( $format['video'] );
                                    $video_type = '';
                                    if( $vimeo_id != '0' ){
                                        $video_type = 'vimeo';
                                        $video_id = $vimeo_id;
                                    }

                                    if( $youtube_id != '0' ){
                                        $video_type = 'youtube';
                                        $video_id = $youtube_id;
                                    }

                                    if( !empty( $video_type ) ){
                                        echo post::get_embeded_video( $video_id , $video_type );
                                    }

                                }else if( isset( $video_format["feat_url"] ) && strlen($video_format["feat_url"])>1){

                                    $video_url=$video_format["feat_url"];
                                    if(post::get_youtube_video_id($video_url)!="0")
                                    {
                                        echo post::get_embeded_video(post::get_youtube_video_id($video_url),"youtube");
                                    }
                                    else if(post::get_vimeo_video_id($video_url)!="0")
                                    {
                                        echo post::get_embeded_video(post::get_vimeo_video_id($video_url),"vimeo");
                                    }
                                }else if(isset( $video_format["feat_id"] ) && strlen($video_format["feat_id"])>1){
                                    echo do_shortcode('[video mp4="'.wp_get_attachment_url($video_format["feat_id"]).'" width="610" height="443"]');
                                    //echo post::get_local_video( urlencode(wp_get_attachment_url($video_format["feat_id"])));
                                }
                            ?>
                                                                    
                            <?php    
                                if(isset($video_format['video_ids']) && !empty($video_format['video_ids'])){
                                    foreach($video_format["video_ids"] as $videoid){
                                        if( isset( $video_format[ 'video_urls' ][ $videoid ] ) ){
                                            $video_url = $video_format[ 'video_urls' ][ $videoid ];
                                            if( post::get_youtube_video_id($video_url) != "0" ){
                                                echo post::get_embeded_video( post::get_youtube_video_id( $video_url ), "youtube" );
                                            }else if( post::get_vimeo_video_id( $video_url ) != "0" ){
                                                echo post::get_embeded_video( post::get_vimeo_video_id( $video_url ) , "vimeo" );
                                            }
                                        }
                                        else echo post::get_local_video( urlencode(wp_get_attachment_url($videoid)));
                                    }
                                }    
                            ?>
                            </div>
                     </div>
                    <?php                                     
                    } 

                    ?>

            <div class="single-content row">

                <?php if(is_single() || is_page()) { layout::side( 'left' , $post_id , 'single'); } ?>
                <?php
                    $layout = meta::get_meta( $post ->ID , 'layout' );
                    if ( isset($layout['type']) && $layout['type'] == 'full' ) {
                        if (meta::logic( $post , 'settings' , 'meta' ) && (is_single() || is_front_page())) {
                            $content_class = ' nine '; 
                        } else { $content_class = ' twelve '; }                      
                    }  elseif(isset($layout['type']) && $layout['type'] != 'full' && is_single() && meta::logic( $post , 'settings' , 'meta' )) { $content_class = ' six '; }  
                    elseif(isset($layout['type']) && $layout['type'] != 'full' && (is_single() ||is_page()) && !meta::logic( $post , 'settings' , 'meta' )) { $content_class = ' nine '; }  
                    else{ 
                        if (meta::logic( $post , 'settings' , 'meta' )) {
                            $content_class = ' nine ';
                        } else { $content_class = ' twelve ';}
                    }  
                    if(!isset($layout['type'])){ $content_class = ' nine ';}
                    if((is_single() && meta::logic( $post , 'settings' , 'meta' ) ) || ( is_front_page() && meta::logic( $post , 'settings' , 'meta' ))){
                ?> 
                <div class="single-content-details three columns">
                    <div class="single-meta">
                        <div class="single-meta-icons-container">
                            <ul class="single-meta-icons">
                                <li class="single-meta-icons-elem photo-btn"><?php echo post::get_post_format_link($post ->ID); ?></li>
                                <li class="single-meta-icons-elem single-date"><?php the_time('j'); ?> <span><?php the_time('M'); ?></span></li>
                            </ul>
                        </div>
                        <div class="single-meta-details-container">
                            <ul class="single-meta-details">
                            <?php 
                                if((is_single() && meta::logic( $post , 'settings' , 'meta' )) || (meta::logic( $post , 'settings' , 'meta' ) && get_post_type() == 'portfolio')){
                                    echo post::get_source($post_id);
                                    echo post::get_services($post_id);
                                    echo post::get_client($post_id);
                                }
                            ?>  
                            
                            <?php
                                if( meta::logic( $post , 'settings' , 'meta' ) ){
                                    post::meta( $post );
                                }
                            ?>
                            <?php if (meta::logic( $post , 'settings' , 'love' ) && options::logic( 'general' , 'enb_likes' )) { ?>
                            <li class="single-meta-details-elem">
                                <span class="single-meta-details-title"><?php _e('Likes:','cosmotheme');?></span>
                                <span class="metas-big">
                                <?php
                                    like::content($post->ID, 3, false);
                                ?>
                                </span>
                            </li>
                            <?php } ?>
                            </ul>                               
                        </div>
                    </div>
                </div> 
                <?php }?>                              

                <div class="<?php echo $content_class;   ?> columns columns_width">
                    <div class="row">
                        <div class="twelve columns">
                            <div class="single-content-description">
                                <?php 
                                    if( is_single() && get_post_format( $post_id ) == 'audio' ){
                                        $audio = new AudioPlayer(); 
                                        echo $audio->processContent( post::get_audio_file( $post_id ) );
                                    }
                                    if( get_post_format( $post_id ) == 'image' ){
                                        $image_format = meta::get_meta( $post_id , 'format' );
                                        if(isset($image_format['images']) && is_array($image_format['images'])){
                                            echo "<div class=\"attached_imgs_gallery\">";
                                            foreach($image_format['images'] as $index=>$img_id){
                                                $caption = image::caption( $img_id );
                                                $thumbnail= wp_get_attachment_image_src( $img_id, 'thumbnail');
                                                $full_image=wp_get_attachment_url($img_id);
                                                $url=$thumbnail[0];
                                                $width=$thumbnail[1];
                                                $height=$thumbnail[2];

                                                echo "<div class=\"attached_imgs_gallery-elementm\">";
                                                ?>
                                                <a href="<?php echo $full_image; ?>" title="<?php echo $caption;  ?>" rel="prettyPhoto[gallery_<?php echo $post_id?>]"><?php echo "<img alt=\"\" src=\"$url\" width=\"$width\" height=\"$height\">"; ?></a>
                                            <?php
                                                echo "</div>";

                                            }     
                                            echo '<div class="clear"></div>';  
                                            echo "</div>";                            
                                        }  
                                    }
                                    echo apply_filters('the_content', $post->post_content);
                                ?>
                                <div class="pagenumbers">
                                <?php wp_link_pages(array('before' => '<p>Pages:','after' => '</p>', 'next_or_number' => 'number'));  ?>
                                </div>
                                <?php
                                    if( is_single() && get_post_format( $post_id ) == 'link' ){
                                        echo post::get_attached_file( $post_id );
                                    }
                                ?>  

                                

                                <div class="clear"></div>
                            </div>
                        </div>
                        <?php get_template_part('social-sharing'); ?>

                            <?php 
                                if(is_single() && options::logic( 'blog_post' , 'show_similar' )){
                                    echo '<div class="twelve columns">';
                                    /* related posts */
                                    get_template_part( 'related-posts' ); 
                                    echo '</div>';
                                }
                            ?>                    
                            <?php
                                /* comments */
                                //wp_reset_query();
                                if(is_single() || is_page()){
                                    if( comments_open($post_id) ){
                            ?>
                                         
                                <div class="twelve columns">
                                    <?php        
                                            if( options::logic( 'general' , 'fb_comments' ) ){
                                                ?>
                                                <div id="comments">
                                                    <h3 id="reply-title"><?php _e( 'Leave a reply' , 'cosmotheme' ); ?></h3>
                                                    <p class="delimiter">&nbsp;</p>
                                                    <fb:comments href="<?php the_permalink(); ?>" num_posts="5" width="430" height="120" reverse="true"></fb:comments>
                                                </div>
                                                <?php
                                            }else{
                                                comments_template( '', true );
                                            }
                                    ?> 
                                </div>                                      
                                    <?php    
                                    }
                                    ?>
                                    <?php
                                }
                                ?>
                        
                    </div>    
                </div>
                <?php if(is_single() || is_page()){ layout::side( 'right' , $post_id , 'single' ); } ?>
            </div>

                    
        <?php
            //}
        ?>
        </div>
        </div>