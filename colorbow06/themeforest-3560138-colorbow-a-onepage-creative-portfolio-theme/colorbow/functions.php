<?php
    define('_LIMIT_' , 10 );
    define('_AUTL_' , 7 );
    define('BLOCK_TITLE_LEN' , 50 );
    
    
	define('DEFAULT_AVATAR'   , get_template_directory_uri()."/images/default_avatar.jpg" );
	define('DEFAULT_AVATAR_100'   , get_template_directory_uri()."/images/default_avatar_100.jpg" );
	define('DEFAULT_AVATAR_LOGIN'   , get_template_directory_uri()."/images/default_avatar_login.png" );
    define( '_TN_'      , wp_get_theme() );
    
	define('BRAND'      , '' );
	define('ZIP_NAME'   , 'onepage' );


    add_action('admin_bar_menu', 'de_cosmotheme');
    
	include 'lib/php/main.php';

    
    
    include 'lib/php/actions.register.php';
    include 'lib/php/menu.register.php';
	
	$content_width = 600;
  
    if( function_exists( 'add_theme_support' ) ){ 
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
    }

    image::add_size();

    add_theme_support( 'custom-background' );
    
	add_theme_support( 'post-formats' , array( 'image' , 'video' , 'audio', 'gallery','link' ) );
	add_editor_style('editor-style.css');
	
	

    /* Localization */
    load_theme_textdomain( 'cosmotheme' );
    load_theme_textdomain( 'cosmotheme' , get_template_directory() . '/languages' );
    
    if ( function_exists( 'load_child_theme_textdomain' ) ){
        load_child_theme_textdomain( 'cosmotheme' );
    }

	function remove_post_format_fields() {
		remove_meta_box( 'formatdiv' , 'post' , 'side' ); 
		remove_meta_box( 'formatdiv' , 'portfolio' , 'side' ); 
	}
	add_action( 'admin_menu' , 'remove_post_format_fields' );
    
	if(is_admin() && ini_get('allow_url_fopen') == '1'){
		/*New version check*/	
		if( options::logic( 'cosmothemes' , 'show_new_version' ) ){
			function versionNotify(){
				echo api_call::compareVersions(); 
			}
		
			// Add hook for admin <head></head>
			add_action('admin_head', 'versionNotify');
		}

		/*Cosmo news*/
		if( options::logic( 'cosmothemes' , 'show_cosmo_news' ) && !isset($_GET['post_id'])  && !isset($_GET['post'])){
			function doCosmoNews(){
				echo api_call::getCosmoNews(); 
			}
		
			// Add hook for admin <head></head>
			add_action('admin_head', 'doCosmoNews');
		}	
	}

  
    /* Cosmothemes Backend link */
    function de_cosmotheme() {
        global $wp_admin_bar;    
        if ( !is_super_admin() || !is_admin_bar_showing() ){
            return;
        }
        $wp_admin_bar -> add_menu( array(
            'id' => 'cosmothemes',
            'parent' => '',
            'title' => _TN_,
            'href' => admin_url( 'admin.php?page=cosmothemes__general' )
            ) );   
    }

	add_filter('excerpt_length', 'cosmo_excerpt_length');
	function cosmo_excerpt_length($length) {
		return 70;  /* Or whatever you want the length to be. */
	}

    
	if( !options::logic( 'general' , 'show_admin_bar' ) ){
		add_filter( 'show_admin_bar', '__return_false' );
	}


	add_editor_style('editor-style.css');
	
	get_template_part( '/videojs/video-js' ); 


	function load_css() {
		if(!is_admin()){
			$files = scandir( get_template_directory()."/css/autoinclude" );
			foreach( $files as $file ){
				if( is_file( get_template_directory()."/css/autoinclude/$file" ) ){
					wp_register_style( $file.'-style',get_template_directory_uri() . '/css/autoinclude/'.$file );
					wp_enqueue_style( $file.'-style' );
				}
			}

			wp_register_style( 'shortcode',get_template_directory_uri() . '/lib/css/shortcode.css' );
			wp_enqueue_style( 'shortcode' );
			if(options::logic( 'general' , 'enb_lightbox' ) ){
				wp_register_style( 'prettyPhoto',get_template_directory_uri() . '/css/prettyPhoto.css' );
				wp_enqueue_style( 'prettyPhoto' );
			}

			//wp_enqueue_script( 'foundation' , get_template_directory_uri() . '/js/foundation.js' , array( 'jquery' ) );
			wp_enqueue_script( 'mosaic' , get_template_directory_uri() . '/js/jquery.mosaic.1.0.1.min.js' , array( 'jquery' ) );
			//wp_enqueue_script( 'superfish' , get_template_directory_uri() . '/js/jquery.superfish.js' , array( 'jquery' ) );
			//wp_enqueue_script( 'supersubs' , get_template_directory_uri() . '/js/jquery.supersubs.js' , array( 'jquery' ) );
			//wp_enqueue_script( 'jquery-ui-accordion' );
			wp_enqueue_script( 'tabs' , get_template_directory_uri() . '/js/jquery.tabs.pack.js' , array( 'jquery' ) );
			// wp_enqueue_script( 'scrollto' , get_template_directory_uri() . '/js/jquery.scrollTo-1.4.2-min.js' , array( 'jquery' ) );
			wp_enqueue_script( 'jquery-easing' , get_template_directory_uri() . '/js/jquery.easing.1.3.js' , array( 'jquery' ) );
			wp_enqueue_script( 'jquery-hashchange' , get_template_directory_uri() . '/js/jquery.ba-hashchange.min.js' , array( 'jquery' ) );
			wp_enqueue_script( 'modernizr' , get_template_directory_uri() . '/js/modernizr.custom.79639.js' , array( 'jquery' ) );		
			

			wp_enqueue_script( 'mousewheel' , get_template_directory_uri() . '/js/jquery.mousewheel.min.js' , array( 'jquery' ), false, true  );

			wp_enqueue_script( 'jscrollpane' , get_template_directory_uri() . '/js/jquery.jscrollpane.min.js' , array( 'jquery' ), false, true  );
			wp_enqueue_script( 'mwheelIntent' , get_template_directory_uri() . '/js/mwheelIntent.js' , array( 'jquery' ), false, true  );
			
			//wp_enqueue_script( 'jquery_ui' , get_template_directory_uri() . '/js/jquery-ui-1.9.1.custom.min.js' , array( 'jquery' ), false, true  );
			wp_enqueue_script( 'pageslide' , get_template_directory_uri() . '/js/jquery.pageslide.min.js' , array( 'jquery' ), false, true  );
			wp_enqueue_script( 'quicksand' , get_template_directory_uri() . '/js/jquery.quicksand.js' , array( 'jquery' ) , false, true );
			wp_enqueue_script( 'functions' , get_template_directory_uri() . '/js/functions.js' , array(  'jscrollpane', 'mwheelIntent', 'jquery' , 'tabs' ,'jquery-easing','mousewheel' ), false, true );
			wp_enqueue_script( 'jquery-cookie' , get_template_directory_uri() . '/js/jquery.cookie.js' , array( 'jquery' ) );
			wp_enqueue_script( 'freetile' , get_template_directory_uri() . '/js/jquery.freetile.min.js' , array( 'jquery' ) );
			
			wp_enqueue_script( 'actions' , get_template_directory_uri() . '/lib/js/actions.js' , array( 'jquery' ), false, true );

			if(options::logic( 'general' , 'enb_lightbox' )){
				$enb_lightbox = true;
				wp_enqueue_script( 'prettyPhoto' , get_template_directory_uri() . '/js/jquery.prettyPhoto.js' , array( 'jquery' ) );
			} else { $enb_lightbox = false; }
	        wp_localize_script( 'functions', 'prettyPhoto_enb', array(
                'enb_lightbox'          => $enb_lightbox
                )
            );

			wp_enqueue_script( "comment-reply" );
		}
	}
	
	add_post_type_support( 'portfolio', 'post-formats' );

	add_action('wp_enqueue_scripts', 'load_css');

	/*if standard WP comments are used we want to  use ajaxified commetns*/
	if( !options::logic( 'general' , 'fb_comments' ) ){ 
		get_template_part( '/wp-comment-master/wp-comment-master' ); /*ajax comments*/	
	}

	/*include portfolio post type in archive pages*/
	function namespace_add_custom_types( $query ) {
	  if( is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
	    $query->set( 'post_type', array(
	     'post', 'portfolio'
			));
		  return $query;
		}
	}
	if(!is_admin()){
		add_filter( 'pre_get_posts', 'namespace_add_custom_types' );	
	}
	
?>