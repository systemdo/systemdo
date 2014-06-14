<?php
    /* register pages */
	
	$current_theme_name = wp_get_theme();
    
    options::$menu['cosmothemes']['general']            = array( 'label' => __( 'General' , 'cosmotheme' ) , 'title' => __( 'General settings' , 'cosmotheme' ) , 'description' => __( 'General page description.' , 'cosmotheme' ) , 'type' => 'main' , 'main_label' => $current_theme_name );
    options::$menu['cosmothemes']['_content_menu']      = array( 'label' => __( 'Front page builder' , 'cosmotheme' )  , 'title' => __( 'Content menu manager' , 'cosmotheme' )  , 'description' => __( 'Content menu builder.' , 'cosmotheme' ) , 'update' => false );
    
    options::$menu['cosmothemes']['layout']             = array( 'label' => __( 'Layout' , 'cosmotheme' )  , 'title' => __( 'Layout page settings' , 'cosmotheme' )  , 'description' => __( 'Layout page description.' , 'cosmotheme' ) );
    options::$menu['cosmothemes']['styling']            = array( 'label' => __( 'Styling' , 'cosmotheme' )  , 'title' => __( 'Styling settings' , 'cosmotheme' )  , 'description' => __( 'Styling page description.' , 'cosmotheme' ) );
    //options::$menu['cosmothemes']['menu']               = array( 'label' => __( 'Menus' , 'cosmotheme' )  , 'title' => __( 'Menu settings' , 'cosmotheme' )  , 'description' => __( 'Menu page description.' , 'cosmotheme' ) );
    options::$menu['cosmothemes']['blog_post']          = array( 'label' => __( 'Blogging' , 'cosmotheme' )  , 'title' => __( 'Blog post settings' , 'cosmotheme' )  , 'description' => __( 'Blog post page description.' , 'cosmotheme' ) );
    //options::$menu['cosmothemes']['advertisement']      = array( 'label' => __( 'Advertisement' , 'cosmotheme' )  , 'title' => __( 'Advertisement spaces' , 'cosmotheme' )  , 'description' => __( 'Sidebar manager page description.' , 'cosmotheme' ) );
    options::$menu['cosmothemes']['social']             = array( 'label' => __( 'Social networks' , 'cosmotheme' )  , 'title' => __( 'Social network settings' , 'cosmotheme' )  , 'description' => __( 'Social page description.' , 'cosmotheme' ) );
    options::$menu['cosmothemes']['_sidebar']           = array( 'label' => __( 'Sidebars' , 'cosmotheme' )  , 'title' => __( 'Sidebar manager' , 'cosmotheme' )  , 'description' => __( 'Sidebar manager page description.' , 'cosmotheme' ) , 'update' => false );
    options::$menu['cosmothemes']['_tooltip']           = array( 'label' => __( 'Tooltips' , 'cosmotheme' )  , 'title' => __( 'Tooltips manager' , 'cosmotheme' )  , 'description' => __( 'Tooltips manager page description.' , 'cosmotheme' ) , 'update' => false );
    options::$menu['cosmothemes']['custom_css']         = array( 'label' => __( 'Custom CSS' , 'cosmotheme' )  , 'title' => __( 'Custom CSS' , 'cosmotheme' )  , 'description' => __( 'Custom CSS' , 'cosmotheme' ) , 'update' => true );
	options::$menu['cosmothemes']['cosmothemes']        = array( 'label' => __( 'CosmoThemes' , 'cosmotheme' )  , 'title' => __( 'CosmoThemes' , 'cosmotheme' )  , 'description' => __( 'CosmoThemes notifications.' , 'cosmotheme' ) );
    options::$menu['cosmothemes']['io']                 = array( 'label' => __( 'Import / Export' , 'cosmotheme' )  , 'title' => __( 'Import/Export' , 'cosmotheme' )  , 'description' => __( 'Import and export settings' , 'cosmotheme' ) );
   
    /* OPTIONS */
    /* GENERAL DEFAULT VALUE */
    options::$default['general']['enb_likes']           = 'yes';
    options::$default['general']['min_likes']           =  50;
    options::$default['general']['enb_featured']        = 'yes';
    options::$default['general']['enb_lightbox']        = 'yes';
    options::$default['general']['meta']                = 'yes';
    options::$default['general']['time']                = 'yes';
    options::$default['general']['fb_comments']         = 'yes';
	options::$default['general']['show_admin_bar']      = 'no';
    options::$default['general']['vote_icons']          = 'icon-thumbs-up';
    

    /* GENERAL OPTIONS */
	options::$fields['general']['enb_likes']            = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable Likes for posts' , 'cosmotheme') , 'action' => "act.check( this , { 'yes' : '.g_like , .g_l_register', '.vote_icons' , 'no' : '' } , 'sh' );" , 'iclasses' => 'g_e_likes');
    options::$fields['general'][ 'vote_icons' ]            = array(
        'type' => 'st--preview-select', 'value' => array(
            'icon-heart' => __( 'Heart', 'cosmotheme' ),
            'icon-star' => __( 'Star', 'cosmotheme' ),
            'icon-thumbs-up' => __( 'Thumb', 'cosmotheme' )
        ),
        'classes' => 'vote_icons',
        'label' => __( 'Icon style for likes', 'cosmotheme' ),
        'action' => 'act.preview_select( this );',
        'hint' => __( 'You may choose between a heart, a star or a thumb up for "like it" icon','cosmotheme' )
    );
	options::$fields['general']['min_likes']            = array( 'type' => 'st--digit-like' , 'label' => __( 'Minimum number of Likes to set Featured' , 'cosmotheme' ) , 'hint' => __( 'Set minimum number of post likes to change it into a featured post' , 'cosmotheme' ) , 'id' => 'nr_min_likes' ,'action' => "act.min_likes(  jQuery( '#nr_min_likes').val() , 1 );"  );
	options::$fields['general']['sim_likes']            = array( 'type' => 'st--button' , 'value' => __( 'Generate' , 'cosmotheme' ) , 'label' => __( 'Generate random number of Likes for posts' , 'cosmotheme' ) , 'action' => "act.sim_likes( 1 );" , 'hint' => __( 'WARNING! This will reset all current Likes.' , 'cosmotheme' ) );
	options::$fields['general']['reset_likes']			= array( 'type' => 'st--button' , 'value' => __( 'Reset' , 'cosmotheme' ) , 'label' => __( 'Reset likes' , 'cosmotheme' ) , 'action' =>"act.reset_likes(1);" , 'hint' => __( 'WARNING! This will reset all the likes for all the posts!', 'cosmotheme'  ) );
    
    if( options::logic( 'general' , 'enb_likes' ) ){
        options::$fields['general']['min_likes']['classes']     = 'g_like';
        options::$fields['general']['sim_likes']['classes']     = 'g_like generate_likes';
		options::$fields['general']['reset_likes']['classes']	= 'g_like reset_likes';
    }else{
        options::$fields['general']['min_likes']['classes']     = 'g_like hidden';
        options::$fields['general']['sim_likes']['classes']     = 'g_like generate_likes hidden';
		options::$fields['general']['reset_likes']['classes']	= 'g_like reset_likes hidden';
    }

    options::$fields['general']['enb_featured']         = array('type' => 'st--logic-radio' , 'label' => __( 'Display featured image inside the post' , 'cosmotheme' ) , 'hint' => __( 'If enabled featured images will be displayed both on category and post page' , 'cosmotheme' ) );
    options::$fields['general']['enb_lightbox']         = array('type' => 'st--logic-radio' , 'label' => __( 'Enable pretty-photo ligthbox' , 'cosmotheme' ) , 'hint' => __( 'Images inside posts will open inside a fancy lightbox' , 'cosmotheme' ) );
    options::$fields['general']['meta']                 = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show entry meta' , 'cosmotheme' ) , 'hint' => __( ' In blog / archive / search / tag / category page' , 'cosmotheme' ), 'action' => "act.check( this , { 'yes' : '.meta_view ' , 'no' : '' } , 'sh' );" );
	$meta_view_type = array('horizontal' => __('Horizontal','cosmotheme'), 'vertical' => __('Vertical','cosmotheme') );  
	options::$fields['general']['time']                 = array( 'type' => 'st--logic-radio' , 'label' => __( 'Use human time' , 'cosmotheme') ,  'hint' => __( 'If set No will use WordPress time format'  , 'cosmotheme' ) );
    options::$fields['general']['fb_comments']          = array( 'type' => 'st--logic-radio' , 'label' => __( 'Use Facebook comments' , 'cosmotheme' ), 'action' => "act.check( this , { 'yes' : '.fb_app_id ' , 'no' : '' } , 'sh' );" );
	options::$fields['general']['fb_app_id_note']       = array( 'type' => 'st--hint' , 'value' => __( 'You can set Facebook application ID' , 'cosmotheme' ) . ' <a href="admin.php?page=cosmothemes__social">' . __( 'here' , 'cosmotheme') . '</a> ' );
	options::$fields['general']['show_admin_bar']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show WordPress admin bar' , 'cosmotheme' ));

	
	if( options::logic( 'general' , 'fb_comments' ) ){
        options::$fields['general']['fb_app_id_note']['classes']     = 'fb_app_id';
    }else{
        options::$fields['general']['fb_app_id_note']['classes']     = 'fb_app_id hidden';
    }

    options::$fields['general']['tracking_code']        = array('type' => 'st--textarea' , 'label' => __( 'Tracking code' , 'cosmotheme' ) , 'hint' => __( 'Paste your Google Analytics or other tracking code here.<br />It will be added into the footer of this theme' , 'cosmotheme' ) );
    options::$fields['general']['copy_right']   	    = array('type' => 'st--textarea' , 'label' => __( 'Copyright text' , 'cosmotheme' ) , 'hint' => __( 'Type here the Copyright text that will appear in the footer.<br />To display the current year use "%year%"' , 'cosmotheme' ) );
    
    options::$default['general']['copy_right'] 			= 'Copyright &copy; %year% <a href="http://cosmothemes.com" target="_blank">CosmoThemes</a>. All rights reserved.';


    /* LAYOUT DEFAULT VALUE */
    options::$default['layout']['404']                  = 'right';
    options::$default['layout']['author']               = 'right';
    options::$default['layout']['page']                 = 'full';
    options::$default['layout']['single']               = 'right';
    options::$default['layout']['blog_page']            = 'right';
    
    options::$default['layout']['search']               = 'right';
    options::$default['layout']['archive']              = 'right';
    options::$default['layout']['category']             = 'right';
    options::$default['layout']['tag']                  = 'right';
    options::$default['layout']['attachment']           = 'right';

    /* LAYOUT OPTIONS */
    $layouts                                            = array('left' => __( 'Left sidebar' , 'cosmotheme' ) , 'right' => __( 'Right sidebar' , 'cosmotheme' ) , 'full' => __( 'Full width' , 'cosmotheme' ) );
    $view                                               = array('yes' => __( 'List view' , 'cosmotheme' ) , 'no' => __( 'Grid view' , 'cosmotheme' ) ); /* yes - list view , no - grid view */
    $sidebars_record = options::get_value( '_sidebar' );
    if( !is_array( $sidebars_record ) || empty( $sidebars_record ) ){
        $sidebar = array( '' => 'main' );
    }else{
        foreach( $sidebars_record as $sidebars ){
            $sidebar[ trim( strtolower( str_replace( ' ' , '-' , $sidebars['title'] ) ) ) ] = $sidebars['title'];
        }
        $sidebar[''] = 'main';
    }


    options::$fields['layout']['title1']                = array('type' => 'ni--title' , 'title' => __( '404' , 'cosmotheme' ) );
    options::$fields['layout']['404']                   = array('type' => 'st--select' , 'label' => __( 'Layout for 404 page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.layout_404' , { 'left' : '.sidebar_404' , 'right' : '.sidebar_404' } , 'sh_' )" , 'iclasses' => 'layout_404'  );
    options::$fields['layout']['404_sidebar']           = array('type' => 'st--select' , 'label' => __( 'Select sidebar for 404 template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'sidebar_404' );
    if( options::get_value( 'layout' , '404' ) == 'full' ){
        options::$fields['layout']['404_sidebar']['classes'] = 'sidebar_404 hidden';
    }
    options::$fields['layout']['title2']                = array('type' => 'ni--title' , 'title' => __( 'Author' , 'cosmotheme' ) );
    options::$fields['layout']['author']                = array('type' => 'st--select' , 'label' => __( 'Layout for author page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.author_layout' , { 'left' : '.author_sidebar' , 'right' : '.author_sidebar' } , 'sh_' )" , 'iclasses' => 'author_layout' );
    options::$fields['layout']['author_sidebar']        = array('type' => 'st--select' , 'label' => __( 'Select sidebar for author template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'author_sidebar' );
    if( options::get_value( 'layout' , 'author' ) == 'full' ){
        options::$fields['layout']['author_sidebar']['classes'] = 'author_sidebar hidden';
    }
    options::$fields['layout']['title3']                = array('type' => 'ni--title' , 'title' => __( 'Pages / single post' , 'cosmotheme' ) );
    options::$fields['layout']['page']                  = array('type' => 'st--select' , 'label' => __( 'Layout for pages' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.page_layout' , { 'left' : '.page_sidebar' , 'right' : '.page_sidebar' } , 'sh_' )" , 'iclasses' => 'page_layout' );
    options::$fields['layout']['page_sidebar']          = array('type' => 'st--select' , 'label' => __( 'Select sidebar for page template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'page_sidebar' );
    if( options::get_value( 'layout' , 'page' ) == 'full' ){
        options::$fields['layout']['page_sidebar']['classes'] = 'page_sidebar hidden';
    }
    options::$fields['layout']['single']                = array('type' => 'st--select' , 'label' => __( 'Layout for single post' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.single_layout' , { 'left' : '.single_sidebar' , 'right' : '.single_sidebar' } , 'sh_' )" , 'iclasses' => 'single_layout' );
    options::$fields['layout']['single_sidebar']        = array('type' => 'st--select' , 'label' => __( 'Select sidebar for single page template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'single_sidebar' );
    if( options::get_value( 'layout' , 'single' ) == 'full' ){
        options::$fields['layout']['single_sidebar']['classes'] = 'single_sidebar hidden';
    }
    options::$fields['layout']['title13']               = array('type' => 'ni--title' , 'title' => __( 'Blog page' , 'cosmotheme' ) );
    options::$fields['layout']['blog_page']             = array('type' => 'st--select' , 'label' => __( 'Layout for blog page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.blog_page_layout' , { 'left' : '.blog_page_sidebar' , 'right' : '.blog_page_sidebar' } , 'sh_' )" , 'iclasses' => 'blog_page_layout' );
    options::$fields['layout']['blog_page_sidebar']     = array('type' => 'st--select' , 'label' => __( 'Select sidebar for blog page template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'blog_page_sidebar' );
    if( options::get_value( 'layout' , 'blog_page' ) == 'full' ){
        options::$fields['layout']['blog_page_sidebar']['classes'] = 'blog_page_sidebar hidden';
    }
    
    options::$fields['layout']['title4']                = array('type' => 'ni--title' , 'title' => __( 'Search' , 'cosmotheme' ) );
    options::$fields['layout']['search']                = array('type' => 'st--select' , 'label' => __( 'Layout for search page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.search_layout' , { 'left' : '.search_sidebar' , 'right' : '.search_sidebar' } , 'sh_' )" , 'iclasses' => 'search_layout' );
    options::$fields['layout']['search_sidebar']        = array('type' => 'st--select' , 'label' => __( 'Select sidebar for search template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'search_sidebar' );
    if( options::get_value( 'layout' , 'search' ) == 'full' ){
        options::$fields['layout']['search_sidebar']['classes'] = 'search_sidebar hidden';
    }
    options::$fields['layout']['title5']                = array('type' => 'ni--title' , 'title' => __( 'Archive' , 'cosmotheme' ) );
    options::$fields['layout']['archive']               = array('type' => 'st--select' , 'label' => __( 'Layout for archive page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.archive_layout' , { 'left' : '.archive_sidebar' , 'right' : '.archive_sidebar' } , 'sh_' )" , 'iclasses' => 'archive_layout' );
    options::$fields['layout']['archive_sidebar']       = array('type' => 'st--select' , 'label' => __( 'Select sidebar for archive template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'archive_sidebar' );
    if( options::get_value( 'layout' , 'archive' ) == 'full' ){
        options::$fields['layout']['archive_sidebar']['classes'] = 'archive_sidebar hidden';
    }
    options::$fields['layout']['title6']                = array('type' => 'ni--title' , 'title' => __( 'Category' , 'cosmotheme' ) );
    options::$fields['layout']['category']              = array('type' => 'st--select' , 'label' => __( 'Layout for category page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.category_layout' , { 'left' : '.category_sidebar' , 'right' : '.category_sidebar' } , 'sh_' )" , 'iclasses' => 'category_layout' );
    options::$fields['layout']['category_sidebar']      = array('type' => 'st--select' , 'label' => __( 'Select sidebar for category template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'category_sidebar' );
    if( options::get_value( 'layout' , 'category' ) == 'full' ){
        options::$fields['layout']['category_sidebar']['classes'] = 'category_sidebar hidden';
    }
    options::$fields['layout']['title7']                = array('type' => 'ni--title' , 'title' => __( 'Tags' , 'cosmotheme' ) );
    options::$fields['layout']['tag']                   = array('type' => 'st--select' , 'label' => __( 'Layout for tags page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.tag_layout' , { 'left' : '.tag_sidebar' , 'right' : '.tag_sidebar' } , 'sh_' )" , 'iclasses' => 'tag_layout' );
    options::$fields['layout']['tag_sidebar']           = array('type' => 'st--select' , 'label' => __( 'Select sidebar for tags template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'tag_sidebar' );
    if( options::get_value( 'layout' , 'tag' ) == 'full' ){
        options::$fields['layout']['tag_sidebar']['classes'] = 'tag_sidebar hidden';
    }
    options::$fields['layout']['title8']                = array('type' => 'ni--title' , 'title' => '' );
    options::$fields['layout']['attachment']            = array('type' => 'st--select' , 'label' => __( 'Layout for attachment page' , 'cosmotheme' ) , 'value' => $layouts , 'action' => "act.select('.attachment_layout' , { 'left' : '.attachment_sidebar' , 'right' : '.attachment_sidebar' } , 'sh_' )" , 'iclasses' => 'attachment_layout' );
    options::$fields['layout']['attachment_sidebar']    = array('type' => 'st--select' , 'label' => __( 'Select sidebar for attachment template' , 'cosmotheme' ) , 'value' =>  $sidebar , 'classes' => 'attachment_sidebar' );
    if( options::get_value( 'layout' , 'attachment' ) == 'full' ){
        options::$fields['layout']['attachment_sidebar']['classes'] = 'attachment_sidebar hidden';
    }

    
    
    /* STYLING DEFAULT VALUES */
    
    options::$default['styling']['front_end']           = 'no';
	options::$default['styling']['background']			= 'pattern.grid.png';
    options::$default['styling']['logo_type']           = 'text';
	options::$default['styling']['background_color']    = '#ffffff';
//    options::$default['styling']['footer_bg_color']     = '#414B52';
    options::$default['styling']['stripes']             = 'yes';
    options::$default['styling']['ajax_box_style']      = 'black';

    /* STYLING OPTIONS */
    
    $pattern_path = 'pattern/s.pattern.';
    $pattern = array(
        "dots2"=>"dots2.png" , "squares3"=>"squares3.png" , "pluses"=>"pluses.png" , "opacity"=>"opacity.png" ,"circles"=>"circles.png","dots"=>"dots.png","grid"=>"grid.png","noise"=>"noise.png",
        "paper"=>"paper.png","rectangle"=>"rectangle.png","squares_1"=>"squares_1.png","squares_2"=>"squares_2.png","thicklines"=>"thicklines.png","thinlines"=>"thinlines.png" , "none"=>"none.png"
    );

    options::$fields['styling']['bg_title']             = array( 'type' => 'ni--title' , 'title' => __( 'Patterns' , 'cosmotheme' ) );
    options::$fields['styling']['background']           = array( 'type' => 'ni--radio-icon' ,  'value' => $pattern , 'path' => $pattern_path , 'in_row' => 5, 'hint' => __('NOTE! This patterns are used on the entire site but Home page.','cosmotheme') );
    
    /* color */
    /* background */
    options::$fields['styling']['background_color']     = array('type' => 'st--color-picker' , 'label' => __( 'Set background color' , 'cosmotheme' ), 'hint' => __('NOTE! This background color used on the entire site but Home page.','cosmotheme') );
    //options::$fields['styling']['footer_bg_color']      = array('type' => 'st--color-picker' , 'label' => __( 'Set footer background color' , 'cosmotheme' ) );
    options::$fields['styling']['background_image']     = array( 'type' => 'st--hint' , 'value' => __( 'To set a background image go to' , 'cosmotheme' ) . ' <a href="themes.php?page=custom-background">' . __( 'Appearence - Background'  , 'cosmotheme' ) . '</a>' );

    $path_parts = pathinfo( options::get_value( 'styling' , 'favicon' ) );
    if( strlen( options::get_value( 'styling' , 'favicon' ) ) && $path_parts['extension'] != 'ico' ){
        $ico_hint = '<span style="color:#cc0000;">' . __( 'Error, please select "ico" type media file' , 'cosmotheme' ) . '</span>';
    }else{
        $ico_hint = __( "Please select 'ico' type media file. Make sure you allow uploading 'ico' type in General Settings -> Upload file types" , 'cosmotheme' );
    }

    options::$fields['styling']['favicon']              = array('type' => 'st--upload' , 'label' => __( 'Custom favicon' , 'cosmotheme' ) , 'id' => 'favicon_path' , 'hint' => $ico_hint );
    options::$fields['styling']['ajax_box_style']       = array('type' => 'st--select' , 'label' => __( 'Posts box background color' , 'cosmotheme' ) , 'value' => array( 'white' => 'White' ,  'black' => 'Black' ) , 'hint' => __( 'This background color will be used for the posts loaded via ajax.' , 'cosmotheme' )  );
    options::$fields['styling']['stripes']              = array('type' => 'st--logic-radio' , 'label' => __( 'Enable stripes effect for post images' , 'cosmotheme' ) );
    options::$fields['styling']['logo_type']            = array('type' => 'st--select' , 'label' => __( 'Logo type ' , 'cosmotheme' ) , 'value' => array( 'text' => 'Text logo' , 'image' => 'Image logo' ) , 'hint' => __( 'Enable text-based site title and tagline.' , 'cosmotheme' ) , 'action' => "act.select( '.g_logo_type' , { 'text':'.g_logo_text' , 'image':'.g_logo_image' } , 'sh_' );" , 'iclasses' => 'g_logo_type' );

    /* fields for general -> logo_type */
    options::$fields['styling']['logo_url']             = array('type' => 'st--upload' , 'label' => __( 'Custom logo URL' , 'cosmotheme' ) , 'id' => 'logo_path' );
    options::$fields['styling']['small_logo_url']       = array('type' => 'st--upload' , 'label' => __( 'Small logo URL' , 'cosmotheme' ) , 'id' => 'logo_path_small' );

    /* hide not used fields */
	if( options::get_value( 'styling' , 'logo_type') == 'image' ){
        options::$fields['styling']['logo_url']['classes'] 	= 'g_logo_image';
        options::$fields['styling']['small_logo_url']['classes']  = 'g_logo_image';
        text::fields( 'styling' , 'logo' ,  'g_logo_text hidden' , get_option( 'blogname' ) );
        options::$fields['styling']['hint']                 = array('type' => 'st--hint' , 'classes' => 'g_logo_text hidden' ,'value' => __( 'To change blog title go to <a href="options-general.php">General settings</a> ' , 'cosmotheme') );
    }else{
		options::$fields['styling']['logo_url']['classes'] 	= 'generic-hint g_logo_image hidden';
        options::$fields['styling']['small_logo_url']['classes']  = 'generic-hint g_logo_image hidden';
        text::fields( 'styling' , 'logo' ,  'g_logo_text' , get_option( 'blogname' ) );
        options::$fields['styling']['hint']                 = array('type' => 'st--hint' , 'classes' => 'generic-hint g_logo_text' , 'value' => __( 'To change blog title go to <a href="options-general.php">General settings </a> ' , 'cosmotheme') );
    }
    
	/* MENU DEFAULT VALUES */
    options::$default['menu']['header']                 = 8;
    options::$default['menu']['footer']                 = 4;
    
            
    /* MENU OPTIONS */
    
    options::$fields['menu']['custom_menu']             = array('type' => 'ni--title' , 'title' => __( 'Custom menu' , 'cosmotheme' ) );
    options::$fields['menu']['header']                  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 ) , 'label' => __( 'Set limit for main menu' , 'cosmotheme' ) , 'hint' => __( 'Set the number of visible menu items. Remaining menu items<br />will be shown in the drop down menu item "More"' , 'cosmotheme' ) );
    options::$fields['menu']['footer']                  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 ) , 'label' => __( 'Set limit for footer menu' , 'cosmotheme' ) , 'hint' => __( 'Set the number of visible menu items' , 'cosmotheme' ) );
    
    /* POSTS OPTIONS */
    options::$fields['blog_post']['post_title0']        = array('type' => 'ni--title' , 'title' => __( 'General Posts Settings' , 'cosmotheme' ) );

    options::$fields['blog_post']['show_similar']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable similar posts' , 'cosmotheme' ), 'action' => "act.check( this , { 'yes' : '.similar_type_class ' , 'no' : '' } , 'sh' );" );
    options::$fields['blog_post']['post_similar_full']  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 , 1 ) , 'label' => __( 'Number of similar posts (full width)' , 'cosmotheme' ) );
    options::$fields['blog_post']['post_similar_side']  = array('type' => 'st--select' , 'value' => fields::digit_array( 20 , 1 ) , 'label' => __( 'Number of similar posts (with sidebar)' , 'cosmotheme' ) );
    
	$similar_type_options = array('post_tag'=>__('Same tags','cosmotheme'), 'category'=> __('Same category','cosmotheme'));
    
	options::$fields['blog_post']['similar_type']       = array('type' => 'st--select' , 'value' => $similar_type_options , 'label' => __( 'Similar posts criteria' , 'cosmotheme' ) );
    options::$fields['blog_post']['post_sharing']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for posts' , 'cosmotheme' ) );
    options::$fields['blog_post']['show_feat_on_archive'] = array('type' => 'st--logic-radio' , 'label' => __( 'Display featured image on archive pages' , 'cosmotheme' )  );
	
	

    options::$fields['blog_post']['post_title1']        = array('type' => 'ni--title' , 'title' => __( 'General Page Settings' , 'cosmotheme' ) );
    options::$fields['blog_post']['page_sharing']       = array('type' => 'st--logic-radio' , 'label' => __( 'Enable social sharing for page' , 'cosmotheme' ) );

    /* POSTS DEFAULT VALUE */
    options::$default['blog_post']['post_similar_full'] = 4;
    options::$default['blog_post']['post_similar_side'] = 3;
    options::$default['blog_post']['show_similar']      = 'yes';
    options::$default['blog_post']['post_sharing']      = 'yes';
    options::$default['blog_post']['show_feat_on_archive'] = 'yes';
    options::$default['blog_post']['page_sharing']      = 'yes';
    options::$default['blog_post']['author_sharing']    = 'no';
    options::$default['blog_post']['attachment_comments']= 'yes';
	options::$default['blog_post']['similar_type']= 'post_tag';

	if( options::logic( 'blog_post' , 'show_similar' ) ){
		options::$fields['blog_post']['similar_type']['classes']     = 'similar_type_class';
        options::$fields['blog_post']['post_similar_full']['classes']= 'similar_type_class';
        options::$fields['blog_post']['post_similar_side']['classes']= 'similar_type_class';
	}else{ 
		options::$fields['blog_post']['similar_type']['classes']     = 'similar_type_class hidden';
        options::$fields['blog_post']['post_similar_full']['classes']= 'similar_type_class hidden';
        options::$fields['blog_post']['post_similar_side']['classes']= 'similar_type_class hidden';
	}

    /* ADVERTISEMENT SPACES */
    options::$fields['advertisement']['logo']           = array('type' => 'st--textarea' , 'label' => __( 'Advertisement area nr. 1' , 'cosmotheme' ) , 'hint' => __( 'Insert your advertisement code here<br />This is ad area below logo' , 'cosmotheme' ) );
    options::$fields['advertisement']['content']        = array('type' => 'st--textarea' , 'label' => __( 'Advertisement area nr. 2' , 'cosmotheme' ) , 'hint' => __( 'Insert your advertisement code here<br />This is ad area below post content' , 'cosmotheme' ) );

    /* SOCIAL OPTIONS */
    options::$fields[ 'social' ][ 'rss' ]               = array('type' => 'st--logic-radio' , 'label' => __( 'Show RSS icon' , 'cosmotheme' )  );
    options::$fields['social']['facebook']              = array('type' => 'st--text' , 'label' => __( 'Facebook profile ID' , 'cosmotheme' ), 'hint' => __( '(i.e. cosmo.theme)' , 'cosmotheme' )  );
    options::$fields['social']['facebook_app_id']       = array('type' => 'st--text' , 'label' => __( 'Facebook Application ID' , 'cosmotheme' ) , 'hint' => __( 'You can create a fb application from <a href="https://developers.facebook.com/apps">here</a>' , 'cosmotheme' ) );
    options::$fields['social']['facebook_secret']       = array('type' => 'st--text' , 'label' => __( 'Facebook Secret key' , 'cosmotheme' ) , 'hint' => __( 'Needed for Facebook Connect' , 'cosmotheme' ) );
    options::$fields['social']['twitter']               = array('type' => 'st--text' , 'label' => __( 'Twitter ID' , 'cosmotheme' ), 'hint' => __( '(i.e. cosmothemes)' , 'cosmotheme' ) );

    options::$fields['social']['gplus']                 = array('type' => 'st--text' , 'label' => __( 'G+ public profile URL' , 'cosmotheme' ), 'hint' => __( '(i.e. https://plus.google.com/u/0/b/103218861385999897717/)' , 'cosmotheme' ) );
    options::$fields['social']['yahoo']                 = array('type' => 'st--text' , 'label' => __( 'Yahoo public profile URL' , 'cosmotheme' ), 'hint' => __( '(i.e. http://profile.yahoo.com/56W6RBFOFVLLSUQBHREPTDQW4U/)' , 'cosmotheme' ) );
    options::$fields['social']['dribbble']              = array('type' => 'st--text' , 'label' => __( 'Dribbble public profile URL' , 'cosmotheme' ), 'hint' => __( '(i.e. http://dribbble.com/cosmothemes)' , 'cosmotheme' ) );
    options::$fields['social']['linkedin']              = array('type' => 'st--text' , 'label' => __( 'LinkedIn public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://www.linkedin.com/company/cosmothemes)' , 'cosmotheme' ) );

    options::$fields['social']['vimeo']                 = array('type' => 'st--text' , 'label' => __( 'Vimeo public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://vimeo.com/user10929709)' , 'cosmotheme' ) );
    options::$fields['social']['youtube']               = array('type' => 'st--text' , 'label' => __( 'Youtube public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://www.youtube.com/user/vasilerusnac)' , 'cosmotheme' ) );
    options::$fields['social']['tumblr']                = array('type' => 'st--text' , 'label' => __( 'Tumblr public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://virusnac.tumblr.com/)' , 'cosmotheme' ) );
    options::$fields['social']['delicious']             = array('type' => 'st--text' , 'label' => __( 'Delicious public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. https://delicious.com/cosmothemes)' , 'cosmotheme' ) );
    options::$fields['social']['flickr']                = array('type' => 'st--text' , 'label' => __( 'Flickr public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://www.flickr.com/photos/cosmothemes/)' , 'cosmotheme' ) );
    options::$fields['social']['pinterest']             = array('type' => 'st--text' , 'label' => __( 'Pinterest public profile URL' , 'cosmotheme' ) , 'hint' => __( '(i.e. http://pinterest.com/cosmothemes)' , 'cosmotheme' ) );

    options::$fields['social']['email']                 = array('type' => 'st--text' , 'label' => __( 'Contact email' , 'cosmotheme' )  );
    options::$fields['social']['skype']                 = array('type' => 'st--text' , 'label' => __( 'Skype Name' , 'cosmotheme' )  );
    

    options::$default[ 'social' ][ 'rss' ]              = 'no';
    options::$default[ 'styling' ][ 'logo_type' ]       = 'image';

   
    /* sidebar manager */
    $struct = array(
        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow[]',
            'type' => 'hidden'
        ),
        
        'info-column-0' => array(
            1 => array(
                'name' => 'delimiter1',
                'type' => 'delimiter',
                'label' => __('SIDEBAR SETTINGS','cosmotheme'),
                'lvisible' => false,
                'classes' => 'Scontent_fview_type',
            ),
            0 => array(
                'name' => 'title',
                'type' => 'text',
                'label' => 'Sidebar Title',
                'classes' => 'sidebar-title'
            )
        ),
        'select' => 'title',
        'actions' => array( 'sortable' => true )
    );

    /* delete_option( '_sidebar' ); */
    /* SOCIAL OPTIONS */
    options::$fields['_sidebar']['idrow']               = array('type' => 'st--m-hidden' , 'value' => 1 , 'id' => 'sidebar_title_id' , 'single' => true );
    options::$fields['_sidebar']['title']               = array('type' => 'st--text' , 'label' => __( 'Set title for new sidebar','cosmotheme' ) , 'id' => 'sidebar_title' , 'single' => true );
    options::$fields['_sidebar']['save']                = array('type' => 'st--button' , 'value' => 'Add new sidebar' , 'action' => "extra.add( '_sidebar' , { 'input' : [ 'sidebar_title_id' , 'sidebar_title'] })" );

    options::$fields['_sidebar']['struct']              = $struct;
    options::$fields['_sidebar']['hint']                = __( 'List of generic dynamic sidebars<br />Drag and drop blocks to rearrange position' , 'cosmotheme' );

    options::$fields['_sidebar']['list']                = array( 'type' => 'ex--extra' , 'cid' => 'container__sidebar');
    
    /* Custom css */
    options::$fields['custom_css']['css']               = array('type' => 'st--textarea' , 'label' => __( 'Add your custom CSS' , 'cosmotheme' )  );
    

    /*Cosmothemes options*/

	options::$default['cosmothemes']['show_new_version']      = 'yes';
	options::$default['cosmothemes']['show_cosmo_news']      = 'yes';
	options::$fields['cosmothemes']['show_new_version'] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable notification about new theme version' , 'cosmotheme' ) );
	options::$fields['cosmothemes']['show_cosmo_news']  = array( 'type' => 'st--logic-radio' , 'label' => __( 'Enable Cosmothemes news notification' , 'cosmotheme' ) );

    /* tooltips */
    $type = array( 'left' => __( 'Left' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) , 'top' => __( 'Top' , 'cosmotheme' ) );
    $res_type = array( 'front_page' => __( 'On front page' , 'cosmotheme' ) , 'single' => __( 'On single post' , 'cosmotheme' ) , 'page' => __( 'On simple page' , 'cosmotheme' ) );
    $res_pages = get__pages( __( 'Select Page' , 'cosmotheme' ) );
    $tooltips = array(
        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'classes' => 'idrow'
        ),
        'info-column-0' => array(
            10 => array(
                'name' => 'delimiter3S',
                'type' => 'delimiter',
                'label' => __('TOOLTIP SETTINGS','cosmotheme'),
                'lvisible' => false,
                'classes' => 'Scontent_view_type',
            ),
            0 => array(
                'name' => 'title',
                'type' => 'text',
                'label' => 'Tooltip title',
                'classes' => 'tooltip-title',
                'before' => '<strong>',
                'after' => '</strong>',
            ),
            1 => array(
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Tooltip description',
                'classes' => 'tooltip-description'
            ),
            2 => array(
                'name' => 'res_type',
                'type' => 'select',
                'assoc' => $res_type,
                'label' => 'Location',
                'lvisible' => false,
                'classes' => 'tooltip-res-type',
                'action' => array( 'single' => 'res_posts' , 'page' => 'res_pages' , 'method' => 'sh_' ),
            ),
            3 => array(
                'name' => 'res_posts',
                'type' => 'search',
                'query' => array( 'post_type' => 'post' , 'post_status' => 'publish' ),
                'label' => '',
                'lvisible' => false,
                'classes' => 'tooltip-res-posts',
                'linked' => array( 'res_type' , 'single' ),
            ),
            4 => array(
                'name' => 'res_pages',
                'type' => 'select',
                'assoc' => $res_pages,
                'label' => '',
                'lvisible' => false,
                'classes' => 'tooltip-res-pages',
                'linked' => array( 'res_type' , 'page' ),
            ),
            5 => array(
                'name' => 'top',
                'type' => 'text',
                'label' => 'Top position',
                'lvisible' => false,
                'classes' => 'tooltip-top'
            ),
            6 => array(
                'name' => 'left',
                'type' => 'text',
                'label' => 'Left position',
                'lvisible' => false,
                'classes' => 'tooltip-left'
            ),
            7 => array(
                'name' => 'type',
                'type' => 'select',
                'assoc' => $type,
                'label' => 'Arrow position',
                'lvisible' => false,
                'classes' => 'tooltip-type'
            ),
        ),
        'actions' => array( 'sortable' => true )
    );
    
    $res_action = "act.select( '#tooltip_res_type' , { 'single' : '.res_posts' , 'page': '.res_pages'  } , 'sh_' )";
    
    options::$fields['_tooltip']['idrow']               = array('type' => 'st--hidden' , 'value' => 1 , 'id' => 'tooltip_id' , 'single' => true);
    options::$fields['_tooltip']['title']               = array('type' => 'st--text' , 'label' => __( 'Set title for new tooltip','cosmotheme' ) , 'id' => 'tooltip_title' , 'single' => true);
    options::$fields['_tooltip']['description']         = array('type' => 'st--textarea' , 'label' => __( 'Set description for new tooltip','cosmotheme' ) , 'id' => 'tooltip_description' , 'single' => true );
    options::$fields['_tooltip']['res_type']            = array('type' => 'st--select' , 'label' => __( 'Select tooltip location' , 'cosmotheme' ) , 'value' =>  $res_type , 'action' => $res_action , 'id' => 'tooltip_res_type' , 'single' => true );
    options::$fields['_tooltip']['res_posts']           = array('type' => 'st--search' , 'label' => __( 'Select post' , 'cosmotheme' ) , 'hint' => 'Start typing the post tile' , 'classes' => 'res_posts hidden' , 'id' => 'tooltip_res_posts' , 'single' => true , 'query' => array( 'post_type' => 'post' , 'post_status' => 'publish' ) , 'action' => "act.search( this , '-');" );
    options::$fields['_tooltip']['res_pages']           = array('type' => 'st--select' , 'label' => __( 'Select page' , 'cosmotheme' ) , 'value' => $res_pages , 'classes' => 'res_pages hidden' , 'id' => 'tooltip_res_pages' , 'single' => true );
    options::$fields['_tooltip']['top']                 = array('type' => 'st--text' , 'label' => __( 'Set top position for new tooltip','cosmotheme' )  , 'hint' => __( 'In pixels. E.g.: 450' , 'cosmotheme' ) , 'id' => 'tooltip_top' , 'single' => true );
    options::$fields['_tooltip']['left']                = array('type' => 'st--text' , 'label' => __( 'Set left position for new tooltip','cosmotheme' )  , 'hint' => __( 'In pixels. E.g.: 200' , 'cosmotheme' )  , 'id' => 'tooltip_left' , 'single' => true );
    options::$fields['_tooltip']['type']                = array('type' => 'st--select' , 'label' => __( 'Set arrow position for new tooltip','cosmotheme' ) , 'id' => 'tooltip_type' , 'value' => $type , 'single' => true );
    options::$fields['_tooltip']['save']                = array('type' => 'st--button' , 'value' => __( 'Add new tooltip' , 'cosmotheme' ) , 'action' => "extra.add( '_tooltip' , { 'input' : [ 'tooltip_id' , 'tooltip_title' , 'tooltip_top' , 'tooltip_left', 'tooltip_res_posts' ] , 'textarea' : 'tooltip_description' , 'select' : ['tooltip_type' , 'tooltip_res_type' ,  'tooltip_res_pages' ] })" );
    
    options::$fields['_tooltip']['struct']              = $tooltips;
    options::$fields['_tooltip']['hint']                = __( 'List of generic tooltips<br /> Drag and drop blocks to rearrange position' , 'cosmotheme' );

    options::$fields['_tooltip']['list']                = array( 'type' => 'ex--extra' , 'cid' => 'container__tooltip');


    /* BOF Content Menu*/
    $view_type = array('list_view'=>__('List view','cosmotheme'), 'grid_view'=>__('Grid view','cosmotheme'),'thumb_view'=>__('Thumbnails view','cosmotheme') );
    $resize_method_options = array('crop' => __('Crop','cosmotheme'), 'resize' => __('Resize','cosmotheme'));
    $order_by =  array('date'=>__('Date','cosmotheme'), 'comment_count'=>__('Comment count','cosmotheme'), 'like'=>__('Number of likes','cosmotheme'));
    $order = array('desc'=>__('Desc','cosmotheme'), 'asc'=>__('Asc','cosmotheme'));
    $number_columns = array('1' => 1,'2' => 2,'3' => 3,'4' => 4,'6' => 6);
    $content_select_pattern = array('dots' => __('Dots','cosmotheme'), 'pluses' => __('Pluses','cosmotheme'), 'squares' => __('Squares','cosmotheme'), 'noise' => __('Noise','cosmotheme'));
    
    $content_menu = array(
        'layout' => 'A',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'classes' => 'idrow'
        ),
        'info-column-0' => array(
            55 => array(
                'name' => 'delimiter3',
                'type' => 'delimiter',
                'label' => __('SLIDESHOW SETTINGS','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_viwew_type',
            ),
            0 => array(
                'name' => 'delimiter1',
                'type' => 'delimiter',
                'label' => __('POSTS SETTINGS','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_view_type',
            ),
            50 => array(
                'name' => 'menu_label',
                'type' => 'text',
                'label' => __('Menu label','cosmotheme'), 
                'hint' => __('This will overwrite the objet name that is used in the site\'s menu','cosmotheme'),
                'lvisible' => false,
                'classes' => 'menu_label'
            ),
            1 => array(
                'name' => 'view_type',
                'type' => 'select',
                'assoc' => $view_type,
                'label' => __('View type','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_view_type',
                'action' => array( 'grid_view' => array('enable_masonry','number_columns') , 'thumb_view' => array('enable_masonry','number_columns','enable_filter','filter_by') , 'list_view' => array('text_color'), 'method' => 'sh_' ),
            ),
            
            2 => array(
                'name' => 'resize_method',
                'type' => 'select',
                'assoc' => $resize_method_options,
                'label' => __('Resize method for image','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_resize_method',
                //'linked' => array( 'view_type' , 'list_view' ),
            ),

            33 => array(
                'name' => 'enable_filter',
                'type' => 'checkbox',
                //'assoc' => $resize_method_options,
                'label' => __('Enable filter','cosmotheme'),
                'lvisible' => false,
                'classes' => 'enable_filter',
                'linked' => array( 'view_type' , 'thumb_view' ),
            ),

            38 => array(
                'name' => 'filter_by',
                'type' => 'select',
                'assoc' => array('category'=>__('Category','cosmotheme'), 'post_tag'=>__('Tag','cosmotheme')),
                'label' => __('Filter by','cosmotheme'),
                'lvisible' => false,
                'classes' => 'filter_by',
                'linked' => array( 'view_type' , 'thumb_view' ),
            ),
            
            3 => array(
                'name' => 'enable_masonry',
                'type' => 'checkbox',
                //'assoc' => $resize_method_options,
                'label' => __('Enable masonry','cosmotheme'),
                'lvisible' => false,
                'classes' => 'enable_masonry',
                'linked' => array( 'view_type' , array('grid_view', 'thumb_view') ),
            ),

            4 => array(
                'name' => 'number_columns',
                'type' => 'select',
                'assoc' => $number_columns,
                'label' => __('Number of columns','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_number_columns',
                'linked' => array( 'view_type' , array('grid_view', 'thumb_view') ),
            ),
            56 => array(
                'name' => 'number_of_columns',
                'type' => 'select',
                'assoc' => $number_columns,
                'label' => __('Number of columns','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_number_of_columns',
                // 'linked' => array( 'view_type' , 'grid_view' ),
            ),
            5 => array(
                'name' => 'number_posts',
                'type' => 'text',
                'ivalue' =>12, 
                'label' => 'Number of posts',
                'lvisible' => false,
                'classes' => 'digit'
            ),
            6 => array(
                'name' => 'enable_load_more',
                'type' => 'checkbox',
                //'assoc' => $resize_method_options,
                'label' => __('Enable load more','cosmotheme'),
                'lvisible' => false,
                'classes' => 'enable_load_more'
            ),

            58 => array(
                'name' => 'enable_ajax_post',
                'type' => 'checkbox',
                'label' => __('Load posts with ajax','cosmotheme'),
                'lvisible' => false,
                'classes' => 'enable_ajax_post'
            ),

            7 => array(
                'name' => 'order_by',
                'type' => 'select',
                'assoc' => $order_by,
                'label' => 'Order By',
                'lvisible' => false,
                'classes' => 'content-menu-order-by'
            ),
            8 => array(
                'name' => 'order',
                'type' => 'select',
                'assoc' => $order,
                'label' => 'Order',
                'lvisible' => false,
                'classes' => 'content-menu-order'
            ),


            57 => array(
                'name' => 'text_box',
                'type' => 'textarea',
                'label' => __('Introduction text','cosmotheme'),
                'hint' => __('Use this bot if you want to add a text before the content.','cosmotheme'),
                'lvisible' => false,
                'classes' => 'text_box'
            ),


            9 => array( 'name' => 'use_case', 'type' => 'hidden'),
            10 => array( 'name' => 'object_type', 'type' => 'hidden'),
            11 => array( 'name' => 'object_name', 'type' => 'hidden'), 
            12 => array( 'name' => 'object-id', 'type' => 'hidden'),

            22 => array(
                'name' => 'delimiter2',
                'type' => 'delimiter',
                'label' => __('BACKGROUND STYLING','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_view_type',
            ),

            13 => array(
                'name' => 'text_color',
                'type' => 'color-picker',
                'label' => 'Text color',
                'lvisible' => false,
                'classes' => 'color_picker_text ',
                'linked' => array( 'view_type' , 'list_view' )
            ),
            
            14 => array(
                'name' => 'background_color',
                'type' => 'color-picker',
                'label' => 'Page background color',
                'lvisible' => false,
                'classes' => 'color_picker'
            ),

            15 => array(
                'name' => 'content_background_color',
                'type' => 'color-picker',
                'label' => 'Content background color',
                'lvisible' => false,
                'classes' => 'content_background_color'
            ),

            16 => array(
                'name' => 'bg_color_opacity',
                'type' => 'slider',
                'label' => __('Content background color opacity','cosmotheme'),
                'min_value' => 1,
                'max_value' => 100,
                //'hint' => __('Use this box if you want to add a background object like a video or an iframe','cosmotheme'),
                'lvisible' => false,
                'classes' => 'bg_color_opacity'
            ),
            
            
            17 => array(
                'name' => 'background_image',
                'type' => 'upload',
                'label' => 'Background image',
                'lvisible' => false,
                'classes' => 'background_image'
            ),
            
            21 => array(
                'name' => 'bg_object',
                'type' => 'textarea',
                'label' => __('Background object','cosmotheme'),
                'hint' => __('Use this box if you want to add a background object like a video or an iframe','cosmotheme'),
                'lvisible' => false,
                'classes' => 'bg_object'
            ),

            52 => array(
                'name' => 'auto_play',
                'type' => 'checkbox',
                'label' => __('Enable slideshow autoplay','cosmotheme'),
                'lvisible' => false,
                'classes' => 'auto_play'
            ),
            
            51 => array(
                'name' => 'slide_transition',
                'type' => 'slider',
                'label' => __('Time between transitions','cosmotheme'),
                'hint' => __('(seconds)','cosmotheme'),
                'min_value' => 1,
                'max_value' => 10,
                'lvisible' => false,
                'classes' => 'slide_transition'
            ),
            53 => array(
                'name' => 'slideshow_pattern',
                'type' => 'checkbox',
                'label' => __('Enable patterns','cosmotheme'),
                'lvisible' => false,
                'classes' => 'slideshow_pattern'
            ),
            54 => array(
                'name' => 'select_pattern',
                'type' => 'select',
                'assoc' => $content_select_pattern,
                'label' => __('Select pattern','cosmotheme'),
                'lvisible' => false,
                'classes' => 'content_select_pattern',
                'linked' => 'slideshow_pattern',
            )
            
        ),
        'actions' => array( 'sortable' => true )
    );


    options::$fields['_content_menu']['idrow']              = array('type' => 'st--hidden' , 'value' => 1 , 'id' => 'menu_id' , 'single' => true);
    options::$fields['_content_menu']['view_type']          = array('type' => 'st--select' , 'label' => __( 'Select view type' , 'cosmotheme' ) ,  'value' =>  $view_type , 'id' => 'view_type' , 'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['resize_method']      = array('type' => 'st--select' , 'label' => __( 'Resize method' , 'cosmotheme' ) ,  'value' =>  $resize_method_options , 'id' => 'resize_method' , 'single' => true, 'classes'=>'hidden' );    

    
    options::$fields['_content_menu']['enable_masonry']     = array('type' => 'st--hidden', 'id' => 'enable_masonry', "value" => "enable_masonry",  'single' => true , 'classes'=>'hidden');
    options::$fields['_content_menu']['enable_load_more']   = array('type' => 'st--hidden', 'id' => 'enable_load_more', "value" => "enable_load_more_no",  'single' => true , 'classes'=>'hidden');
    options::$fields['_content_menu']['enable_ajax_post']   = array('type' => 'st--hidden', 'id' => 'enable_ajax_post', "value" => "enable_ajax_post_no",  'single' => true , 'classes'=>'hidden');


    options::$fields['_content_menu']['order_by']           = array('type' => 'st--select' , 'label' => __( 'Order By' , 'cosmotheme' ) ,  'value' =>  $order_by , 'id' => 'order_by' , 'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['order']              = array('type' => 'st--select' , 'label' => __( 'Order' , 'cosmotheme' ) ,  'value' =>  $order , 'id' => 'order' , 'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['text_box']           = array('type' => 'st--hidden', 'id' => 'text_box', 'value' => ' ',  'single' => true, 'classes'=>'hidden' );   

    options::$fields['_content_menu']['number_posts']       = array('type' => 'st--hidden', 'id' => 'number_posts', 'value' => '12',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['use_case']           = array('type' => 'st--hidden', 'id' => 'use_case',  'value' => 'content_menu', 'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['object_type']        = array('type' => 'st--hidden', 'id' => 'object_type', 'value' => '',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['object_name']        = array('type' => 'st--hidden', 'id' => 'object_name', 'value' => '',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['object-id']          = array('type' => 'st--hidden', 'id' => 'object-id', 'value' => '', 'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['number_columns']     = array('type' => 'st--hidden', 'id' => 'number_columns', 'value' => 'three', 'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['background_color']   = array('type' => 'st--hidden', 'id' => 'background_color',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['text_color']         = array('type' => 'st--hidden', 'id' => 'text_color',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['background_image']   = array('type' => 'st--hidden', 'id' => 'background_image',  'single' => true, 'classes'=>'hidden' );

    options::$fields['_content_menu']['number_of_columns']     = array('type' => 'st--hidden', 'id' => 'number_of_columns', 'value' => 'three', 'single' => true, 'classes'=>'hidden' );


    options::$fields['_content_menu']['bg_object']          = array('type' => 'st--hidden', 'id' => 'bg_object', 'value' => ' ',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['bg_color_opacity']   = array('type' => 'st--hidden', 'id' => 'bg_color_opacity', 'value' => '50',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['content_background_color']   = array('type' => 'st--hidden', 'id' => 'content_background_color', 'value' => ' ',  'single' => true, 'classes'=>'hidden' );

    options::$fields['_content_menu']['menu_label']           = array('type' => 'st--hidden', 'id' => 'menu_label',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['auto_play']            = array('type' => 'st--hidden', 'id' => 'auto_play',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['slide_transition']     = array('type' => 'st--hidden', 'id' => 'slide_transition',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['slideshow_pattern']    = array('type' => 'st--hidden', 'id' => 'slideshow_pattern',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['select_pattern']       = array('type' => 'st--select' , 'label' => __( 'Select pattern' , 'cosmotheme' ) ,  'value' =>  $content_select_pattern , 'id' => 'select_pattern' , 'single' => true, 'classes'=>'hidden' );    
    options::$fields['_content_menu']['enable_filter']        = array('type' => 'st--hidden', 'id' => 'enable_filter',  'single' => true, 'classes'=>'hidden' );
    options::$fields['_content_menu']['filter_by']            = array('type' => 'st--hidden', 'id' => 'filter_by',  'single' => true, 'classes'=>'hidden' );
    
    $action_string = "extra.add( '_content_menu' , 
        {   'input' : [ 'filter_by','enable_filter','menu_id', 'number_posts', 'number_columns', 'number_of_columns', 'background_color', 'text_color', 'use_case', 'bg_object', 'text_box','bg_color_opacity', 'content_background_color',
                        'object_type','object_name','object-id','enable_masonry','enable_load_more', 'enable_ajax_post' , 'background_image','menu_label','auto_play', 'slide_transition', 'slideshow_pattern' ] , 
            'select' : ['view_type' ,'resize_method', 'order_by' ,  'order', 'select_pattern'] } )";

    /*search fields for terms have some particular params like 'term_type' and no 'query' */

    $content_res_action = "act.select( '#_content_menu_type' , { 'category' : '.post_category' , 'tag': '.post_tag', 'portfolio_category': '.portfolio_category', 'portfolio_tag' : '.portfolio_tag', 'box_set' : '.box_set', 'team_group': '.team_group', 'testimonial_category': '.testimonial_category', 'page': '.search_page', 'post': '.search_post', 'portfolio' : '.search_portfolio', 'slideshow': '.search_slideshow', 'post_type':'.post_types'  } , 'sh_' )";
    
    $select_action = "init_dafault_content_data_select( jQuery(this).find('option:selected').text() , jQuery(this).val(), jQuery(this) ); ";


    $content_res_type = array('' =>__( 'Select content type' , 'cosmotheme' ), 'category' => __( 'Post Category' , 'cosmotheme' ),'tag' => __( 'Post Tag' , 'cosmotheme' ),
                            'portfolio_category' => __( 'Portfolio Category' , 'cosmotheme' ), 'portfolio_tag' => __( 'Portfolio tag' , 'cosmotheme' ),
                            'post_type' => __( 'Post type' , 'cosmotheme' ),
                            'box_set' => __( 'Box Set' , 'cosmotheme' ), 'team_group' => __( 'Team Group' , 'cosmotheme' ), 'testimonial_category' => __( 'Testimonial Category' , 'cosmotheme' ),
                            'page' => __( 'Page' , 'cosmotheme' ), 'post' => __( 'Post' , 'cosmotheme' ), 'portfolio' => __( 'Portfolio' , 'cosmotheme' ), 'slideshow' => __( 'Slideshow' , 'cosmotheme' ) );

    $post_types =  array( '' => __( 'Select post type' , 'cosmotheme' ),  'standard' => __( 'Standard posts' , 'cosmotheme' ) , 'video' => __( 'Video posts' , 'cosmotheme' ) , 'image' => __( 'Image posts' , 'cosmotheme' ) , 'audio' => __( 'Audio posts' , 'cosmotheme' )  , 'link' => __( 'Attachment posts' , 'cosmotheme' ), 'gallery' => __( 'Gallery posts' , 'cosmotheme' ), 'latest_posts' => __( 'Latest posts' , 'cosmotheme' ), 'latest_portfolios' => __( 'Latest portfolios' , 'cosmotheme' ) ); 
    
    options::$fields['_content_menu']['res_type']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select content type you want to add' , 'cosmotheme' ) , 
            'value' =>  $content_res_type , 
            'action' => $content_res_action , 
            'hint' => __( 'Selected options will build the main menu and content on the front page.' , 'cosmotheme' ) , 
            'id' => '_content_menu_type' , 
            'single' => true );

    options::$fields['_content_menu']['post_types']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select post type' , 'cosmotheme' ) , 
            'value' =>  $post_types , 
            'action' => $select_action ,
            'object_type_name' => 'post_format',
            //'action' => $post_types_action . $action_string , 
            'id' => '_content_menu_post_types' , 
            'classes' => 'post_types post_format hidden'
            );

    
    options::$fields['_content_menu']['category']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select post category' , 'cosmotheme' ) , 
            'value' =>  get_all_terms('category') , 
            'action' => $select_action ,
            'object_type_name'=>'category',
            'classes' => 'post_category category hidden',
            );

    options::$fields['_content_menu']['tag']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select post tag' , 'cosmotheme' ) , 
            'value' =>  get_all_terms('post_tag') , 
            'action' => $select_action ,
            'object_type_name'=>'post_tag',
            'classes' => 'post_tag hidden',
            );

    
    options::$fields['_content_menu']['portfolio_category']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select portfolio category' , 'cosmotheme' ) , 
            'value' =>  get_all_terms('portfolio-category') , 
            'action' => $select_action ,
            'object_type_name'=>'portfolio-category',
            'classes' => 'portfolio_category hidden',
            );
    
    options::$fields['_content_menu']['portfolio_tag']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select portfolio tag' , 'cosmotheme' ) , 
            'value' =>  get_all_terms('portfolio-tag') , 
            'action' => $select_action ,
            'object_type_name'=>'portfolio-tag',
            'classes' => 'portfolio_tag hidden',
            );

    options::$fields['_content_menu']['box_set']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select box set' , 'cosmotheme' ) , 
            'value' =>  get_all_terms('box-sets') , 
            'action' => $select_action ,
            'object_type_name'=>'box-sets',
            'classes' => 'box_set box-sets hidden',
            );
    
    options::$fields['_content_menu']['team_group']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select team group' , 'cosmotheme' ) , 
            'value' =>  get_all_terms('team-group') , 
            'action' => $select_action ,
            'object_type_name'=>'team-group',
            'classes' => 'team_group team-group hidden',
            );
    
    options::$fields['_content_menu']['testimonial_category']       = array(
            'type' => 'st--select' , 
            'label' => __( 'Select testimonial category' , 'cosmotheme' ) , 
            'value' =>  get_all_terms('testimonial-category') , 
            'action' => $select_action ,
            'object_type_name'=>'testimonial-category',
            'classes' => 'testimonial_category hidden',
            );
    
    options::$fields['_content_menu']['page']         = array(
            'type' => 'st--search' , 
            'label' => __( 'Page' , 'cosmotheme' ) , 
            'add_suggestion'=>true, 
            'object_type'=>'page',  
            'object_type_name'=>'page',  
            'query' => array( 'post_type' => 'page' , 'post_status' => 'publish' ) , 
            'hint' => __( 'Start typing the Page title you want to add' , 'cosmotheme' ) , 
            'classes' => 'search_page page hidden',
            'action' => $action_string
    );
    
    options::$fields['_content_menu']['post']         = array(
            'type' => 'st--search' , 
            'label' => __( 'Post' , 'cosmotheme' ) , 
            'add_suggestion'=>true, 
            'object_type'=>'post',  
            'object_type_name'=>'post',  
            'query' => array( 'post_type' => 'post' , 'post_status' => 'publish' ) , 
            'hint' => __( 'Start typing the Post title you want to add' , 'cosmotheme' ) , 
            'classes' => 'search_post post hidden',
            'action' => $action_string
    );

    options::$fields['_content_menu']['portfolio']         = array(
            'type' => 'st--search' , 
            'label' => __( 'Portfolio' , 'cosmotheme' ) , 
            'add_suggestion'=>true, 
            'object_type'=>'portfolio',  
            'object_type_name'=>'portfolio',  
            'query' => array( 'post_type' => 'portfolio' , 'post_status' => 'publish' ) , 
            'hint' => __( 'Start typing the Portfolio title you want to add' , 'cosmotheme' ) , 
            'classes' => 'search_portfolio portfolio hidden',
            'action' => $action_string
    );

    options::$fields['_content_menu']['slideshow']         = array(
            'type' => 'st--search' , 
            'label' => __( 'Slideshow' , 'cosmotheme' ) , 
            'add_suggestion'=>true, 
            'object_type'=>'slideshow',  
            'object_type_name'=>'slideshow',  
            'query' => array( 'post_type' => 'slideshow' , 'post_status' => 'publish' ) , 
            'hint' => __( 'Start typing the Slideshow\'s title you want to add' , 'cosmotheme' ) , 
            'classes' => 'search_slideshow slideshow hidden',
            'action' => $action_string
    );

    //delete_option('default_selected_menu');
    $default_selected_menu = get_option('default_selected_menu');
    if( is_array( $default_selected_menu )){
        options::$default['_content_menu']['default_menu'] = $default_selected_menu['value'];      
    }
   
    options::$fields['_content_menu']['default_menu_delim1']         = array( 'type' => 'st--delimiter' );

    options::$fields['_content_menu']['default_menu']         = array(
            'type' => 'st--search_menu_content_items' , 
            'label' => __( 'Default selected element' , 'cosmotheme' ) , 
            'add_suggestion'=>true, 
            //'value' => $default_selected_menu['value'],
            'object_type'=>'menu_content',  
            'object_type_name'=>'menu_content',  
            'hint' => __( 'Start typing the title of the element you want to be selected by default on the front page. Choose from elements added below.' , 'cosmotheme' ) 
            
    );

    options::$fields['_content_menu']['struct']       = $content_menu;
    options::$fields['_content_menu']['list']         = array( 'type' => 'ex--extra' , 'cid' => 'container__content_menu');

    /*this generates a hidden box that will be shown when a row will be added*/
    options::$fields['_content_menu']['row_msg_box']       = array(
            'type' => 'st--msg_box' , 
            'message' => __( 'Element was added' , 'cosmotheme' ) ,   
            'classes' => 'row_added_msg ',
            'box_classes' => 'row_added_msg ',
            'single' => true );


    /*this generates a hidden box that will be shown when a default menu is selected and options is saved*/
    options::$fields['_content_menu']['init_menu_save_msg']       = array(
            'type' => 'st--msg_box' , 
            'message' => __( 'Option was saved.' , 'cosmotheme' ) ,   
            'classes' => 'init_menu_save_msg ',
            'box_classes' => 'init_menu_save_msg ',
            'single' => true );

    /* EOF Content Menu*/

    if( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'cosmothemes__io' ){
        $export = array();
        foreach( options::$menu['cosmothemes'] as $option_name => $whatever ){
            $export[$option_name] = get_option( $option_name );
        }
        $exportdata = base64_encode( json_encode( $export ) );
    }else{
        $exportdata = '';
    }

    options::$fields[ 'io' ][ 'warning' ] = array(
        'type' => 'cd--whatever',
        'content' => '<h2 class="import-warning">' . __( 'Warning! You WILL lose all your current settings FOREVER', 'cosmotheme' ) . '<br>'
            . __( 'if you paste the import data and click "Update settings".', 'cosmotheme' ) . '<br>'
            . __( 'Double check everything!', 'cosmotheme' ) . '</h2><b class="import-warning">' . __( 'Please check settings where pages are assigned. If there is something wrong set them manually.', 'cosmotheme' ) . '</b><div class="clear">&nbsp;</div>'
    );

    options::$fields[ 'io' ][ 'export' ] = array(
        'label' => __( 'This is the export data', 'cosmotheme' ),
        'hint' => __( 'Just copy-paste it', 'cosmotheme' ),
        'type' => 'st--textarea',
        'value' => $exportdata
    );

    options::$fields[ 'io' ][ 'import' ] = array(
        'label' => __( 'This is the import zone', 'cosmotheme' ),
        'hint' => __( 'Paste the import data here', 'cosmotheme' ),
        'type' => 'st--textarea',
        'value' => ''
    );

    if( isset( $_POST[ 'io' ] ) && isset( $_POST[ 'io' ][ 'import' ] ) && strlen( trim( $import = $_POST[ 'io' ][ 'import' ] ) ) ){
        $import = @json_decode( base64_decode( $_POST[ 'io' ][ 'import' ] ), true ); /*the second parameter set to true means that array will be returned*/
        if( is_array( $import ) && count( $import ) ){
            foreach( $import as $name => $value ){
                update_option( $name, $value );
            }
        }
    }
    
    options::$register['cosmothemes']                   = options::$fields;
?>