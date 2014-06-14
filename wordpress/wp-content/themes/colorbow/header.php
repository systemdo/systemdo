<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="robots"  content="index, follow" />
    
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>" /> 
    <?php if( is_single() || is_page() ){ ?>
        <meta property="og:title" content="<?php the_title() ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <meta property="og:url" content="<?php the_permalink() ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
        <?php 
            
            global $post;
            $src  = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'thumbnail' );
            echo '<meta property="og:image" content="'.$src[0].'"/>'; 
            echo ' <link rel="image_src" href="'.$src[0].'" / >';           
            wp_reset_query();   
        }else{ ?>
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:url" content="<?php echo home_url() ?>/"/>
            <meta property="og:type" content="blog"/>
            <meta property="og:locale" content="en_US"/>
            <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
            <meta property="og:image" content="<?php echo get_template_directory_uri()?>/fb_screenshot.png"/> 
    <?php
        }
        
    if(options::get_value( 'social' , 'facebook_app_id' ) != ''){
            ?><meta property='fb:app_id' content='<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>' />
    <?php
        }
    ?>

    <title><?php bloginfo('name'); ?> &raquo; <?php bloginfo('description'); ?><?php if ( is_single() ) { ?><?php } ?><?php wp_title(); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

    <?php
        if( strlen( options::get_value( 'styling' , 'favicon' ) ) ){
            $path_parts = pathinfo( options::get_value( 'styling' , 'favicon' ) );
            if( $path_parts['extension'] == 'ico' ){
    ?>
                <link rel="shortcut icon" href="<?php echo options::get_value( 'styling' , 'favicon' ); ?>" />
    <?php
            }else{
    ?>
                <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
            }
        }else{
    ?>
            <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
        }
    ?>

    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <!-- ststylesheet -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Bitter:400,700&amp;subset=latin,cyrillic' rel='stylesheet' type='text/css' />

    <?php if( options::get_value( 'styling' , 'logo_type' ) == 'text' ) { ?>
        <link href='http://fonts.googleapis.com/css?family=<?php  echo str_replace(' ' , '+' , trim( options::get_value( 'styling' , 'logo_font_family' ) ) );?>' rel='stylesheet' type='text/css' />
    <?php } ?>
    
    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
		
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="chrome=1">
        
        <?php 
            
            wp_enqueue_script( 'CFInstall' , "http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js" , array( 'jquery' ) ); 
            if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE ') && !strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 10')) {
                wp_enqueue_script( 'chrome_frame' , get_template_directory_uri() . '/js/jquery.chrome_frame.js' , array( 'jquery' ) ); 
            }
        ?>        
        <style>
            #chrome_msg { display:none; z-index: 999; position: fixed; top: 0; left: 0; background: #ece475; border: 2px solid #666; border-top: none; font: bold 11px Verdana, Geneva, Arial, Helvetica, sans-serif; line-height: 100%; width: 100%; text-align: center; padding: 5px 0; margin: 0 auto; }
            #chrome_msg a, #chrome_msg a:link { color: #a70101; text-decoration: none; }
            #chrome_msg a:hover { color: #a70101; text-decoration: underline; }
            #chrome_msg a#msg_hide { float: right; margin-right: 15px; cursor: pointer; }
            /* IE6 positioning fix */
            * html #chrome_msg { left: auto; margin: 0 auto; border-top: 2px solid #666;  }
        </style>
    <![endif]-->    
    

    <!--Custom CSS-->
    <?php if( strlen( options::get_value( 'custom_css' , 'css' ) )  > 0 ){ ?>
        <style type="text/css">
            <?php echo options::get_value( 'custom_css' , 'css' ); ?>    
        </style>

    <?php }  ?>

    <?php if( options::get_value( 'styling' , 'logo_type' ) == 'text' ) {
        $logo_font_family = explode('&',options::get_value('styling' , 'logo_font_family'));
        $logo_font_family = $logo_font_family[0];
        $logo_font_family = str_replace( '+',' ',$logo_font_family );
    ?>
        <style type="text/css">
            .branding a h1{
                font-family: '<?php echo $logo_font_family ?>', arial, serif !important;
                font-size: <?php echo options::get_value('styling' , 'logo_font_size')?>px;
                font-weight: <?php echo options::get_value('styling' , 'logo_font_weight')?>;
            }
            .small_logo a h3{
                font-family: '<?php echo $logo_font_family ?>', arial, serif !important;
                font-size: <?php echo options::get_value('styling' , 'logo_font_size')?>px;
                font-weight: <?php echo options::get_value('styling' , 'logo_font_weight')?>;
            }
        </style>
    <?php } ?>

    <?php wp_head(); ?> 
