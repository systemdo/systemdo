<?php

class post {
    static $post_id = 0;
    
    function filter_where( $where = '' ) {
        global $wpdb;
        if( self::$post_id > 0 ){
            $where .= " AND  ".$wpdb->prefix."posts.ID < " . self::$post_id;
        }
        return $where;
    }
        
        
    function search(){
        
        $query = isset( $_GET['params'] ) ? (array)json_decode( stripslashes( $_GET['params'] )) : exit;
        $query['s'] = isset( $_GET['query'] ) ? $_GET['query'] : exit;
        
        global $wp_query;
        $result = array();
        $result['query'] = $query['s'];
        
        $wp_query = new WP_Query( $query );
        
        if( $wp_query -> have_posts() ){
            foreach( $wp_query -> posts as $post ){
                $result['suggestions'][] = $post -> post_title;
                $result['data'][] =  $post -> ID;
            }
        }
        
        echo json_encode( $result );
        exit();
    }
    
    function get_post_taxonomies($post_id, $only_first_cat = false, $taxonomy = 'category', $margin_elem_start = '', $margin_elem_end = '', $delimiter = ', ',  $a_class = ''){
                
        $cat = '';
        $categories = wp_get_post_terms($post_id, $taxonomy );
        if (!empty($categories)) {
            
            $ind = 1;
            foreach ($categories as $category) {
                $categ = get_term($category, $taxonomy );
               
                if($ind != count($categories) && !$only_first_cat){
                    $cat_delimiter = $delimiter;   
                }else{
                    $cat_delimiter = '';   
                }

                $cat .= $margin_elem_start . '<a href="' . get_category_link($category) . '" class="'.$a_class.'">' . $categ->name . $cat_delimiter . '</a> ' . $margin_elem_end;
                
                if($only_first_cat){
                    break;    
                }
                

                $ind ++;
            }
            
            
            //$cat = __('in','cosmotheme').' '.   $cat;   
        }
                        
          return $cat .' ' ;
    }

    function get_play_video_action($post_id){

        $onclick = '';        
        $format = meta::get_meta( $post_id, 'format' );

        if( isset( $format['feat_id'] ) && !empty( $format['feat_id'] ) ){
            $video_id = $format['feat_id'];
            $video_type = 'self_hosted';
            if(isset($format['feat_url']) && post::isValidURL($format['feat_url']))
              {
                $vimeo_id = post::get_vimeo_video_id( $format['feat_url'] );
                $youtube_id = post::get_youtube_video_id( $format['feat_url'] );
                
                if( $vimeo_id != '0' ){
                  $video_type = 'vimeo';
                  $video_id = $vimeo_id;
                }

                if( $youtube_id != '0' ){
                  $video_type = 'youtube';
                  $video_id = $youtube_id;
                }
              }

            if(isset($video_type) && isset($video_id) ){
                if($video_type == 'self_hosted'){
                    $onclick = 'playVideo("'.urlencode(wp_get_attachment_url($video_id)).'","'.$video_type.'",jQuery(this),jQuery(this).parent().width(),jQuery(this).parent().width()/1.37)';
                }else{
                    $onclick = 'playVideo("'.$video_id.'","'.$video_type.'",jQuery(this),jQuery(this).parent().width(),jQuery(this).parent().width()/1.37)';
                }    
            }
        }

        return $onclick;
            
    }

    function get_click_action( $post_id, $object_type, $object_id, $post_type){
        global $ajax_link;
        if ( isset($ajax_link) && $ajax_link === true ) { 
            $onclick = "onclick = \"get_ajax_post( ".$post_id." ,'".$object_type."','".$object_id."','".$post_type."'); return false;\"";
        }else {
            $onclick = "";
        } 
        return $onclick;    
    }

