<?php
	function cosmo__autoload( $class_name ){
        if( substr( $class_name , 0 , 6 ) == 'widget'){
            $class_name = str_replace( 'widget_' , '' ,  $class_name );
            if( is_file( get_template_directory() . '/lib/php/widget/' . $class_name . '.php' ) ){
                include get_template_directory() . '/lib/php/widget/' . $class_name . '.php';

            }
        }
		if( is_file( get_template_directory() . '/lib/php/' . $class_name . '.class.php' ) ){
			include_once get_template_directory() . '/lib/php/' . $class_name . '.class.php';
            if( is_file( get_template_directory() . '/lib/php/' . $class_name . '.register.php' ) ){
				include_once get_template_directory() . '/lib/php/' . $class_name . '.register.php';
			}
		}
	}
    
	spl_autoload_register ("cosmo__autoload");
	
	include_once get_template_directory() . '/lib/php/audio-player.php';

    $labels = array(
        'name' => _x( 'Box Sets', 'taxonomy general name', 'cosmotheme' ),
        'singular_name' => _x( 'Box Set', 'taxonomy singular name', 'cosmotheme' ),
        'search_items' =>  __( 'Search Box Set', 'cosmotheme' ),
        'all_items' => __( 'All Box Sets', 'cosmotheme' ),
        'parent_item' => __( 'Parent Box Set', 'cosmotheme' ),
        'parent_item_colon' => __( 'Parent Box Set:', 'cosmotheme' ),
        'edit_item' => __( 'Edit Box Set', 'cosmotheme' ), 
        'update_item' => __( 'Update Box Set', 'cosmotheme' ),
        'add_new_item' => __( 'Add New Box Set', 'cosmotheme' ),
        'new_item_name' => __( 'New Box Set Name', 'cosmotheme' ),
        'menu_name' => __( 'Box Sets', 'cosmotheme' ),
      );    


    register_taxonomy(
        
    'box-sets',
        'box',
        array(
            'labels' => $labels,
            'rewrite' => array( 'slug' => 'box-sets' ),
            'hierarchical' => true
        )
    );


     $labels = array(
        'name' => _x( 'Groups', 'taxonomy general name', 'cosmotheme' ),
        'singular_name' => _x( 'Group', 'taxonomy singular name', 'cosmotheme' ),
        'search_items' =>  __( 'Search group', 'cosmotheme' ),
        'all_items' => __( 'All group', 'cosmotheme' ),
        'parent_item' => __( 'Parent group', 'cosmotheme' ),
        'parent_item_colon' => __( 'Parent group:', 'cosmotheme' ),
        'edit_item' => __( 'Edit group', 'cosmotheme' ),
        'update_item' => __( 'Update group', 'cosmotheme' ),
        'add_new_item' => __( 'Add new group', 'cosmotheme' ),
        'new_item_name' => __( 'New new Name', 'cosmotheme' ),
        'menu_name' => __( 'Groups', 'cosmotheme' ),
    );

    register_taxonomy(
        'team-group',
        'team',
        array(
            'labels' => $labels,
            'rewrite' => array( 'slug' => 'team-grup' ),
            'hierarchical' => true
        )
    );

    /*register tags and categories taxonomies for portfolio posts*/
    $portfolio_category = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Category', 'taxonomy general name' ,'cosmotheme' ),
            'singular_name' => _x( 'Category', 'taxonomy singular name','cosmotheme' ),
            'search_items' =>  __( 'Search Categories', 'cosmotheme' ),
            'all_items' => __( 'All Categories', 'cosmotheme' ),
            'parent_item' => __( 'Parent Category', 'cosmotheme' ),
            'parent_item_colon' => __( 'Parent Category:', 'cosmotheme' ),
            'edit_item' => __( 'Edit Category', 'cosmotheme' ), 
            'update_item' => __( 'Update Category', 'cosmotheme' ),
            'add_new_item' => __( 'Add New Category', 'cosmotheme' ),
            'new_item_name' => __( 'New Category Name', 'cosmotheme' ),
            'menu_name' => __( 'Category', 'cosmotheme' ),
        ),  
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'portfolio-category' ),
    );

    $portfolio_tag = array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x( 'Tags', 'taxonomy general name','cosmotheme' ),
            'singular_name' => _x( 'Tag', 'taxonomy singular name','cosmotheme' ),
            'search_items' =>  __( 'Search Tags', 'cosmotheme' ),
            'popular_items' => __( 'Popular Tags', 'cosmotheme' ),
            'all_items' => __( 'All Tags', 'cosmotheme' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Tag', 'cosmotheme' ),
            'update_item' => __( 'Update Tag', 'cosmotheme' ),
            'add_new_item' => __( 'Add New Tag', 'cosmotheme' ),
            'new_item_name' => __( 'New Tag Name', 'cosmotheme' ),
            'separate_items_with_commas' => __( 'Separate tags with commas', 'cosmotheme' ),
            'add_or_remove_items' => __( 'Add or remove tags', 'cosmotheme' ),
            'choose_from_most_used' => __( 'Choose from the most used tags', 'cosmotheme' ),
            'menu_name' => __( 'Tags', 'cosmotheme' ),
          ),
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'portfolio-tag' ),
    );

    register_taxonomy('portfolio-category', 'portfolio', $portfolio_category);
    register_taxonomy('portfolio-tag', 'portfolio', $portfolio_tag);
    /* EOF register tags and categories taxonomies for portfolio posts */



    /*register categories taxonomies for testimonials posts*/
    $testimonial_category = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Category', 'taxonomy general name' ,'cosmotheme' ),
            'singular_name' => _x( 'Category', 'taxonomy singular name','cosmotheme' ),
            'search_items' =>  __( 'Search Categories', 'cosmotheme' ),
            'all_items' => __( 'All Categories', 'cosmotheme' ),
            'parent_item' => __( 'Parent Category', 'cosmotheme' ),
            'parent_item_colon' => __( 'Parent Category:', 'cosmotheme' ),
            'edit_item' => __( 'Edit Category', 'cosmotheme' ), 
            'update_item' => __( 'Update Category', 'cosmotheme' ),
            'add_new_item' => __( 'Add New Category', 'cosmotheme' ),
            'new_item_name' => __( 'New Category Name', 'cosmotheme' ),
            'menu_name' => __( 'Category', 'cosmotheme' ),
        ),  
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'testimonial-category' ),
    );



    register_taxonomy('testimonial-category', 'testimonial', $testimonial_category);
    /* EOF register categories taxonomies for testimonials posts */
  
    
	/* check if item is usable folder or file */
    function is_item( $item ){
        if( $item != '.' && $item != '..' && $item != '.svn' ){
            return true;
        }else{
            return false;
        }
    }
    
    
    
    function get_item_label( $item ){
        $item = basename( $item );
        $item = str_replace( '-' , ' ' , $item );
        return $item;
    }

    function get_item_slug( $item ){
        $item = basename( $item );
        $item = str_replace( '-', '_' , str_replace( ' ', '__' , $item ) );
        return $item;
    }

    function get_subitem_slug( $item , $subitem ){
        $item = get_item_slug( $item );
        $subitem = get_item_slug( $subitem );
        $subitem = $item . FN_DELIM . $subitem;
        return $subitem;
    }

    function get_items( $slug ){
        $items = explode( FN_DELIM , $slug );
        $result = array();
        if( is_array( $items ) ){
            foreach( $items as $item ){
                $result[] = str_replace( '_', '-' , str_replace( '__', ' ' , $item ) );
            }
        }else{
            $result = str_replace( '_', '-' , str_replace( '__', ' ' , $item ) );
        }

        return $result;
    }

    function get_item( $slug ){
        $item = str_replace( '_', '-' , str_replace( '__', ' ' , $slug ) );
        return $item;
    }

    function get_path( $slug ){
        $item = str_replace( '_', '-' , str_replace( '__', ' ' , str_replace( FN_DELIM, '/' , $slug ) ) );
        return $item;
    }

    function get__categories( $nr = -1 ){
        $categories = get_categories();

        $result = array();
        foreach($categories as $key => $category){
            if( $key == $nr ){
                break;
            }
            if( $nr > 0 ){
                $result[ $category -> term_id ] = $category -> term_id;
            }else{
                $result[ $category -> term_id ] = $category -> cat_name;
            }
        }

        return $result;
    }

    function get__pages( $first_label = 'Select item' ){
        $pages = get_pages();
        $result = array();
        if( is_array( $first_label ) ){
            $result = $first_label;
        }else{
            if( strlen( $first_label ) ){
                $result[] = $first_label;
            }
        }
        foreach($pages as $page){
            $result[ $page -> ID ] = $page -> post_title;
        }

        return $result;
    }

    function get_testimonials($testimonials){

        $rand = mt_rand(0,9999); /*will use this val to avoid having duplicated IDs if 2 testimonials elements are used on the page*/
        if(count($testimonials -> posts)){
            $result =  '<div class="testimonials">';
            $first_avatar = '';
            $result .= '    <ul class="testimonials-quotes" id="testimonials_quotes_'.$rand.'">';
            foreach( $testimonials -> posts as $post ){
                if( has_post_thumbnail( $post -> ID  ) ){ 
                    $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'tsmall' );
                    $img_url = $img_url[0];
                }else{
                    $img_url = DEFAULT_AVATAR;
                }

                if(!strlen($first_avatar)){
                    $first_avatar = $img_url;
                }
                $result .= '        <li style="display:none" id="testimonial-'.$post -> ID.'_'.$rand.'" data-image="'.$img_url.'">';
                $result .= $post -> post_content;
                $result .= '        </li>';                    
                
            }
            $result .= '    </ul>';

            $nr_testiminials = count($testimonials -> posts);
            $show_auth_relative = true;
            $counter = 1;
            $result .= '<ul class="testimonials-authors">';
            foreach( $testimonials -> posts as $post ){
                $result .= '<li>';
                $result .= '    <a href="#testimonial-'.$post -> ID.'_'.$rand.'"></a>';
                $result .= '</li>';
                if($counter >= $nr_testiminials/2 && $show_auth_relative){
                    $show_auth_relative = false;
                    $result .= '<li class="author relative">';
                    $result .= '    <img class="author-overlay" src="'.$first_avatar.'" alt="None" />';
                    $result .= '<div class="author-border"></div>';
                    $result .= '</li>';
                }
                
                $counter ++;               
            }
            $result .= '</ul>';
            
            
            
            $result .= '<ul class="author-info st">';
                foreach( $testimonials -> posts as $post ){
                    $testimonial_info = meta::get_meta( $post->ID, 'info' );
                    $result .= '    <li id="testimonial-'.$post -> ID.'_'.$rand.'-author">'.$testimonial_info['name'].', '.$testimonial_info['title'].'</li>';
                }
            $result .= '</ul></div>';
            
            
            echo $result;    
        }else{
            echo '<p class="select">' . __( 'There are no testimonials' , 'cosmotheme' ) . '</p>';
        }
    }

    function get__posts( $args = array() , $first_label = 'Select item' ){
        $posts = get_posts( $args );
        $result = array();
        
        if( is_array( $first_label ) ){
            $result = $first_label;
        }else{
            if( strlen( $first_label ) ){
                $result[] = $first_label;
            }
        }
        if( is_array( $posts ) && !empty( $posts ) ){
            foreach( $posts as $post ){
                $result[ $post -> ID  ] = $post -> post_title;
            }
        }

        return $result;
    }

    function menu( $id ,  $args = array() ){

        $menu = new menu( $args );

        $vargs = array(
            'menu'            => '',
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => isset( $args['class'] ) ? $args['class'] : '',
            'menu_id'         => '',
            'echo'            => false,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'depth'           => 0,
            'walker'          => $menu,
            'theme_location'  => $id ,
        );

        $result = wp_nav_menu( $vargs );

        /*uncomment the following rows to show the default menu bult from pages.*/
        /*if(!strlen($result)){

            $result = $menu -> get_terms_menu();
            
            //var_dump($result);
        }*/

        if( $menu -> need_more &&  $id != 'megusta' ){
                $result .="</li></ul>".$menu -> aftersubm ;
        }
        
        return $result;
    }

    function get_meta_records_( $post_id , $args ){
        $meta = meta::get_meta( $post_id , $args[ 1 ]  );
        $struct = meta::new_structure( resources::$box[ $args[0] ][ $args[1 ] ]['struct'] );
        $result = '';
        if( !empty( $meta ) ){
            $result .= '<h3 class="hndlell"><span>' . resources::$box[ $args[0] ][ $args[1 ] ]['records-title'] . '</span></h3>';
            foreach( $meta as $index => $m ){
                $img = '';

                if( isset( resources::$box[ $args[0] ][ $args[1 ] ]['res_type'] ) ){
                    switch( resources::$box[ $args[0] ][ $args[1 ] ]['res_type'] ){
                        case 'user' : {
							if(get_the_author_meta( 'first_name' , $m['idrecord'] ) != '' || get_the_author_meta( 'last_name' , $m['idrecord'] ) != ''){
								$title      = get_the_author_meta( 'first_name' , $m['idrecord'] ) . ' ' . get_the_author_meta( 'last_name' , $m['idrecord'] ) . ' (' . get_the_author_meta( 'nickname' , $m['idrecord'] ) . ') ';
							}else{
								$title      = get_the_author_meta( 'nickname' , $m['idrecord'] ) ;
							}
                            $status     = get_the_author_meta( 'user_status' , $m['idrecord'] ) ;

                            break;
                        }
                    }
                }else{
                    $post = get_post( $m['idrecord'] );
                    $title  = $post -> post_title;
                    if( isset( $post -> post_excerpt ) ){
                        $excerpt = strip_tags( $post -> post_excerpt );
                    }
                }
                
                if( !empty( $title ) ){
                    $result .= '<div class="side-meta-box-multiple-records">';
                    if( isset( $post ) && has_post_thumbnail( $post -> ID ) ){
                        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , array( 50 , 50 ) );
                        $img = '<div class="icon"><img src="' . $src[0] . '" width="50" height="50"/></div>';
                    }
                    if( isset( $post ) ){
                        $result .= '<strong><a href="post.php?post=' . $post -> ID . '&action=edit">' . $title . '</a></strong>';
                    }else{
                        $result .= '<strong>' . $title . '</strong>';
                    }
                    
                    if( isset( $excerpt ) ){
                        $result .= '<p>'.$img.'<i>' . mb_substr( $excerpt , 0 , 140 ) . '</i></p>';
                    }
                    if( isset( $post ) ){
                        $result .= meta::get_actions( $struct , $args[0] , $args[1 ] , $post_id , null , $index , '#' . $args[0] . $args[1 ] . $index , ' - <b>'. __('Status: ','cosmotheme') . '</b>' . $post -> post_status ) ;
                    }else{
                        $result .= meta::get_actions( $struct , $args[0] , $args[1 ] , $post_id , null , $index , '#' . $args[0] . $args[1 ] . $index , '' ) ;
                    }
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                }
            }
        }
        return $result;
    }

    function page(){
        if( (int)get_query_var('paged') > (int)get_query_var('page') ){
            $result = (int)get_query_var('paged');
        }else{

            if( (int)get_query_var('page') == 0 ){
                $result = 1;
            }else{
                $result = (int)get_query_var('page');
            }
        }

        return $result;
    }

   
	
	function get_bg_image(){
            $pattern = explode( '.' , options::get_value( 'styling' , 'background' ) ) ; 
            if( isset( $pattern[ count( $pattern ) - 1 ] ) && $pattern[ count( $pattern ) - 1 ] == 'none'  || get_background_image() != '' ){
                $background_img = '';
            }else{
                $background_img_url = str_replace( 's.pattern.' , 'pattern.' , options::get_value( 'styling' , 'background' ) );
                if(strpos($background_img_url,'day') || strpos($background_img_url,'night')) { 
                    $background_img_url = str_replace( '.png' , '.jpg' , $background_img_url );  
                }
                $pieces = explode("/", $background_img_url);
                $background_img = $pieces[count($pieces) -1 ]; 	
            }
            
			/*if cookies are set we overite the settings*/ 
			if( isset($_COOKIE[ZIP_NAME."_bg_image"]) ){  
				$background_img = 'pattern.'.trim($_COOKIE[ZIP_NAME."_bg_image"].'.png');  
			}
			
			return $background_img;
	}
	
	function get_content_bg_color(){

            $background_color = options::get_value( 'styling' , 'background_color' );
            
			/*if cookies are set we ovewrite the settings*/
			if(isset($_COOKIE[ZIP_NAME."_content_bg_color"])){ 
				$background_color = trim($_COOKIE[ZIP_NAME."_content_bg_color"]); 
			}
			
			return $background_color;
	}
	
	function get_slide_resources(){

        $type_res = isset( $_POST['res_type'] ) ? trim( $_POST['res_type'] ) : exit;
        $field_id   = isset( $_POST['field_id'] ) ?  $_POST['field_id'] : exit;


        if(  $type_res == 'none' ){
            exit;
        }

        if(  $type_res == 'program' ){
            $data  = get__posts( array( 'post_type' =>  'conference' ,'numberposts' => -1) );

        }else{
            $data = get__posts( array( 'post_type' =>  $type_res,'numberposts' => -1 ) , false );
        }

        $result     = '';

        if( count( $data ) ){
            $result .= '<select id="' . $field_id . '" name="box[resources][]">';

            foreach( $data as $id => $value ){
                $result .= '<option value="' . $id . '">' . $value . '</option>';

            }

            $result .= '</select>';
        }else{

        }

        echo $result;
        exit;
    }

    function get_slide_resources_label(){
        $type_res = isset( $_POST['res_type'] ) ? trim( $_POST['res_type'] ) : exit;
		if(isset(resources::$box['slideshow']['box']['content']['resources']['multiple_label'][ $type_res ])){
			echo resources::$box['slideshow']['box']['content']['resources']['multiple_label'][ $type_res ];
		}
        exit;
    }

	function cosmo_avatar( $user_info, $size, $default = DEFAULT_AVATAR ) {
		
		$avatar = '';
        if( is_numeric( $user_info ) ){
            if( get_user_meta( $user_info , 'custom_avatar' , true ) == -1 ){
                $avatar = '<img src="' . $default . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
            }else{
                if(  get_user_meta( $user_info , 'custom_avatar' , true ) > 0 ){
                    $cusom_avatar = wp_get_attachment_image_src( get_user_meta( $user_info , 'custom_avatar' , true ) , array( $size , $size ) );
                    $avatar = '<img src="' . $cusom_avatar[0] . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                }else{
                    $avatar = get_avatar( $user_info , $size , $default = $default );
                }
            }
            
        }else{
            if( is_object( $user_info ) ){
                if( isset( $user_info -> user_id ) && is_numeric( $user_info -> user_id ) && $user_info -> user_id > 0 ){
                    if( get_user_meta( $user_info -> user_id , 'custom_avatar' , true ) == -1 ){
                        $avatar = '<img src="' . $default . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                    }else{
                        if( get_user_meta( $user_info -> user_id , 'custom_avatar' , true ) > 0 ){
                            $cusom_avatar = wp_get_attachment_image_src( get_user_meta( $user_info -> user_id , 'custom_avatar' , true ) , array( $size , $size ) );
                            $avatar = '<img src="' . $cusom_avatar[0] . '" height="' . $size . '" width="' . $size . '" alt="" class="photo avatar" />';
                        }else{
                            $avatar = get_avatar( $user_info , $size , $default = $default );
                        }
                    }
                }else{
                    $avatar = get_avatar( $user_info , $size , $default = $default );
                }
            }else{
                $avatar = get_avatar( $user_info , $size , $default = $default );
            }
        }
		
        return $avatar;
	}

    function get_ads($add_type){

        if( strlen( options::get_value( 'advertisement' , $add_type ) ) > 0 ){
    ?>
        <div class="row">
            <div class=" ads ">
                <?php echo options::get_value( 'advertisement' , $add_type ); ?>
            </div>
        </div>    
    <?php
        }

    }


    /*
        will look through '_content_menu' option and will return a list of bg images for each menu item
    */
    function front_page_bg_images(){
        $content_menu = get_option('_content_menu');

        if(is_array($content_menu) && sizeof($content_menu)){
        ?>
        <ul>
        <?php    
            $object_name = array(); /*empty array that will store object names, it will be used to avoid having same IDs*/ 
            foreach ($content_menu as $key => $content_settings) {

                    if(isset($content_settings['menu_label']) && strlen(trim($content_settings['menu_label']))){
                        $data_id = get_clean_id($content_settings['menu_label']);
                    }else{
                        $data_id = get_clean_id($content_settings['object_name']);    
                    }
                    
                    
                    if(in_array($data_id, $object_name) || !strlen( trim($data_id)) ){
                        $data_id = $data_id . '_' . $key; /*if this array already exists , we add the current index to it*/
                    }
                    $object_name[] = $data_id; /*append current ID to the array*/
                        $bg_styles = '';
                    if ($content_settings['object_type'] == 'slideshow') {
                        /*equeue scripts necessary for the slider*/
                        wp_enqueue_script( 'jquery-slitslider' , get_template_directory_uri() . '/js/jquery.slitslider.js' , array( 'jquery' ), false, true );
                        wp_enqueue_script( 'jquery-ba-cond' , get_template_directory_uri() . '/js/jquery.ba-cond.min.js' , array( 'jquery' ) );
                        
                        global $wp_version;
                        if($wp_version < 3.5){
                            wp_enqueue_script( 'jquery.plugins.min.js' , get_template_directory_uri() . '/js/jquery.plugins.min.js' , array( 'jquery' ), false, true  );    
                        }
                        
                        if($content_settings['auto_play'] == 'auto_play'){
                            $autoplay = true;
                        }else { $autoplay = false; }
                        wp_localize_script( 'jquery-slitslider', 'Slitslider_options', array(
                            // URL to wp-admin/admin-ajax.php to process the request
                            'autoplay'          => $autoplay,
                            'interval'          => $content_settings['slide_transition']*1000
                            )
                        );

                    }elseif($content_settings['object_type'] == 'page' || $content_settings['object_type'] == 'post'){
                        $bg_styles = "background-color: ".$content_settings['background_color']."; ";
                        if(strlen($content_settings['background_image'])){
                        
                            $bg_styles  .= "background-image: url('".$content_settings['background_image']."'); background-size: 100% 100%;";
                        } 
                    }else{
                        $bg_styles = "background-color: ".$content_settings['background_color']."; ";

                        if(strlen($content_settings['background_image'])){
                        
                            $bg_styles  .= "background-image: url('".$content_settings['background_image']."'); background-size: 100% 100%; ";
                        }  
                    }    
                    if( isset($content_settings['bg_object']) && strlen($content_settings['bg_object'])){
                        $bg_object = $content_settings['bg_object'];
                    }else{
                        $bg_object = '';
                    }
                    
        ?>
                <li data-id-bg="#ctn_<?php echo $data_id; ?>" style="<?php echo $bg_styles; ?>">
                    <?php if ($content_settings['object_type'] == 'slideshow') { ?>
                    <?php         
                        $args = array('post_type' => 'slideshow', 'post_status' => 'publish');
                        $slideshow = new WP_Query($args);
                        foreach ($slideshow->posts as $slide) {
                            if ($content_settings['object_name'] == $slide->post_title) {
                                 ?>

                                <div id="ctn_<?php echo 'slider_' . $data_id; ?>" class="sl-slider-wrapper">

                                    <div class="sl-slider">
                                        <?php         
                                        $meta_slide   = meta::get_meta( $slide->ID , 'box' );

                                        $slideshow_settings = meta::get_meta( $slide->ID, 'slidesettings' );
                                        
                                        $slideshow_source = 'none'; /*by default there is no source: the use must add slides manually*/
                                        if(isset($slideshow_settings['slideshowSource'])){
                                            $slideshow_source = $slideshow_settings['slideshowSource'];
                                        }

                                        if(isset($slideshow_settings['numberOfPosts'])){
                                            $numberOfPosts = $slideshow_settings['numberOfPosts'];
                                        }else{
                                            $numberOfPosts = 5; /*in case this value is not defined*/
                                        }
                                        $latest_slideshow_posts = array(); /*initialize an empty array where latest/featured posts/posrtfolios will be added*/

                                        switch ($slideshow_source) {
                                            case 'latest_posts':
                                                $query_args = array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => $numberOfPosts);
                                                
                                                break;
                                            
                                            case 'latest_portfolios':
                                                $query_args = array('post_type' => 'portfolio', 'post_status' => 'publish', 'posts_per_page' => $numberOfPosts);

                                                break;
                                            case 'featured_posts':
                                                $query_args = array(
                                                                    'post_type' => array( 'post'),
                                                                    'post_status' => 'publish',
                                                                    'posts_per_page' => $numberOfPosts,
                                                                    'meta_query' => array(
                                                                        array(
                                                                            'key' => 'nr_like',
                                                                            'value' => trim(options::get_value('likes', 'min_likes') ),
                                                                            'compare' => '>=',
                                                                            'type' => 'numeric',
                                                                        )
                                                                    )
                                                                );

                                                break;
                                            default:
                                                # code...
                                                break;
                                        }

                                        if(isset($query_args)){
                                            $latest_posts = new WP_Query( $query_args ); 
                                                
                                            if(isset($latest_posts -> posts) and sizeof($latest_posts -> posts)){
                                                foreach ($latest_posts -> posts as $post) {
                                                    /*add the post to the array*/
                                                    $latest_slideshow_posts[] = array('type_res' => 'post',
                                                                                      'resources' => $post -> ID,
                                                                                      'slide' => '',
                                                                                      'slide_id' => '',
                                                                                      'title' => '',
                                                                                      'title_color' => '',
                                                                                      'description' => '',
                                                                                      'description_color' => '',
                                                                                      );
                                                }
                                            }
                                        }

                                        if(!empty($latest_slideshow_posts)){

                                            if(!empty( $meta_slide ) && is_array( $meta_slide )){
                                                $meta_slide = array_merge($latest_slideshow_posts, $meta_slide);
                                            }else{
                                                $meta_slide = $latest_slideshow_posts;
                                            }

                                            
                                        }

                                        if( !( isset( $meta_slide ) && is_array( $meta_slide ) && count( $meta_slide ) ) ){
                                            return;   
                                        }


                                        if ( !empty( $meta_slide ) && is_array( $meta_slide ) && is_array( $slideshow_settings )  && count( $slideshow_settings ) ) {
                                            extract( $slideshow_settings );

                                            foreach ($meta_slide as $meta) { 
                                            
                                                if (isset( $meta[ 'type_res' ] ) && $meta['type_res'] == 'none') {
                                                ?>
                                                <div class="sl-slide" data-orientation="<?php echo $meta['animation_type']; ?>" data-slice1-rotation="<?php if($meta['animation_type'] == 'horizontal') { echo '-25'; } else { echo '10';}?>" data-slice2-rotation="<?php if($meta['animation_type'] == 'horizontal') { echo '-25'; } else { echo '-15';}?>" data-slice1-scale="<?php if($meta['animation_type'] == 'horizontal') { echo '2'; } else { echo '1.5';}?>" data-slice2-scale="<?php if($meta['animation_type'] == 'horizontal') { echo '2'; } else { echo '1.5';}?>">
                                                    <div class="sl-slide-inner">
                                                        <div class="bg-img" style="background: url('<?php echo $meta['slide']; ?>') no-repeat center center;"></div>
                                                        <?php if ($content_settings['slideshow_pattern'] == 'slideshow_pattern') {
                                                            echo '<div class="background_pattern '. $content_settings['select_pattern'] .'"></div>';
                                                        }?>
                                                        <h2 style="<?php if(strlen($meta['title_color'])!="") echo 'color:' .$meta['title_color']; ?>"><?php echo $meta['title']; ?></h2>
                                                        <span class="desc" style="<?php if(strlen($meta['description_color'])!="") echo 'color:' .$meta['description_color']; ?>"><p><?php echo $meta['description']; ?></p></span>
                                                    </div>
                                                </div>
                                                <?php   
                                                }elseif(isset( $meta[ 'type_res' ] ) && $meta['type_res'] == 'post'){ 
                                                    $sliderPostID = $meta[ 'resources' ];
                                                    $sliderPost = get_post( $sliderPostID );
                                                    //var_dump($sliderPost);
                                                    if( has_post_thumbnail( $sliderPostID ) ){
                                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $sliderPostID ), 'tlarge' );                                  
                                                    }else{$image[0]='';}                              
                                                ?>

                                                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                                                    <div class="sl-slide-inner">
                                                        <div class="bg-img" style="background: url('<?php if($image[0]!='') {echo $image[0];}elseif(strlen($meta['slide'])!="") { echo $meta['slide']; }else{} ?>') no-repeat;"></div>
                                                            <h2><?php echo $sliderPost -> post_title; ?></h2>
                                                            <span class="desc"><p><?php 
                                                                    if( strlen( $sliderPost -> post_content ) > 180 ){
                                                                        $description = mb_substr( strip_tags( strip_shortcodes( $sliderPost -> post_content ) ), 0, 180 ) . '..';
                                                                    }else{
                                                                        $description = strip_tags( strip_shortcodes( $sliderPost -> post_content ) );
                                                                    }
                                                                echo $description; ?></p>
                                                            </span>
                                                    </div>
                                                </div>

                                            <?php    }
                                            }
                                        }
                                        ?>
                                    
                                    </div><!-- /sl-slider -->

                                </div><!-- /slider-wrapper -->
                                 <?php
                                    }
                        }
                    ?>   
                <?php    } else {                                         
                                if ($content_settings['slideshow_pattern'] == 'slideshow_pattern') {
                                    echo '<div class="background_pattern '. $content_settings['select_pattern'] .'"></div>';
                                }
                            echo $bg_object; 
                     }
                    ?>
                </li>
        <?php
            }
        ?>
        </ul>
        <?php    
        }
    }

    /*returns the menus for the front end*/
    function front_page_menu_items($is_small_manu = false){
        $content_menu = get_option('_content_menu');


        if(is_front_page()){
            $is_trigger_hash =   true;
        }else{
            $is_trigger_hash =   false;
        }

        if($is_small_manu){
            $ul_id = 'small-menu-elements';
            $li_id = 's_menu_';
        }else{
            $ul_id = 'menuid';
            $li_id = 'menu_';
        }
        if(is_array($content_menu) && sizeof($content_menu)){
        ?>
        <ul id="<?php echo $ul_id ?>" <?php if(is_home()) { echo 'class="home_menu"'; } ?>>
        <?php
            $object_name = array(); /*empty array that will store object names, it will be used to avoid having same IDs*/ 
            $i = 0;    
            $default_selected_menu = get_option('default_selected_menu');
            if(is_array($default_selected_menu) && isset($default_selected_menu['id']) ){
                $selected_index = $default_selected_menu['id'];
            }else{
                $selected_index = 0; /*the first menu will be selected*/
            }


            foreach ($content_menu as $key => $content_settings) {

                    if(isset($content_settings['menu_label']) && strlen(trim($content_settings['menu_label']))){
                        $data_id = get_clean_id($content_settings['menu_label']);
                    }else{
                        $data_id = get_clean_id($content_settings['object_name']);    
                    }
                    
                
                    if(in_array($data_id, $object_name) || !strlen( trim($data_id)) ){
                        $data_id = $data_id . '_' . $key; /*if this array already exists , we add the current index to it*/
                    }
                    $object_name[] = $data_id; /*append current ID to the array*/
                    $active_class = ''; /* use the settings, add class 'active' if the current menu item is set as active */
                    
                    if($selected_index == $i){
                        if(is_home()  || is_front_page()) { $active_class = 'active'; }

                        /*localize initial hash variable*/
                        wp_localize_script( 'functions', 'location_hash', array(
                            'triger_hash'          => $is_trigger_hash,
                            'initial_hash'          => $data_id,
                            )
                        );
                    }


                if(isset($content_settings['menu_label']) &&  strlen( trim($content_settings['menu_label'])) ){
                    $the_menu_label = $content_settings['menu_label'];
                }else{
                    $the_menu_label = $content_settings['object_name'];        
                }        
                
        ?>
        <?php $home = home_url(); ?>

                <li><a id="<?php echo $li_id . $data_id; ?>" class="<?php echo $active_class; ?>" href="<?php if(!is_home()) echo $home;?>#<?php echo $data_id; ?>"><h3><?php echo $the_menu_label; ?></h3></a></li>
        <?php
                $i++;
            }
        ?>
        </ul>
        <?php    
        }

    }

    function get_frontend_post($post_id, $color){        /*POSTS*/
        global $wp_query;
        $wp_query = new WP_Query(array( 'post__in' => array($post_id) ) );

        global $post;
        if(isset($wp_query -> posts[0])) {
            $post = $wp_query -> posts[0];
        }else{
            $post = '';
        }
        if(count($wp_query -> posts)){
            the_post();
            get_template_part('single_content');
        }
        echo '<style type="text/css"> .post_' . $post_id .' { color:' . $color . '} </style>';
        wp_reset_query();
    }

    function get_frontend_page($page_id, $color){       /*PAGES*/
        global $wp_query;
        $wp_query = new WP_Query(array( 'page_id' => $page_id ) );
        global $post;
        if(count($wp_query -> posts)){
            the_post();
            $post = $wp_query -> posts[0];
            get_template_part('page_content');
        }
        echo '<style type="text/css"> .post_' . $page_id .' { color:' . $color . '} </style>';
        wp_reset_query();
    }

    function box_view($posts,  $width = 'three', $enable_masonry_class = '') {
        if($enable_masonry_class == 'enable_masonry'){
            $masonry_class = ' masonry ';  
            $masonry_elem_class = ' masonry_elem ';  
        }else{
            $masonry_class = '';
            $masonry_elem_class = '';
        }
        echo '<div class="row ">';
        foreach ($posts as $post) {
            $info_meta = meta::get_meta( $post -> ID , 'info' );
            $box_img_id = $info_meta['box_img_id'];
            if(isset($info_meta['background_color'])){
                $box_bg_color = $info_meta['background_color'];
            }else{
                $box_bg_color = ' #f5f5f5 ';
            }

            if(isset($info_meta['text_color']) && strlen(trim($info_meta['text_color']))){
                $box_text_color = $info_meta['text_color'];
            }else{
                $box_text_color = '  #000 ';
            }

            if(isset($info_meta['box_img']) && strlen(trim($info_meta['box_img'])) ){
                $box_img_src  = $info_meta['box_img'];
            }else{
                $box_img_src = '';
            }

            if( is_numeric( $box_img_id ) && $box_img_id > 0){
                $img = wp_get_attachment_image_src( $box_img_id, 'box_img' );
                $src = $img[ 0 ];
                $height =$img[2];
            }else{
                $img = '';
            }

            $link_start = '';
            $link_end = '';
            if(isset($info_meta['box_link']) && post::isValidURL($info_meta['box_link']) ){
                $link_start = '<a href="'.$info_meta['box_link'].'">';
                $link_end = '</a>';
            }

            $custom_class = '';
            if(isset($info_meta['custom_css']) && strlen(trim($info_meta['custom_css'])) ){
                $custom_class = $info_meta['custom_css'];
            }
            ?>
        <div class="cosmobox <?php echo $width .' columns  '.$custom_class; ?>">
            <div class="feature-box" style="color:#000;" onmouseover="jQuery(this).css({'background-color':'<?php echo $box_bg_color; ?>', 'color':'<?php echo $box_text_color; ?>'})" onmouseout="jQuery(this).css({'background-color':'#fff', 'color':'#000'})" >
                <h5><?php echo $link_start . $post -> post_title . $link_end; ?></h5>
                <div class="feature-box-image">
                    <?php
                    echo $link_start;
                    ?>
                    <?php if(strlen($box_img_src)){ ?>
                    <img src="<?php echo $src;?>"  alt="" />
                    <?php } ?>
                    
                    <?php
                    echo $link_end;
                    ?>
                </div>
                <p class="feature-content">
                    <?php echo $post -> post_content; ?>
                </p>
            </div>
        </div>

    <?php
        }
        echo '</div>';
    }

    function get_teams($teams, $width = 'three'){
        echo '<div class="row team-list ">';
        foreach ($teams as $team) {

            $default_meta = array(
                'img_id' => 0,
                'facebook' => '',
                'twitter' => '',
                'linkedin' => ''
            );
            $meta = meta::get_meta( $team -> ID, 'info' );
            foreach( $meta as $entry_key => $entry_value ){
                if( strlen( $entry_value ) ){
                    $default_meta[ $entry_key ] = $entry_value;
                }
            }

            extract( $default_meta );
            if( is_numeric( $img_id ) && $img_id > 0 ){
                $img = wp_get_attachment_image_src( $img_id, 'thumbnail' );
                $img = $img[ 0 ];
            }else{
                $img = get_template_directory_uri() . '/images/default_avatar_100.jpg';
            }
            if(isset($meta['img']) && strlen(trim($meta['img'])) ){
                $img_src  = $meta['img'];
            }else{
                $img_src = '';
            }            
            ?>
            <div class="<?php echo $width;?> columns">
                <div class="team-member">
                    <h4><?php echo $team -> post_title;?></h4>
                    <div class="team-image rounded">
                        <?php if(strlen($img_src)){ ?>
                        <img src="<?php echo $img;?>" alt="" />
                        <?php }else { ?>
                        <img src="<?php echo get_template_directory_uri() . '/images/default_avatar_100.jpg';?>" alt="" />
                        <?php } ?>
                        <div class="team-image-round"></div>
                    </div>
                    <div class="team-content st">
                        <?php echo $team -> post_content;?>
                    </div>
                    <?php if( strlen( $facebook ) || strlen( $twitter ) || strlen( $linkedin ) ){ ?>
                    <div class="team-social">
                        <ul>
                            <?php if( strlen( $twitter ) ){ ?>
                            <li>
                                <a href="http://twitter.com/<?php echo $twitter;?>" class="twitter"></a>
                            </li>
                            <?php } ?>
                            <?php if( strlen( $facebook ) ){ ?>
                            <li>
                                <a href="http://facebook.com/people/@/<?php echo $facebook;?>" class="fb"></a>
                            </li>
                            <?php } ?>
                            <?php if( strlen( $linkedin ) ){ ?>
                            <li>
                                <a href="<?php echo $linkedin;?>" class="linkedin"></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <?php 
        }
        echo '</div>';
    }

    /*returns the fontent for the front page*/
    function front_page_content(){
        $content_menu = get_option('_content_menu');

        if(is_array($content_menu) && sizeof($content_menu)){
        ?>
        
        <?php    
            $object_name = array(); /*empty array that will store object names, it will be used to avoid having same IDs*/ 
            foreach ($content_menu as $key => $content_settings) {

                    if(isset($content_settings['menu_label']) && strlen(trim($content_settings['menu_label']))){
                        $data_id = get_clean_id($content_settings['menu_label']);
                    }else{
                        $data_id = get_clean_id($content_settings['object_name']);    
                    }
                    

                    if(in_array($data_id, $object_name) || !strlen( trim($data_id)) ){
                        $data_id = $data_id . '_' . $key; /*if this array already exists , we add the current index to it*/
                    }
                    $object_name[] = $data_id; /*append current ID to the array*/
                
                /*default content initialization*/
                //$rendered_content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione illo laudantium culpa earum eos tenetur repellat laborum qui tempore quia ad vero rerum beatae fuga enim veritatis doloremque accusantium. Hic.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget lorem non diam porta aliquet dignissim quis sapien. Quisque erat felis, posuere in condimentum nec, viverra eget augue. Donec eu leo in felis adipiscing commodo vehicula sit amet urna. Curabitur sollicitudin, neque quis tincidunt lacinia, diam nisl dapibus erat, quis pretium mi ligula a eros.';

                $bg_color = ''; /*  */

                if( ($content_settings['object_type'] == 'page' || $content_settings['object_type'] == 'post') &&  strlen( trim($content_settings['content_background_color']) )){
                    $rgb = hex2rgb($content_settings['content_background_color']);
                    if(strlen($content_settings['bg_color_opacity'])){
                        $rgb = $rgb.' '. 0.01*(int)$content_settings['bg_color_opacity'];
                    }
                    $rgb = "background-color: rgba(".$rgb.") !important; ";
                    $bg_color = $rgb;
                    $text_color = $content_settings['text_color'];

                } 
                

                
                if( ($content_settings['object_type'] == 'page' || $content_settings['object_type'] == 'post') && strlen( trim($content_settings['content_background_color']) )){
                    $content_single_class = ' content-box-single';
                }else{
                    $content_single_class = '';
                }
            ?>
                <div class="content-box <?php if ($content_settings['object_type'] == 'slideshow') { echo 'isSlider'; } echo $content_single_class; ?> " id="ctn_<?php echo $data_id; ?>"  <?php if ($content_settings['object_type'] == 'slideshow') { echo 'data-slider="ctn_slider_' . $data_id .'"'; }?> >
                    <?php 
                        if( ($content_settings['object_type'] == 'page' || $content_settings['object_type'] == 'post') && strlen( trim($content_settings['content_background_color']) )){
                    ?>
                    <div class="page-inner-content" style="<?php echo $bg_color . '; color:'. $text_color ; ?>" >    
                    <?php

                        } 
                    ?>
                    <div class="scroll-this">    
                
            <?php   
            //var_dump($content_settings['object-id']);             
                switch ($content_settings['object_type']) {
                    case 'category':
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => 'post',
                            'category__in' => array( $content_settings['object-id'] ), 
                            'posts_per_page' => $content_settings['number_posts']
                        );
                        $query_options = decorate_wp_query_with_order( $query_options, $content_settings['order_by'], $content_settings['order'] );
                        $wp_query = new WP_Query( $query_options );
                        break;
                    case 'post_tag':
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => 'post',
                            'tag__in' => array( $content_settings['object-id'] ),
                            'posts_per_page' => $content_settings['number_posts']
                        );
                        $query_options = decorate_wp_query_with_order( $query_options, $content_settings['order_by'], $content_settings['order'] );
                        $wp_query = new WP_Query( $query_options );
                        break;
                    case 'portfolio-category':
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => 'portfolio',
                            'posts_per_page' => $content_settings['number_posts'],
                            'tax_query' => array(
                                //'relation' => 'AND',
                                
                                array(
                                    'taxonomy' => 'portfolio-category',
                                    'field' => 'id',
                                    'terms' => array( $content_settings['object-id'] ),
                                    'operator' => 'IN'
                                )
                            )
                        );
                        $query_options = decorate_wp_query_with_order( $query_options, $content_settings['order_by'], $content_settings['order'] );
                        $wp_query = new WP_Query( $query_options );

                        break;
                    case 'portfolio-tag':
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => 'portfolio',
                            'posts_per_page' => $content_settings['number_posts'],
                            'tax_query' => array(
                                //'relation' => 'AND',
                                
                                array(
                                    'taxonomy' => 'portfolio-tag',
                                    'field' => 'id',
                                    'terms' => array( $content_settings['object-id'] ),
                                    'operator' => 'IN'
                                )
                            )
                        );
                        $query_options = decorate_wp_query_with_order( $query_options, $content_settings['order_by'], $content_settings['order'] );
                        $wp_query = new WP_Query( $query_options );
                        break;
                    case 'testimonial-category':
                        if ( isset($content_settings['text_box']) && strlen(trim($content_settings['text_box']))) {
                            echo '<div class="twelve columns text_box">';
                            echo do_shortcode($content_settings['text_box']);
                            echo '</div>';
                        }                    
                
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => 'testimonial',
                            'posts_per_page' => $content_settings['number_posts'],
                            'tax_query' => array(
                                //'relation' => 'AND',
                                
                                array(
                                    'taxonomy' => 'testimonial-category',
                                    'field' => 'id',
                                    'terms' => array( $content_settings['object-id'] ),
                                    'operator' => 'IN'
                                )
                            )
                        );
                        $wp_query = new WP_Query( $query_options );
                        
                        get_testimonials($wp_query);
                        break;
                    case 'box-sets':
                        if ( isset($content_settings['text_box']) &&  strlen(trim($content_settings['text_box']))) {
                            echo '<div class="twelve columns text_box">';
                            echo do_shortcode($content_settings['text_box']);
                            echo '</div>';
                        }
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => 'box',
                            'posts_per_page' => $content_settings['number_posts'],
                            'tax_query' => array(
                                //'relation' => 'AND',
                                
                                array(
                                    'taxonomy' => 'box-sets',
                                    'field' => 'id',
                                    'terms' => array( $content_settings['object-id'] ),
                                    'operator' => 'IN'
                                )
                            )
                        );
                        $wp_query = new WP_Query( $query_options ); 

                        box_view($wp_query -> posts, columns_arabic_to_word($content_settings['number_of_columns']), $content_settings['enable_masonry']); 
                        break;
                    case 'team-group':
                        if ( isset($content_settings['text_box']) &&  strlen(trim($content_settings['text_box']))) {
                            echo '<div class="twelve columns text_box">';
                            echo do_shortcode($content_settings['text_box']);
                            echo '</div>';
                        }
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => 'team',
                            'posts_per_page' => $content_settings['number_posts'],
                            'tax_query' => array(
                                //'relation' => 'AND',
                                
                                array(
                                    'taxonomy' => 'team-group',
                                    'field' => 'id',
                                    'terms' => array( $content_settings['object-id'] ),
                                    'operator' => 'IN'
                                )
                            )
                        );
                        $wp_query = new WP_Query( $query_options ); 
                        get_teams($wp_query -> posts, columns_arabic_to_word($content_settings['number_of_columns'])); 
                        break;

                    case 'post_format':
                        $query_options = array(
                            'post_status' => 'publish',
                            'post_type' => array('post','portfolio'),
                            'posts_per_page' => $content_settings['number_posts'],
                        );
                        if($content_settings['object-id'] == 'latest_posts' || $content_settings['object-id'] == 'latest_portfolios'){
                            if($content_settings['object-id'] == 'latest_posts'){
                                $posttype = 'post';
                            }elseif($content_settings['object-id'] == 'latest_portfolios'){
                                $posttype = 'portfolio';
                            }

                            $query_options = array(
                                'post_status' => 'publish',
                                'post_type' => array($posttype),
                                'posts_per_page' => $content_settings['number_posts'],
                            );  
                        }elseif($content_settings['object-id'] != 'standard'){
                            $query_options['tax_query'] = array(
                                //'relation' => 'AND',
                                array(
                                    'taxonomy' => 'post_format',
                                    'field' => 'slug',
                                    'terms' => array( 'post-format-'.$content_settings['object-id'] )
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

                        $query_options = decorate_wp_query_with_order( $query_options, $content_settings['order_by'], $content_settings['order'] );
                        $wp_query = new WP_Query( $query_options );
//deb::e($wp_query);
                        break;    

                    case 'page':
                        get_frontend_page($content_settings['object-id'], $color = $content_settings['text_color'] );
                        break;
                    case 'post':
                        get_frontend_post($content_settings['object-id'], $color = $content_settings['text_color'] );
                        break;
                    case 'portfolio':
                            $wp_query = new WP_Query(array( 'post__in' => array($content_settings['object-id']), 'post_type' => $content_settings['object_type'] ) );
                            global $post;
                            if(isset($wp_query -> posts[0])) {
                                $post = $wp_query -> posts[0];
                            }else{
                                $post = '';
                            }
                            if(count($wp_query -> posts)){
                                //the_post();
                                get_template_part('single_content');
                            }
                            wp_reset_query();
                        break;    
                    default:
                        //$rendered_content = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione illo laudantium culpa earum eos tenetur repellat laborum qui tempore quia ad vero rerum beatae fuga enim veritatis doloremque accusantium. Hic.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eget lorem non diam porta aliquet dignissim quis sapien. Quisque erat felis, posuere in condimentum nec, viverra eget augue. Donec eu leo in felis adipiscing commodo vehicula sit amet urna. Curabitur sollicitudin, neque quis tincidunt lacinia, diam nisl dapibus erat, quis pretium mi ligula a eros.';
                        break;
                }   

                    $use_post_views = array('category','post_tag','portfolio-category','portfolio-tag','post_format');

                    //the following code will work only object type specified above
                    if(in_array($content_settings['object_type'], $use_post_views)){ 
                        $rnd = mt_rand(0,9999);

                        $masonry_class = '';
                        if($wp_query -> found_posts){
                            if(  ($content_settings['view_type'] == 'grid_view' || $content_settings['view_type'] == 'thumb_view') && $content_settings['enable_masonry']  == 'enable_masonry'){
                                $masonry_class = 'masonry';
                            }

                            $filter_container_class = '  ';
                            
                            $use_filter = false;
                            $filter_type = 'thumbs';
                            if( isset($content_settings['enable_filter']) && $content_settings['enable_filter'] == 'enable_filter' && $content_settings['view_type'] = 'thumb_view'){
                                $filter_type = mt_rand(0,3000);
                                $posts_terms = get_posts_terms($wp_query -> posts, $content_settings['filter_by'] );  
                                if(sizeof($posts_terms)){
                                    $use_filter = true;
                                    $masonry_class = ''; /*don't need massonry when we have filters */
                                    /*if we have filter we always use cropped images and will disable load more */
                                    $content_settings['enable_load_more'] = '';
                                    $content_settings['resize_method'] = 'crop';
                                } 

                                $filter_container_class = ' filter_container  thumbs-list-'.$rnd.' ';

                                echo get_filters($posts_terms , $filter_type = $filter_type, $title = '' , $data_id = $rnd); 
                            }


                            
                        ?>
                            <div id="div_<?php echo $rnd; ?>" style=" <?php if($content_settings['view_type'] == 'list_view') { echo 'color: ' .$content_settings['text_color']; } ?>" class="row <?php echo $filter_container_class;  echo $content_settings['view_type'] .' '. $masonry_class; ?>" data-columns="<?php echo $content_settings['number_columns']; ?>" data-id="<?php echo $rnd; ?>" >
                        <?php  
                            if ( isset($content_settings['text_box']) && strlen(trim($content_settings['text_box']))) {
                                echo '<div class="twelve columns text_box">';
                                echo do_shortcode($content_settings['text_box']);
                                echo '</div>';
                            }

                            $counter = 1; 

                            foreach ($wp_query -> posts as $post) {
                                $content_settings['use_filter'] = $use_filter;
                                $content_settings['filter_type'] = $filter_type;

                                call_user_func( array( 'post', $content_settings['view_type'] ), $post, $content_settings );
                                
                                if( !$use_filter && $content_settings['enable_masonry']  != 'enable_masonry' && $counter % $content_settings['number_columns'] == 0 
                                                && ($content_settings['view_type'] == 'grid_view' || $content_settings['view_type'] == 'thumb_view') ){
                                    echo '<div class="clear"></div>';
                                }
                                $counter++;
                            }
                        ?>
                            </div>
                        <?php if($content_settings['enable_load_more'] == 'enable_load_more' && $wp_query -> post_count < $wp_query -> found_posts){ ?>
                            
                            <div class="load-more" data-container_id="<?php echo $rnd; ?>" data-current_page="1" onclick="load_more(jQuery(this));">
                                <?php _e('Load more','cosmotheme'); ?>
                                <input type="hidden" value="<?php echo urlencode( json_encode( $content_settings ) ) ?>" id="settings_<?php echo $rnd; ?>" >
                            </div>
                        <?php } ?>    
                        <?php        
                        } 

                    }    
                    
        ?>
                        <?php //echo $rendered_content; ?>
                    </div>
                    <?php 
                        if( ($content_settings['object_type'] == 'page' || $content_settings['object_type'] == 'post') && strlen( trim($content_settings['content_background_color']) )){
                    ?>
                    </div>
                    <?php } ?>    
                </div>
        <?php
            }
        ?>
           
        <?php    
        }else{
            echo '<div class="no-content-msg">'. sprintf(__( ' Add please the front page content from %s here %s' , 'cosmotheme' ), '<a href="wp-admin/admin.php?page=cosmothemes___content_menu">','</a>') .'</div>'  ;
            
        }

    }

    function get_clean_id($word){
        if(1==2){ the_tags(); } /*does nothing, is never used*/
        $trash = array('!',',','.','*','[',']','(',')', "'", '"', '#', '\\', '/', '&', '^', '%', '@');

        $string = str_replace($trash, '', str_replace(' ', '_', strtolower(trim($word) )) );
        $string = preg_replace('/[^a-z0-9_ ]/i', '', $string); /*leave only english characters and digits*/
        return $string;
    }


    function columns_arabic_to_word( $arabic ){
        $words_full_width = array( 0 => 'twelve', 1 => 'twelve', 2 => 'six', 3 => 'four', 4 => 'three', 5 => 'three', 6 => 'two', 7 => 'two', 8 => 'one', 9 => 'one', 10 => 'one', 11 => 'one', 12 => 'one' );
        return $words_full_width[ $arabic ];
    }

    function hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       //$rgb = array($r, $g, $b);
       $rgb = $r.','. $g.','. $b.', ';

       //return implode(",", $rgb); // returns the rgb values separated by commas
       return $rgb; // returns an array with the rgb values
    }

    function get_social_icons(){
    ?>    
        <ul class="cosmo-social">
    <?php        
        $fb_id = options::get_value( 'social' , 'facebook' );
        if( strlen( trim( $fb_id ) ) ){
            ?>
            <li><a href="<?php echo 'http://facebook.com/people/@/'  . $fb_id ; ?>" target="_blank" class="fb hover-menu">&nbsp;</a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'twitter' ) ) ){
            ?>
            <li><a href="http://twitter.com/<?php echo options::get_value( 'social' , 'twitter' ) ?>" target="_blank" class="twitter hover-menu">&nbsp;</a></li>
            <?php
        }
        ?>
        <?php
        if( strlen( options::get_value( 'social' , 'gplus' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'gplus' ) ?>" target="_blank" class="gplus hover-menu">&nbsp;</a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'yahoo' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'yahoo' ) ?>" target="_blank" class="yahoo hover-menu">&nbsp;</a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'dribbble' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'dribbble' ) ?>" target="_blank" class="dribbble hover-menu">&nbsp;</a></li>
            <?php
        }
        if( strlen( options::get_value( 'social' , 'linkedin' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'linkedin' ) ?>" target="_blank" class="linkedin hover-menu">&nbsp;</a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'vimeo' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'vimeo' ) ?>" target="_blank" class="vimeo hover-menu">&nbsp;</a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'youtube' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'youtube' ) ?>" target="_blank" class="yt hover-menu">&nbsp;</a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'tumblr' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'tumblr' ) ?>" target="_blank" class="tumblr hover-menu">&nbsp;</a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'delicious' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'delicious' ) ?>" target="_blank" class="delicious hover-menu">&nbsp;</a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'flickr' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'flickr' ) ?>" target="_blank" class="flickr hover-menu">&nbsp;</a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'pinterest' ) ) ){
            ?>
            <li><a href="<?php echo options::get_value( 'social' , 'pinterest' ) ?>" target="_blank" class="pinterest hover-menu">&nbsp;</a></li>
            <?php
        }
        
        if( strlen( options::get_value( 'social' , 'skype' ) ) ){
            ?>
            <li><a href="skype:<?php echo options::get_value( 'social' , 'skype' ) ?>?call" target="_blank" class="skype hover-menu">&nbsp;</a></li>
            <?php
        }

        if( strlen( options::get_value( 'social' , 'email' ) ) ){
            ?>
            <li><a href="mailto:<?php echo options::get_value( 'social' , 'email' ); ?>" target="_blank" class="email hover-menu">&nbsp;</a></li>
            <?php
        }

        if( options::logic( 'social' , 'rss' ) ){
            ?>
            <li><a href="<?php bloginfo('rss2_url'); ?>" class="rss hover-menu">&nbsp;</a></li>
            <?php
        }
        ?>    
            </ul>
        <?php
        
    }

    function decorate_wp_query_with_order( $query, $order_by, $order ){
        if( 'date' == $order_by ){
            $query[ 'orderby' ] = 'date';
        }else if( 'comment_count' == $order_by ){
            $query[ 'orderby' ] = 'comment_count';
        }else if( 'like' == $order_by ){
            $query[ 'meta_key' ] = 'nr_like';
            $query[ 'orderby' ] = 'meta_value_num';
        }

        $query[ 'order' ] = $order;
        return $query;
    }

    /*returns an array of terms ID -> term_name*/
    function get_all_terms($term_slug){
        $args = array('hide_empty' => false);
        $terms = get_terms( $term_slug, $args );
        $terms_array = array();

        $terms_array['-1'] = __('-- slect value --','cosmotheme'); 
        foreach ($terms as $term) {
            $terms_array[$term -> term_id] = $term -> name;            
        }
        return $terms_array;
    }

    function get_posts_terms($posts, $filter_by_term){
        /**/
        $terms = array(); 
        foreach ($posts as $post) {

            if($post -> post_type == 'portfolio'){
                if($filter_by_term == 'post_tag'){
                    $filter_by = 'portfolio-tag' ;
                }elseif($filter_by_term == 'category'){
                    $filter_by = 'portfolio-category' ;
                }
            }else{
                $filter_by = $filter_by_term;
            }

            $post_terms =  wp_get_post_terms( $post -> ID, $filter_by );
            if(is_array($post_terms) && sizeof($post_terms)){

                foreach ($post_terms as $post_term) {
                    if(isset($post_term -> term_id)){
                        if(!array_key_exists ( $post_term -> term_id ,  $terms ) ){
                            $terms[$post_term -> term_id] = $filter_by;
                        }
                    }    
                }
                
            }
            
            //deb::e($post);
        }

        //var_dump($terms);

        return $terms;
    }


    function get_filters($terms , $filter_type = 'thumbs', $title = '', $data_id = ''){
        /*
            this function returns the filter by taxonomy 
            Params:
            $term - and array or terms  IDs => taxonomy
            $filter_type - we need that to have distinct data-value, to not affect other filters
        */

        $result = '';    

        if(strlen($data_id)){
            $data_id_attr = 'data-id="ul_'.$data_id.'"';
        }

        if(is_array($terms) && sizeof($terms)){
            $result .= $title;
            $result .= '<ul class="thumbs-splitter-'.$data_id.'" '.$data_id_attr.'>';
            $result .= '    <li class="segment-0 selected-0 selected">
                                <a href="#" rel="all" data-value="all">'.__('All','cosmotheme').'</a>
                            </li>';
            $i = 0;
            foreach ($terms as  $term_id => $taxonomy) {
                $i++;
                $term = get_term( $term_id, $taxonomy );
                
                $result .= '<li class="segment-'.$i.'">
                                <a href="#"  rel = "'.$term->slug.'-'.$filter_type.'" data-value="'.$term->slug.'-'.$filter_type.'">'.$term->name.'</a>
                            </li>';
            }
            $result .= '</ul>';
        }

        return $result;
    }

    function get_distinct_post_terms($post_id, $taxonomy, $return_names = false, $filter_type = '' ){
        /*
            Returns distinct taxonomies for a given post, or nothig if nothing found.
        */
        $ids = array();
        $names = '';

        $portfolios = wp_get_post_terms( $post_id , $taxonomy );

        if(is_array($portfolios)){
            foreach ($portfolios as $portfolio) {
                if(!in_array($portfolio->term_id, $ids) ){
                    $ids[] = $portfolio->term_id;

                    $names .= ' '.$portfolio->slug.'-'.$filter_type.' ';
                }
            }
        }

        if($return_names){
            return $names;
        }else{
            return $ids;    
        }
    }

?>