</head>

<?php
    $position   = '';
    $repeat     = '';
    $bgatt      = '';
    $background_color = '';

    if( is_single() || is_page() ){
        $settings = meta::get_meta( $post -> ID , 'settings' );
        if( ( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ) || ( isset( $settings['color'] ) && !empty( $settings['color'] ) ) ){
            if( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ){ 
                $background_img = "background-image: url('" . $settings['post_bg'] . "');";
            }

            if( isset( $settings['color'] ) && !empty( $settings['color'] ) ){
                $background_color = "background-color: " . $settings['color'] . "; ";
            }

            if( isset( $settings['position'] ) && !empty( $settings['position'] ) ){
                $position = 'background-position: '. $settings['position'] . ';';
            }
            if( isset( $settings['repeat'] ) && !empty( $settings['repeat'] ) ){
                $repeat = 'background-repeat: '. $settings['repeat'] . ';';
            }
            if( isset( $settings['attachment'] ) && !empty( $settings['attachment'] ) ){
                $bgatt = 'background-attachment: '. $settings['attachment'] . ';';
            }
        }else{
            if(get_background_image() == '' && get_bg_image() != ''){ 
                if(get_bg_image() != 'pattern.none.png'){
                    $background_img = 'background-image: url('.get_template_directory_uri().'/lib/images/pattern/'.get_bg_image().');';
                }else{
                    $background_img = '';
                }    
                /*if day or night images are set then we will add 'background-attachment:fixed'   */
                if(strpos(get_bg_image(),'.jpg')){
                    $background_img .= ' background-attachment:fixed';
                }
            }else{
                $background_img = '';
            }
            if(get_content_bg_color() != ''){
                $background_color = "background-color: " . get_content_bg_color() . "; ";
            }
        }
    }else{
        if(get_background_image() == '' && get_bg_image() != ''){
            if(get_bg_image() != 'pattern.none.png'){
                $background_img = 'background-image: url('.get_template_directory_uri().'/lib/images/pattern/'.get_bg_image().');';
            }else{
                $background_img = '';
            }    
            /*if day or night images are set then we will add 'background-attachment:fixed'   */
            if(strpos(get_bg_image(),'.jpg')){
                $background_img .= ' background-attachment:fixed;';
            }
        }else{
            $background_img = '';
        }
        if(get_content_bg_color() != ''){
            $background_color = "background-color: " . get_content_bg_color() . "; ";
        }

        if( strlen( get_background_image() ) ){
            $background_img = '';
        }

        if( strlen( get_background_color() ) ){
            $background_color = '';
        }
    }