    function list_view($post, $options) {
            $object_id = $options['object-id'];
            //var_dump($options['enable_load_more']);
            extract( $options );

            $full_width = true;
            if(post::is_feat_enabled($post->ID) && has_post_thumbnail($post->ID)){
                $header_class = 'seven columns';
                $content_class = 'five columns';
            }else{
                $header_class = 'twelve columns';
                $content_class = 'twelve columns';
            }
            
            if($resize_method == 'resize'){
                $size = 'tmedium';    
            }else{
                $size = 'tmedium_cropped';        
            }
            
        ?>
        <?php if(isset($options['enable_ajax_post']) && $options['enable_ajax_post'] == 'enable_ajax_post') { 
                $enable_ajax_post = self::get_click_action($post->ID, $object_type, $object_id, $post->post_type ); 
            } else { $enable_ajax_post = '';} 
        ?>
        <div class="twelve columns">
            <article class="<?php echo get_post_format( $post -> ID );  ?>">
                <div class="row">
                    <?php if(post::is_feat_enabled($post->ID) && has_post_thumbnail($post->ID) ){ ?>
                    <div class="<?php echo $header_class; ?>"  >
                        <div class="featimg" >
                            <div class="hover-more">
                                <div class="hover-more-img">
                                    <?php  $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , $size ); ?>
                                    <img src="<?php echo $src[0]; ?>" alt="" />
                                    <?php
                                        if (options::logic('styling', 'stripes')) {
                                        ?><div class="stripes" >&nbsp;</div><?php
                                        }
                                    ?>
                                </div>
                                <div class="item-overlay">
                                    <div class="featimg-hover">
                                        <a  href="<?php echo get_permalink($post -> ID); ?>" <?php echo $enable_ajax_post; ?>  title="" class="featimg-hover-more" >
                                            <?php _e('More','cosmotheme'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <?php } /*EOF enabled feat img*/  ?>

                    
                    <div class="<?php echo $content_class; ?>">
                        <div class="entry-title">
                            <h4><a href="<?php echo get_permalink($post -> ID); ?>" <?php echo $enable_ajax_post; ?> ><?php echo $post -> post_title; ?></a></h4>           
                        </div>
                        <div class="excerpt">
                            <?php 
                                $ln = 600;
                                post::get_excerpt($post, $ln = $ln);  
                            ?>
                        </div>
                        
                        <?php if(options::logic( 'general' , 'meta' )){ ?>
                        <div class="separator" ></div>
                        <div class="meta">
                            <ul>
                                <?php 
                                    if(get_post_type($post->ID) == 'post'){
                                        $category_tax = 'category';    
                                    } elseif(get_post_type($post->ID) == 'portfolio') {
                                        $category_tax = 'portfolio-category';   
                                    } elseif(get_post_type($post->ID) == 'testimonial') {
                                        $category_tax = 'testimonial-category';  
                                    }elseif(get_post_type($post->ID) == 'page') {
                                        $category_tax = '';  
                                    }

                                    $categories = post::get_post_taxonomies($post->ID, $only_first_cat = false, $taxonomy = $category_tax, $margin_elem_start = '', $margin_elem_end = '', $delimiter = ',&nbsp;',  $a_class = '');
                                    if(strlen(trim($categories))){
                                    ?>
                                        <li class="meta-elem"><i class="icon-folder-open"></i><?php echo  $categories ;?></li>

                                    <?php
                                    }
                                    ?>
                                
                                <?php
                                if (comments_open($post->ID)) {
                                    $comments_label = __('comments','cosmotheme');
                                    if (options::logic('general', 'fb_comments')) {
                                        ?>
                                            <li class="meta-elem">
                                                <a href="<?php echo get_comments_link($post->ID); ?>"><i class="icon-comment"></i><fb:comments-count href="<?php echo get_permalink($post->ID) ?>"></fb:comments-count> <?php echo $comments_label; ?></a>
                                            </li>
                                        <?php
                                    } else {
                                        if(get_comments_number($post->ID) == 1){
                                            $comments_label = __('comment','cosmotheme');    
                                        }
                                        ?>
                                            <li class="meta-elem">
                                                <a href="<?php echo get_comments_link($post->ID); ?>"><i class="icon-comment"></i><?php echo  get_comments_number($post->ID) . ' ' .$comments_label; ?></a>
                                            </li>
                                        <?php
                                    }
                                }

                                    echo  '<li class="meta-elem right">'.post::get_post_format_link($post->ID).'</li>';
                                ?>
                                
                            </ul>
                        </div>
                        <?php } ?>
                    </div>

                </div>
            </article>
        </div>
          
        
        <?php
    }

    function grid_view($post, $options) {

            $object_id = $options['object-id'];
            extract( $options );

            $nofeat_article_class = '';
            if(!post::is_feat_enabled($post->ID)){
                $nofeat_article_class = 'nofeat';    
            }
            if($enable_masonry == 'enable_masonry'){
                $masonry_class = ' masonry_elem ';    
            }else{
                $masonry_class = '';
            }
            
        ?>
        <?php if(isset($options['enable_ajax_post']) && $options['enable_ajax_post'] == 'enable_ajax_post') { 
                $enable_ajax_post = self::get_click_action($post->ID, $object_type, $object_id, $post->post_type ); 
            } else { $enable_ajax_post = '';} 
        ?>        
        <div class="<?php echo $masonry_class . columns_arabic_to_word( $number_columns ); ?> columns">
            <article class="articlebox below_image">
                <?php 
                    if(post::is_feat_enabled($post->ID) && has_post_thumbnail($post->ID)){
                        if($resize_method == 'resize'){
                            $size = 'tgrid_resized';
                        }else{
                            $size = 'tgrid';    
                        }
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , $size );
                ?>
                    <div class="featimg"  >
                        <div class="hover-more">
                            <div class="hover-more-img">
                                <?php  $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , $size ); ?>
                                <img src="<?php echo $src[0]; ?>" alt="" />
                                <?php
                                    if (options::logic('styling', 'stripes')) {
                                    ?><div class="featimg-hover-container"><div class="stripes" >&nbsp;</div></div><?php
                                    }
                                ?>
                            </div>
                            <div class="item-overlay">
                                <div class="featimg-hover">
                                    <a  href="<?php echo get_permalink($post -> ID); ?>" <?php echo $enable_ajax_post; ?> title="" class="featimg-hover-more" >
                                        <?php _e('More','cosmotheme'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>    

                    </div>
                <?php
                    }
                ?>
                <div class="entry-container">
                    <div class="entry-title">
                        <h4><a href="<?php echo get_permalink($post -> ID); ?>" class="ajax_link" <?php echo $enable_ajax_post; ?>><?php echo $post -> post_title; ?></a></h4>           
                    </div>
                    <div class="excerpt">
                        <?php 
                            $ln = 180;
                            post::get_excerpt($post, $ln = $ln);  
                            
                        ?>
                    </div>
                </div>
                <div class="likes">
                    <ul>
                        <li class="metas-date">
                            <?php
                            if (options::logic('general', 'time')) {
                                 echo human_time_diff(get_the_time('U', $post->ID), current_time('timestamp')) . ' ' . __('ago', 'cosmotheme'); 
                            } else {
                                echo date_i18n(get_option('date_format'), get_the_time('U', $post->ID)); 
                            }
                            ?>
                        </li>
                        <li class="metas-big">
                            <?php  
                                like::content($post->ID, 3, false);
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="design-element">
                    <p></p>
                    <p></p>
                </div>
            </article>
        </div>

        
        <?php
    }

    function thumb_view($post, $options){
        $object_id = $options['object-id'];
        extract( $options );

        if($enable_masonry == 'enable_masonry'){
            $masonry_class = ' masonry_elem ';    
        }else{
            $masonry_class = '';
        }

        if(post::is_feat_enabled($post->ID) && has_post_thumbnail($post->ID)){
            if($resize_method == 'resize'){
                $size = 'tgrid_resized';
            }else{
                $size = 'tgrid';    
            }
            
            
            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , $size );
            $src = $src[0];
        }else{
            $src = get_template_directory_uri(). "/images/no.image.280x140.png";
        }

        ?>
        <?php 
        global $ajax_link;
        if((isset($options['enable_ajax_post']) && $options['enable_ajax_post'] == 'enable_ajax_post') || (isset($ajax_link) && $ajax_link === true && is_single())) { 
                $enable_ajax_post = self::get_click_action($post->ID, $object_type, $object_id, $post->post_type ); 
            } else { $enable_ajax_post = '';} 
        ?>      
        <?php 
            $filter_classes = ' ';
            $data_id = ' ';
        if($use_filter){
            $filter_classes = ' all all-elements ';
            $data_id = 'data-id="'.$post->ID.'"';

            if($post -> post_type == 'portfolio'){
                if($filter_by == 'post_tag'){
                    $filter_by = 'portfolio-tag' ;
                }elseif($filter_by == 'category'){
                    $filter_by = 'portfolio-category' ;
                }
            }

            $filter_classes .= get_distinct_post_terms( $post->ID, $taxonomy = $filter_by, $return_names = true, $filter_type = $filter_type );
        } 
        ?>
        <div class="<?php echo $masonry_class . columns_arabic_to_word( $number_columns );  echo $filter_classes; ?> columns" <?php echo $data_id; ?> >
            <article class="articlebox">
                <div class="featimg"  >
                    <div class="hover-more">
                        <div class="hover-more-img">
                            <img src="<?php echo $src; ?>" alt="" />
                            <?php
                                if (options::logic('styling', 'stripes')) {
                                ?><div class="featimg-hover-container"><div class="stripes" >&nbsp;</div></div><?php
                                }
                            ?>
                        </div>
                        <div class="item-overlay">
                            <div class="featimg-hover">
                                <a  href="<?php echo get_permalink($post -> ID); ?>" <?php echo $enable_ajax_post; ?> title="" class="featimg-hover-more" >
                                    <?php _e('More','cosmotheme'); ?>
                                </a>
                            </div>
                        </div>
                    </div>    

                </div>
                
            </article>
        </div>
    
    <?php
        
    }

    function meta( $post ) {
        global $wp_query;
        
        ?>
            <?php
            if(get_post_type($post -> ID) == 'post'){
                $tag_taxonomy = 'post_tag';
                $category_tax = 'category';    
            } elseif(get_post_type( $post -> ID) == 'portfolio') {
                $tag_taxonomy = 'portfolio-tag';
                $category_tax = 'portfolio-category';   
            } elseif (get_post_type( $post -> ID) == 'page') {
                $tag_taxonomy = '';
                $category_tax = '';   
            }
            
            $tags = post::get_post_taxonomies($post->ID, $only_first_cat = false, $taxonomy = $tag_taxonomy, $margin_elem_start = '', $margin_elem_end = '', $delimiter = ',&nbsp;',  $a_class = '');
            if(strlen(trim($tags))){
            ?>
                <li class="single-meta-details-elem"><span class="single-meta-details-title"><?php _e( 'Tags:' , 'cosmotheme' ); ?></span><div class="single-meta-details-content"><?php echo  $tags ;?></div><div class="clear"></div></li>
            <?php
            }

                $categories = post::get_post_taxonomies($post->ID, $only_first_cat = false, $taxonomy = $category_tax, $margin_elem_start = '', $margin_elem_end = '', $delimiter = ',&nbsp;',  $a_class = '');
                if(strlen(trim($categories))){
                ?>
                    <li class="single-meta-details-elem"><span class="single-meta-details-title"><?php _e( 'Category:' , 'cosmotheme' ); ?></span><div class="single-meta-details-content"><?php echo  $categories ;?></div><div class="clear"></div></li>

                <?php
                }
                    if (comments_open($post->ID)) {
                        $comments_label = __('comments','cosmotheme');  
                        if (options::logic('general', 'fb_comments')) {
                            ?><li class="single-meta-details-elem" title=""><?php if(!is_page()){?><span class="single-meta-details-title"><?php _e( 'Comments:' , 'cosmotheme' ); ?></span><?php }?><div class="single-meta-details-content"><a href="<?php echo get_comments_link($post->ID); ?>"> <fb:comments-count href="<?php echo get_permalink($post->ID) ?>"></fb:comments-count> <?php  echo $comments_label; ?> </a></div><div class="clear"></div></li><?php
                        } else {
                            
                            if(get_comments_number($post->ID) == 1){
                                $comments_label = __('comment','cosmotheme');
                            }
                            ?><li class="single-meta-details-elem" title="<?php echo get_comments_number($post->ID); echo ' '.$comments_label; ?>"><?php if(!is_page()){?><span class="single-meta-details-title"><?php _e( 'Comments:' , 'cosmotheme' ); ?></span><?php }?><div class="single-meta-details-content"><a href="<?php echo get_comments_link($post->ID) ?>"> <?php echo get_comments_number($post->ID) ?> <?php echo $comments_label; ?> </a></div><div class="clear"></div></li><?php
                        }
                    }
                ?>

        <?php
        }
       
        function get_embeded_video($video_id,$video_type,$autoplay = 0,$width = 570,$height = 414){
            
            $embeded_video = '';
            if($video_type == 'youtube'){
                $embeded_video  = '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?wmode=transparent&autoplay='.$autoplay.'" wmode="opaque" frameborder="0" allowfullscreen></iframe>';
            }elseif($video_type == 'vimeo'){
                $embeded_video  = '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;autoplay='.$autoplay.'&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
            }
            
            return $embeded_video;
        }
        
        function get_local_video($video_url, $width = 570, $height = 414, $autoplay = false ){
            
            $result = '';    
            
            if($autoplay){
                $auto_play = 'true';
            }else{
                $auto_play = 'false';
            }
            
            $result = do_shortcode('[video mp4="'.$video_url.'" width="'.$width.'" height="'.$height.'"  autoplay="'.$auto_play.'"]');
            
            return $result; 
        }
  
        function get_video_thumbnail($video_id,$video_type){
            $thumbnail_url = '';
            if($video_type == 'youtube'){
                $thumbnail_url = 'http://i1.ytimg.com/vi/'.$video_id.'/hqdefault.jpg';
            }elseif($video_type == 'vimeo'){
                
                $hash = wp_remote_get("http://vimeo.com/api/v2/video/$video_id.php");
                $hash = unserialize($hash['body']);
                
                $thumbnail_url = $hash[0]['thumbnail_large'];  
            }
            
            return $thumbnail_url;
        }
        
        function get_youtube_video_id($url){
            /*
             *   @param  string  $url    URL to be parsed, eg:  
            *  http://youtu.be/zc0s358b3Ys,  
            *  http://www.youtube.com/embed/zc0s358b3Ys
            *  http://www.youtube.com/watch?v=zc0s358b3Ys 
            *  
            *  returns
            *  */   
            $id=0;
            
            /*if there is a slash at the en we will remove it*/
            $url = rtrim($url, " /");
            if(strpos($url, 'youtu')){
                $urls = parse_url($url); 
         
                /*expect url is http://youtu.be/abcd, where abcd is video iD*/
                if(isset($urls['host']) && $urls['host'] == 'youtu.be'){  
                    $id = ltrim($urls['path'],'/'); 
                } 
                /*expect  url is http://www.youtube.com/embed/abcd*/ 
                else if(strpos($urls['path'],'embed') == 1){  
                    $id = end(explode('/',$urls['path'])); 
                } 
                 
                /*expect url is http://www.youtube.com/watch?v=abcd */
                else if( isset($urls['query']) ){ 
                    parse_str($urls['query']); 
                    $id = $v; 
                }else{
                    $id=0;
                } 
            }   
            
            return $id;
        }
        
        function  get_vimeo_video_id($url){
            /*if there is a slash at the en we will remove it*/
            $url = rtrim($url, " /");
            $id = 0;
            if(strpos($url, 'vimeo')){
                $urls = parse_url($url); 
                if(isset($urls['host']) && $urls['host'] == 'vimeo.com'){  
                    $id = ltrim($urls['path'],'/'); 
                    if(!is_numeric($id) || $id < 0){
                        $id = 0;
                    }
                }else{
                    $id = 0;
                } 
            }   
            return $id;
        }
        

        function isValidURL($url)
        {
            return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
        }


        function remove_post(){
            if(isset($_POST['post_id']) && is_numeric($_POST['post_id'])){
                $post = get_post($_POST['post_id']);
                if(get_current_user_id() == $post->post_author){ echo 'ee';
                    wp_delete_post($_POST['post_id']);
                }
            }  

            exit;
        }
        
        function get_source($post_id){
            
            $source = '';
            $source_meta = meta::get_meta( $post_id , 'source' );
            
            if(is_array($source_meta) && sizeof($source_meta) && isset($source_meta['post_source']) && trim($source_meta['post_source']) != ''){
                if(self::isValidURL($source_meta['post_source'])){
                    $source_url = $source_meta['post_source'];
                    if( !is_numeric(strpos($source_meta['post_source'], 'http')) ){ /*if the $source dos not contain http we will add it*/
                        $source_url = 'http://'.$source_meta['post_source'];
                    }
                    $source = '<li class="single-meta-details-elem"><span class="single-meta-details-title">'. __( 'Website:' , 'cosmotheme' ).'</span><div class="single-meta-details-content"><a href="'.$source_url.'" target="_blank" >'. $source_url.'</a></div><div class="clear"></div></li>';
                }else{
                    $source = '<li class="single-meta-details-elem"><span class="single-meta-details-title">'. __( 'Website:' , 'cosmotheme' ).'</span><div class="single-meta-details-content">'.$source_meta['post_source'].'</div><div class="clear"></div></li>';
                }
            }else{
                $source = ''; //'<div class="source no_source"><p>'.__('Unknown source','cosmotheme').'</p></div>';
            }
            
        
                    
            return $source;         
        }

        function get_client($post_id){
            /*returns 'post_client' meta data*/
            $client = '';
            $source_meta = meta::get_meta( $post_id , 'source' );
            
            if( isset($source_meta['post_client']) && trim($source_meta['post_client']) != ''){
                $client = '<li class="single-meta-details-elem"><span class="single-meta-details-title">'. __( 'Client:' , 'cosmotheme' ).'</span><div class="single-meta-details-content">'. $source_meta['post_client'] .'</div><div class="clear"></div></li>';
            }
                
            return $client;         
        }

        function get_services($post_id){
            /*returns 'post_services' meta data*/
            $services = '';
            $source_meta = meta::get_meta( $post_id , 'source' );
            
            if(isset($source_meta['post_services']) && trim($source_meta['post_services']) != ''){
                $services = '<li class="single-meta-details-elem"><span class="single-meta-details-title">'. __( 'Services:' , 'cosmotheme' ).'</span><div class="single-meta-details-content">'. $source_meta['post_services'] .'</div><div class="clear"></div></li>';
            }
                
            return $services;         
        }

        function get_attached_file($post_id){
            
            $attached_file = '';
            $attached_file_meta = meta::get_meta( $post_id , 'format' );

            
            if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['link_id']) && is_array($attached_file_meta['link_id'])){
                foreach($attached_file_meta['link_id'] as $file_id)
                  {
                    $attachment_url = explode('/',wp_get_attachment_url($file_id));
                    $file_name = '';
                    if(sizeof($attachment_url)){
                      $file_name = $attachment_url[sizeof($attachment_url) - 1];
                    }   
                    $attached_file .= '<div class="attach">';
                    $attached_file .= '<i class="icon-link"></i>';
                    $attached_file .= ' <a href="'.wp_get_attachment_url($file_id).'">'.$file_name.'</a>';
                    $attached_file .= '</div>';
                  }
            }else if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['link_id']))
              {
                $file_id=$attached_file_meta['link_id'];
                $attachment_url = explode('/',wp_get_attachment_url($file_id));
                    $file_name = '';
                    if(sizeof($attachment_url)){
                      $file_name = $attachment_url[sizeof($attachment_url) - 1];
                    }   
                    $attached_file .= '<div class="attach">';
                    $attached_file .= '<i class="icon-link"></i>';
                    $attached_file .= ' <a href="'.wp_get_attachment_url($file_id).'">'.$file_name.'</a>';
                    $attached_file .= '</div>';
              }
                    
            return $attached_file;          
        }

        function get_audio_file($post_id){
            $attached_file = '';
            $attached_file_meta = meta::get_meta( $post_id , 'format' );
            
            if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['audio']) && is_array($attached_file_meta['audio'])){

                foreach($attached_file_meta['audio'] as $audio_id)
                  {
                    $attached_file .= '[audio:'.wp_get_attachment_url($audio_id).']';
                  }             
            }else if(is_array($attached_file_meta) && sizeof($attached_file_meta) && isset($attached_file_meta['audio']) && $attached_file_meta['audio'] != '' ){
              $attached_file .= '[audio:'.$attached_file_meta['audio'].']';
            }
                    
            return $attached_file;          
        }
        
        function play_video($width=570, $height=414){
            $result = '';   

            if(isset($_POST['width']) && is_numeric($_POST['width']) && isset($_POST['height']) && is_numeric($_POST['height'])){
                $width = $_POST['width'];
                $height = $_POST['height'];
            }

            if(isset($_POST['video_id']) && isset($_POST['video_type']) && $_POST['video_type'] != 'self_hosted'){  
                $result = self::get_embeded_video($_POST['video_id'],$_POST['video_type'],1,$width, $height);
            }else{
                $video_url = urldecode($_POST['video_id']);
                $result = self::get_local_video($video_url, $width, $height, true );
            }   
            
            echo $result;
            exit;
        }
        
        function list_tags($post_id){
            $tag_list = '';
            $tags = wp_get_post_terms($post_id, 'post_tag');

            if (!empty($tags)) {
                    $i = 1;
                    foreach ($tags as $tag) { 
                        if($i==1){
                            $tag_list .= $tag->name;
                        }else{
                            $tag_list .= ', '.$tag->name;
                        }    
                        $i++;
                    }
            }
            
            return $tag_list;
        }


        /*check if showing featured image on archive pages is enabled*/
        public function is_feat_enabled($post_id){
            
            $meta = meta::get_meta( $post_id , 'settings' );
            if (options::get_value( 'blog_post' , 'show_feat_on_archive' ) == 'yes') {
                if(isset($meta['show_feat_on_archive']) && $meta['show_feat_on_archive'] == 'yes'){
                    return true;
                }elseif(isset($meta['show_feat_on_archive']) && $meta['show_feat_on_archive'] == 'no'){
                    return false;
                }  
            }else { return false; }
          
        }

         /*
            will search terms or posts
            params:
            $_GET['query'] - the partial name entered by the user
            $_GET['term_type'] - empty or category, post_tag, portfolio-category, portfolio-tag

        */
        function search_terms(){
            $result = array();

            if(isset($_GET['action']) && $_GET['action'] == 'search_terms' ){
                //get_terms    
                if(isset($_GET['term_type']) ){
                    
                    $args = array( 
                                    'name__like' => $_GET['query'],
                                    'number' => 20,
                                    'hide_empty' => false
                                 );

                    $terms = get_terms($_GET['term_type'], $args);

                    $result['query'] = $_GET['query'];
                    foreach ($terms as $term) {
                        $result['suggestions'][] = $term->name;
                        $result['data'][] =  $term->term_id;
                    }
                    
                }
                echo json_encode( $result );
            }
            

            exit();
        }

        function search_menu_content_items(){

            if(isset($_GET['action']) &&  $_GET['action'] == 'search_menu_content_items'){
                $result = array();

                $content_menu = get_option('_content_menu'); /*get registered menu items*/

                //var_dump($content_menu);

                $result['query'] = $_GET['query'];
                if(is_array($content_menu) && sizeof($content_menu)){
                    foreach ($content_menu as $key => $content_settings) {
                        if(strpos( strtolower($content_settings['object_name']), strtolower($_GET['query'])) !== false){
                            $result['suggestions'][] = $content_settings['object_name'];
                            $result['data'][] =  $key;    
                        }
                        
                    }
                }

                echo json_encode( $result );

            }
            exit();
        }

        function get_post_format_link($post_id){
            
            $result = '';    
            $format = get_post_format( $post_id );
            $format_link = get_post_format_link($format);
            if(!strlen($format_link)){
                $format_link = "javascript:void(0);";
            }

            switch ($format) {
                case 'video':
                    $result = '<a href="'.$format_link.'"><i class="icon-film"></i></a>';
                    break;
                case 'image':
                    $result = '<a href="'.$format_link.'"><i class="icon-camera"></i></a>';
                    break;
                case 'audio':
                    $result = '<a href="'.$format_link.'"><i class="icon-music"></i></a>';
                    break;
                case 'link':
                    $result = '<a href="'.$format_link.'"><i class="icon-file"></i></a>';
                    break;    
                case 'gallery':
                    $result = '<a href="'.$format_link.'"><i class="icon-picture"></i></i></a>';
                    break;        
                default:
                    $result = '<a href="'.$format_link.'"><i class="icon-file"></i></a>';
                    break;
            }
            
            return $result;
        }  

        function get_excerpt($post, $ln){
            if (!empty($post->post_excerpt)) {
                if (strlen(strip_tags(strip_shortcodes($post->post_excerpt))) > $ln) {
                    echo mb_substr(strip_tags(strip_shortcodes($post->post_excerpt)), 0, $ln) . '[...]';
                } else {
                    echo strip_tags(strip_shortcodes($post->post_excerpt));
                }
            } else {
                if (strlen(strip_tags(strip_shortcodes($post->post_content))) > $ln) {
                    echo mb_substr(strip_tags(strip_shortcodes($post->post_content)), 0, $ln) . '[...]';
                } else {
                    echo strip_tags(strip_shortcodes($post->post_content));
                }
            }
            
        }

        function filter_where_next_prev( $where = '' ) {
            // posts  >= 
            global $current_post_id;
            global $where_next_prev; /*> OR <*/
            $where .= " AND ID ".$where_next_prev." " . $current_post_id ;
            return $where;
        }
        function get_next_prev_post($post_id,$post_type,$post_taxonomy_name,$post_taxonomy_id,$direction = 'next'){
            global $where_next_prev;
            if($direction == "prev"){
                $where_next_prev = "<";
                $order = 'desc';
            }else{
                $where_next_prev = ">";
                $order = 'asc';
            }
            global $current_post_id;
            $current_post_id = $post_id;

            

            $query_options = array(
                    'post_status' => 'publish',
                    'post_type' => $post_type,
                    'posts_per_page' => 1,
                    
                    'order' => $order
                );


            if($post_taxonomy_name != 'post_format'){
                $query_options['tax_query'] = array(
                        //'relation' => 'AND',
                        
                        array(
                            'taxonomy' => $post_taxonomy_name,
                            'field' => 'id',
                            'terms' => array( $post_taxonomy_id ),
                            'operator' => 'IN'
                        )
                    );
            }

            add_filter( 'posts_where', array( 'post' , 'filter_where_next_prev' ) );
            $query = new WP_Query( $query_options );
            remove_filter( 'posts_where', array( 'post' , 'filter_where_next_prev' ));
//deb::e($query);
            if(isset($query->posts)){
                if(isset($query->posts[0]->ID)){
                    return $query->posts[0]->ID;    
                }else{
                    return;
                }
                
            }else{
                return;
            }
        }

        function get_ajax_post(){
            if(isset($_POST['action']) && $_POST['action'] == 'get_ajax_post' && isset($_POST['post_id'])){
                
            
            global $ajax_link;
            $ajax_link = true;     

            //$post = get_post( $_POST['post_id'] ); 
            global $wp_query;
            $wp_query = new WP_Query(array('p' => $_POST['post_id'],'post_type' => $_POST['post_type'] ));

            while( $wp_query->have_posts() ) { $wp_query->the_post();
            global $post;
            $post = $wp_query->post;
            $post_id = $post->ID;

            $next_post = post::get_next_prev_post($post_id=$_POST['post_id'],$post_type=$post -> post_type,$post_taxonomy_name=$_POST['object_type'],$post_taxonomy_id=$_POST['object_id'],$direction = 'next');
            $prev_post = post::get_next_prev_post($post_id=$_POST['post_id'],$post_type=$post -> post_type,$post_taxonomy_name=$_POST['object_type'],$post_taxonomy_id=$_POST['object_id'],$direction = 'prev');

            if(is_numeric($next_post)){
                $next_post_link_class = ''; 
                $onclick_next = "onclick='get_ajax_post(".$next_post.",\"".$_POST['object_type']."\",\"".$_POST['object_id']."\",\"".$post -> post_type."\")'";
            }else{
                $next_post_link_class = ' disabled';
                $onclick_next = '';
            }

            if(is_numeric($prev_post)){
                $prev_post_link_class = '';
                $onclick_prev = "onclick='get_ajax_post(".$prev_post.",\"".$_POST['object_type']."\",\"".$_POST['object_id']."\",\"".$post -> post_type."\")'";
            }else{
                $prev_post_link_class = ' disabled';
                $onclick_prev = '';
            }
            
        ?>

            <a class="single-next <?php echo $next_post_link_class; ?>" <?php echo $onclick_next ?> href="javascript:void(0);"><i class="icon-chevron-right"></i></a>
            <a class="single-prev <?php echo $prev_post_link_class; ?>" <?php echo $onclick_prev ?> href="javascript:void(0);"><i class="icon-chevron-left"></i></a>
            <div class="single-div">
                <article class="single-all">
                    <div class="row">
                    <div class="single-title twelve columns">
                        <h2><?php echo $post -> post_title; ?></h2>
                        <div class="article-author">
                            <h3> <a href="<?php echo get_author_posts_url( $post -> post_author) ?>"><?php _e('by ', 'cosmotheme'); echo get_the_author_meta( 'display_name' , $post-> post_author ); ?></a></h3>
                        </div>
                        <?php if(strlen(trim($post->post_excerpt))){ ?>
                        <div class="subtext st">
                            <?php echo apply_filters('the_excerpt', $post->post_excerpt); ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php 
                        if(post::is_feat_enabled($post->ID) && has_post_thumbnail($post->ID) && (get_post_format( $post_id ) != 'video'  && get_post_format( $post_id ) != 'gallery' )  ){
                            $size = 'tmedium';
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , $size );
                            $src1 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'full' );
                    ?>
                    <div class="featimg twelve columns">
                        <a href="<?php echo $src1[0]; ?>" rel="prettyPhoto-<?php echo $post_id; ?>"><img src="<?php echo $src[0]; ?>" alt="" /></a>
                    </div>
                    <?php } ?>

                    <?php if(get_post_format($post->ID)=="gallery" ) {
                        $image_format = meta::get_meta( $post_id , 'format' );
                        $caption = image::caption( $post_id );
                        if(isset($image_format['images']) && is_array($image_format['images'])){
                            echo "<div class=\"single-slider-container twelve columns\">";
                            echo "<ul class=\"single-slider\">";
                            foreach($image_format['images'] as $index=>$img_id){
                                $thumbnail= wp_get_attachment_image_src( $img_id, 'gallery_single');
                                $full_image=wp_get_attachment_url($img_id);
                                $url=$thumbnail[0];
                                $width=$thumbnail[1];
                                $height=$thumbnail[2];

                                echo "<li class=\"single-slider-elem\">";
                                ?>
                                <a href="<?php echo $full_image; ?>" title="<?php echo $caption;  ?>" rel="prettyPhoto[gallery-<?php echo $post_id?>]"><?php echo "<img alt=\"\" src=\"$url\">"; ?></a>
                            <?php
                                echo "</li>";

                            }
                            echo "</ul>";
                            echo "</div>";                                
                        }                    
                    }elseif( get_post_format( $post_id ) == 'video' ){

                        $video_format = meta::get_meta( $post_id , 'format' );
                    ?>
                        <div class="videos twelve columns">
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
                    <?php  
                        if( get_post_format( $post_id ) == 'image' ){
                            $image_format = meta::get_meta( $post_id , 'format' );
                            if(isset($image_format['images']) && is_array($image_format['images'])){
                                echo "<div class=\"attached_imgs_gallery twelve columns\">";
                                foreach($image_format['images'] as $index=>$img_id){
                                    $thumbnail= wp_get_attachment_image_src( $img_id, 'thumbnail');
                                    $full_image=wp_get_attachment_url($img_id);
                                    $url=$thumbnail[0];
                                    $width=$thumbnail[1];
                                    $height=$thumbnail[2];

                                    echo "<div class=\"attached_imgs_gallery-elementm\">";
                                    ?>
                                    <a href="<?php echo $full_image; ?>" title="" rel="prettyPhoto[gallery-<?php echo $post_id?>]"><?php echo "<img alt=\"\" src=\"$url\" width=\"$width\" height=\"$height\">"; ?></a>
                                <?php
                                    echo "</div>";

                                }
                                echo '<div class="clear"></div>';
                                echo "</div>";                
                            }  
                        }
                    ?>

                    <?php 
                        $content_width = ' twelve ';
                        if( meta::logic( $post , 'settings' , 'meta' )  ){ 
                            $content_width = ' nine ';
                    ?>
                    <div class="single-content-details three columns">
                        <div class="single-meta">
                            <div class="single-meta-icons-container">
                                <ul class="single-meta-icons"> 
                                    <li class="single-meta-icons-elem photo-btn"><?php echo post::get_post_format_link($post ->ID); ?></li>
                                    <li class="single-meta-icons-elem single-date"><?php  echo get_the_time('j', $post->ID); ?> <span><?php echo  get_the_time('M', $post->ID); ?></span></li>
                                </ul>
                            </div>
                            <div class="single-meta-details-container">
                                <ul class="single-meta-details">
                                <?php 
                                    if( (meta::logic( $post , 'settings' , 'meta' ) && get_post_type($post_id) == 'portfolio')){
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
                    <?php } ?>
                    <div class="single-content <?php echo $content_width; ?> columns">

                        <?php 
                            if( get_post_format( $post_id ) == 'audio' ){
                                $audio = new AudioPlayer(); 
                                echo $audio->processContent( post::get_audio_file( $post_id ) );
                            }
                            echo apply_filters('the_content', $post->post_content); 
                        ?>
                        <?php
                            if(get_post_format( $post_id ) == 'link' ){
                                echo post::get_attached_file( $post_id );
                            }
                        ?>  

                        <div class="clear"></div>
                    </div>
                    <?php include_once( get_template_directory().'/social-sharing.php' ); ?>
                    <?php if( options::logic( 'blog_post' , 'show_similar' )){ ?>
                    <div class="twelve columns">
                        <?php include_once( get_template_directory().'/related-posts.php' ); ?>
                    </div>
                    <?php }?>
                    <?php
                        /* comments */
                        
                        if( comments_open($post_id) ){
                    ?>
                                   
                        <?php        
                                if( options::logic( 'general' , 'fb_comments' ) ){
                                    ?>
                                    <div id="comments" class="twelve columns">
                                        <h3 id="reply-title"><?php _e( 'Leave a reply' , 'cosmotheme' ); ?></h3>
                                        <p class="delimiter">&nbsp;</p>
                                        <fb:comments href="<?php the_permalink(); ?>" num_posts="5" width="430" height="120" reverse="true"></fb:comments>
                                    </div>
                                    <?php
                                }else{
                                    comments_template( '', true );
                                }
                        ?>   
                        <?php    
                        }
                    
                    ?>
                </div>
                </article>
            </div>
        <?php
            } /*EOF while have posts*/
            }
            exit;     /*EOF if*/
        } 

        function load_more(){
            $response = array();
            if(isset($_POST['action']) && $_POST['action'] == 'load_more'){

                global $ajax_link;
                $ajax_link = true;  /*this will force to load new posts via ajax if this option is not disabled from theme settings*/
                
                /*get encoded settings*/
                /* sample settings: 

                    enable_load_more: "enable_load_more"
                    enable_masonry: "enable_masonry"
                    number_columns: "3"
                    number_posts: "12"
                    object-id: "2"
                    object_name: "Blogroll"
                    object_type: "category"
                    order: "desc"
                    order_by: "date"
                    resize_method: "crop"
                    view_type: "grid_view"
                */
                $settings =   (array)json_decode( urldecode( $_POST['settings'] ) );

                if(strpos($settings['object_type'], 'portfolio')){
                    $post_type = 'portfolio';
                }else{
                    $post_type = 'post';
                }

                $current_page_nr = $_POST['page_nr']+1;

                if($settings['object_type'] == 'post_format'){
                    $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => array('post','portfolio'),
                            'posts_per_page' => $settings['number_posts'],
                            'paged' => $current_page_nr,
                            'tax_query' => array(
                                //'relation' => 'AND',
                                array(
                                    'taxonomy' => 'post_format',
                                    'field' => 'slug',
                                    'terms' => array( 'post-format-'.$settings['object-id'] )
                                )
                            )
                        );

                    if($settings['object-id'] == 'latest_posts' || $settings['object-id'] == 'latest_portfolios'){
                        if($settings['object-id'] == 'latest_posts'){
                            $posttype = 'post';
                        }elseif($settings['object-id'] == 'latest_portfolios'){
                            $posttype = 'portfolio';
                        }

                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => array($posttype),
                            'paged' => $current_page_nr,
                            'posts_per_page' => $settings['number_posts'],
                        );  
                    }elseif($settings['object-id'] != 'standard'){
                        $query_options['tax_query'] = array(
                            //'relation' => 'AND',
                            array(
                                'taxonomy' => 'post_format',
                                'field' => 'slug',
                                'terms' => array( 'post-format-'.$settings['object-id'] )
                            )
                        );
                    }else{ /*for standard post format*/
                        
                        $query_options['tax_query'] = array(
                            //'relation' => 'AND',
                            array(
                                'taxonomy' => 'post_format',
                                'field' => 'slug',
                                'terms' => array('post-format-video','post-format-image','post-format-link','post-format-audio','post-format-gallery'),
                                'operator' => 'NOT IN' 
                            )
                        );
                    }
                }else{
                    $query_options = array(
                    'post_status' => 'publish',
                    'post_type' => $post_type,
                    'posts_per_page' => $settings['number_posts'],
                    'paged' => $current_page_nr,
                    'tax_query' => array(
                            //'relation' => 'AND',
                            
                            array(
                                'taxonomy' => $settings['object_type'],
                                'field' => 'id',
                                'terms' => array( $settings['object-id'] ),
                                'operator' => 'IN'
                            )
                        )
                    );    
                }
                
                $query_options = decorate_wp_query_with_order( $query_options, $settings['order_by'], $settings['order'] );
                $wp_query = new WP_Query( $query_options );
                
                if($wp_query -> found_posts){

                    if( $current_page_nr*$wp_query -> post_count < $wp_query -> found_posts){ /*this will indicate if we need to show load more or not*/
                        $response['need_load_more'] = 1; 
                    }else{
                        $response['need_load_more'] = 0;                    
                    }

                    ob_start(); 
                    ob_clean();

                    $counter = 1;
                    foreach ($wp_query -> posts as $post) {
                        call_user_func( array( 'post', $settings['view_type'] ), $post, $settings );
                        if($settings['enable_masonry']  != 'enable_masonry' && $counter % $settings['number_columns'] == 0 
                                        && ($settings['view_type'] == 'grid_view' || $settings['view_type'] == 'thumb_view') ){
                            echo '<div class="clear"></div>';
                        }
                        $counter++;
                    }

                    $content = ob_get_clean();
                    $response['content'] = $content;
                }else{
                    $response['need_load_more'] = 0;     /*this will indicate if we need to show load more or not*/               
                }

                $response['current_page_nr'] = $current_page_nr; /*return current page*/

                //$response['settings'] = $settings;
            }

            echo json_encode($response);
            exit;
        }
    }
?>