?>
<body <?php body_class(); ?>  onload="hide_preloader()" style="<?php echo $background_color ; ?> <?php echo $background_img ; ?>  <?php echo $position; ?> <?php echo $repeat; ?> <?php echo $bgatt; ?>">
   
    <div id="body-preloader">
        <div></div>
        <div class="body-image-preloader"></div>
    </div>
    <!-- <div class="container boxed" id="page"> -->
        <div id="fb-root"></div>

    <div class="bgr">
        <?php if(is_front_page()) { front_page_bg_images(); }?>
    </div> 
    <div class="wrapper">
        <div class="single-fader <?php echo options::get_value( 'styling' , 'ajax_box_style' ); ?>"></div>
        <div class="sliders-navigator">
            <ul class="sliders-navigator-list">
            <?php
            $content_menu = get_option('_content_menu');
            if(is_array($content_menu) && sizeof($content_menu)) {
            foreach ($content_menu as $key => $content_settings) {
                if(isset($content_settings['menu_label']) && strlen(trim($content_settings['menu_label']))){
                    $data_id = get_clean_id($content_settings['menu_label']);
                }else{
                    $data_id = get_clean_id($content_settings['object_name']);    
                }
                
                if ($content_settings['object_type'] == 'slideshow'){ 
                        $args = array('post_type' => 'slideshow', 'post_status' => 'publish');
                        $slideshow = new WP_Query($args);
                        foreach ($slideshow->posts as $slide) {
                            if ($content_settings['object_name'] == $slide->post_title) {?>  
                                <li class="ctn_<?php echo 'slider_' . $data_id; ?>">
                                    <nav class="nav-arrows">
                                        <span class="nav-arrow-prev">Previous</span>
                                        <span class="nav-arrow-next">Next</span>
                                    </nav>
                                    <nav id="nav-dots" class="nav-dots">
                                        <?php         
                                        $meta_slide   = meta::get_meta( $slide->ID , 'box' );
                                        $slideshow_settings = meta::get_meta( $slide->ID, 'slidesettings' );

                                        $slideshow_source = 'none'; /*by default there is no source: the use must add slides manually*/
                                        if(isset($slideshow_settings['slideshowSource']) && isset($slideshow_settings['numberOfPosts'])){
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

                                        foreach ($meta_slide as $key => $meta) { ?>                                                                           
                                            <span <?php if($key == 0 ) echo 'class="nav-dot-current"'; ?> ></span>                                    
                                         <?php } 
                                        }
                                        ?> 
                                    </nav>   
                                </li>

                    <?php   }
                        }
                    }
                }
            } 
            ?>
            </ul>
        </div>  

        <div class="single-preloader <?php echo options::get_value( 'styling' , 'ajax_box_style' ); ?>">
            <div class="single-preloader-animation"></div>
        </div>
        <div class="single-container <?php echo options::get_value( 'styling' , 'ajax_box_style' ); ?>">
            <div class="single-div"></div>
        </div>
        
        <?php
            if( options::logic( 'general' , 'fb_comments' ) ){
                ?>
                <script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript" id="fb_script"></script>
                <?php
                
            }else{
        ?>  
                <script src="http://connect.facebook.net/en_US/all.js" type="text/javascript" id="fb_script"></script>  
        <?php   
            }
        ?> 
        
        <header id="header">
            <div class="relative tooltips_container">
                <?php
                    
                    $tooltips = options::get_value( '_tooltip' );
                        if( is_array( $tooltips ) && !empty( $tooltips ) ){
                            $tools = array();
                            foreach( $tooltips as $key => $tooltip ){
                                if( is_front_page()  && $tooltip['res_type'] == 'front_page' ){
                                    
                                    $location = 'front_page';
                                    $id = 0;
                                    $tools[] = $tooltip;
                                    
                                }
                                
                                if( is_single() && isset( $tooltip['res_type'] ) && $tooltip['res_type'] == 'single' && isset( $tooltip['res_posts'] ) && $tooltip['res_posts'] == $post -> ID ){
                                    $location = 'single';
                                    $id = $post -> ID ;
                                    $tools[] = $tooltip;
                                }
                                
                                if( is_page() && isset( $tooltip['res_type'] ) && $tooltip['res_type'] == 'page' && isset( $tooltip['res_pages'] ) && $tooltip['res_pages'] == $post -> ID ){
                                    $location = 'page';
                                    $id = $post -> ID ;
                                    $tools[] = $tooltip;
                                }
                            }
                            
                            if( isset( $location ) ){
                                if( ( isset( $_COOKIE[ ZIP_NAME . '_tour_closed_' . $location . '_' . $id ] ) && $_COOKIE[ ZIP_NAME . '_tour_closed_' . $location . '_' . $id ] != 'true' ) || !isset( $_COOKIE[ ZIP_NAME . '_tour_closed_' . $location . '_' . $id ] ) ){
                                    foreach( $tools as $key => $tool ){
                                        if( $key + 1 == count( $tools ) ){
                                            tools::tour( array( $tool['top'] , $tool['left'] ) , $location , $id , $tool['type'] , $tool['title'] , $tool['description'] , ( $key + 1 ) . '/' . count( $tools ) , false );
                                        }else{
                                            tools::tour( array( $tool['top'] , $tool['left'] ) , $location , $id , $tool['type'] , $tool['title'] , $tool['description'] , ( $key + 1 ) . '/' . count( $tools ) );
                                        }
                                    }
                                }
                            }
                        }
                ?>
            </div>
            
            <div class="small_logo <?php if(isset($_COOKIE["branding_cookie"]) && $_COOKIE["branding_cookie"] == 'icon-chevron-down') { echo ''; } else { echo 'hidden'; } ?> ">
            <?php 
                if(options::get_value( 'styling' , 'logo_type' ) == 'image' && options::get_value( 'styling' , 'small_logo_url' ) !=''){ ?>
                    <a href="<?php echo home_url(); ?>" class="hover">
                        <h3>
                            <img src="<?php echo options::get_value( 'styling' , 'small_logo_url' ); ?>" >
                        </h3>
                    </a>
            <?php }elseif (options::get_value( 'styling' , 'logo_type' ) == 'image' && options::get_value( 'styling' , 'small_logo_url' ) =='') { ?>
                <a href="<?php echo home_url(); ?>" class="hover">
                    <h3>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo_small.png" />
                    </h3>
                </a>
            <?php }elseif(options::get_value( 'styling' , 'logo_type' ) == 'text') { ?>
                    <a href="<?php echo home_url(); ?>" class="hover"><h3 class="the-logo"><?php bloginfo('name'); ?> <span><?php bloginfo('description'); ?></span></h3></a>
            <?php }
            ?>
            </div>
            <div class="branding <?php if(isset($_COOKIE["branding_cookie"]) && $_COOKIE["branding_cookie"] == 'icon-chevron-down') {echo 'hidden';} ?> ">
                <div class="row">
                    <div class="four columns"> 
                    <?php 
                        $top_separator = '';
                        if( options::get_value( 'styling' , 'logo_type' ) == 'text' ) { 
                            $top_separator = 'top-separator';
                    ?>
                            <a href="<?php echo home_url(); ?>" class="hover"><h1 class="the-logo"><?php bloginfo('name'); ?> <span><?php bloginfo('description'); ?></span></h1></a>
                    <?php }elseif(options::get_value( 'styling' , 'logo_type' ) == 'image' && options::get_value( 'styling' , 'logo_url' ) == '' ){ 
                    ?>
                            <a href="<?php echo home_url(); ?>" class="hover">
                                <h1>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" />
                                </h1>
                            </a>
                    <?php }else{?>
                            <a href="<?php echo home_url(); ?>" class="hover">
                                <h1>
                                    <img src="<?php echo options::get_value( 'styling' , 'logo_url' ); ?>" >
                                </h1>
                            </a>
                    <?php } ?>
                    </div>
                    <div class="eight columns"> 
                        <?php get_social_icons(); ?>
                    </div>        
                </div>
            </div>
            
            <div class="row">
                <div class="twelve columns">
                    <div id="modal-menu">
                        <?php front_page_menu_items($is_small_manu = true); ?>
                    </div>
                    <div id="small-device-nav">
                        <ul id="small-menuid">
                            <li class="small-device-menu"><a href="#modal-menu" class="small-device-menu-link"><i class="icon-reorder"></i></a></li>
                            <?php  
                                if(strlen(options::get_value( 'styling' , 'small_logo_url' ))){
                                    $the_small_logo_src = options::get_value( 'styling' , 'small_logo_url' ); 
                            
                                }else{
                                    $the_small_logo_src = get_template_directory_uri().'/images/logo_small.png';       
                                }
                            ?>
                            <li class="small-device-logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo $the_small_logo_src; ?>"/></a></li>
                        </ul>
                    </div>
                    <div id="nav">
                        <div id="collapse-branding-btn">
                            <i class="<?php if(isset($_COOKIE["branding_cookie"])) { echo $_COOKIE["branding_cookie"]; } else { echo 'icon-chevron-up'; }?> "></i>
                        </div>
                        <?php front_page_menu_items(); ?>
                    </div>
                </div>
            </div>

               
        </header>
