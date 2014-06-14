<?php
    $sidebar_value = extra::select_value( '_sidebar' );

    if(!( is_array( $sidebar_value ) || !empty( $sidebar_value ) ) ){
        $sidebar_value = array();
    }

    /* hide if is full width */
    $classes = 'sidebar_list';

    if( isset( $_GET['post'] ) ){
        $meta = meta::get_meta( (int) $_GET['post'] , 'layout' );

        if( isset( $meta['type'] ) && $meta['type'] == 'full' ){
            $classes = 'sidebar_list hidden';
        }
    }

    $position = array( 'left' => __( 'Align Left' , 'cosmotheme' ) , 'right' => __( 'Align Right' , 'cosmotheme' ) );
    /* post type slideshow */
    $res[ 'slideshow' ][ 'labels' ] = array(
        'name' => _x(__('Slideshow','cosmotheme'), 'post type general name'),
        'singular_name' => _x(__('Slideshow','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Slideshow','cosmotheme')),
        'add_new_item' => __('Add New Slideshow','cosmotheme'),
        'edit_item' => __('Edit Slideshow','cosmotheme'),
        'new_item' => __('New Slideshow','cosmotheme'),
        'view_item' => __('View Slideshow','cosmotheme'),
        'search_items' => __('Search Slideshow','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res[ 'slideshow' ][ 'args' ] = array(
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 3,
        'supports' => array('title'),
    	'exclude_from_search' => true,
        '__on_front_page' => true,
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.slideshow.png'
    );


    /* post type testimonials */
    $res['testimonial']['labels'] = array(
        'name' => _x('Testimonials', 'post type general name','cosmotheme'),
        'singular_name' => _x('Testimonial', 'post type singular name','cosmotheme'),
        'add_new' => _x('Add New', __('Testimonial','cosmotheme')),
        'add_new_item' => __('Add New Testimonial','cosmotheme'),
        'edit_item' => __('Edit Testimonial','cosmotheme'),
        'new_item' => __('New Testimonial','cosmotheme'),
        'view_item' => __('View Testimonial','cosmotheme'),
        'search_items' => __('Search Testimonial','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['testimonial']['args'] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.testimonial.png',
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 7,
        'supports' => array('title','editor','thumbnail'),
        '__on_front_page' => true
    );

    /* box for testimonial */
    $form['testimonial']['info']['name']                = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author name' , 'cosmotheme') . '</strong>' );
    $form['testimonial']['info']['title']               = array( 'type' => 'st--text' , 'label' => '<strong>' . __( 'Author title' , 'cosmotheme') . '</strong>' );
    $box['testimonial']['info']                         = array( __('Add testimoniall additional info' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['testimonial']['info'] , 'box' => 'info', 'update' => true );
    $box['testimonial']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );


    resources::$labels['testimonial']         = $res['testimonial']['labels'];
    resources::$type['testimonial']           = $res['testimonial']['args'];
    resources::$box['testimonial']            = $box['testimonial'];

    /*---------------------BOF "boxes" post type--------------------------*/
    $res['box']['labels'] = array(
        'name' => _x('Boxes', 'post type general name','cosmotheme'),
        'singular_name' => _x('Box', 'post type singular name','cosmotheme'),
        'add_new' => _x('Add New', __('Box','cosmotheme')),
        'add_new_item' => __('Add New Box','cosmotheme'),
        'edit_item' => __('Edit Box','cosmotheme'),
        'new_item' => __('New Box','cosmotheme'),
        'view_item' => __('View Box','cosmotheme'),
        'search_items' => __('Search Box','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res['box']['args'] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.boxes.png',
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 9,
        'supports' => array('title','editor'),
        'exclude_from_search' => true,
        '__on_front_page' => false
    );

    /* box for box */

    $form['box']['info']['box_img']         = array( 'type' => 'st--upload-id' , 'label' => __( 'Box image' , 'cosmotheme') , 'id' => 'info_box_img' , 'hint' => __( 'Upload or choose image from media library.' , 'cosmotheme' ) );
    $form['box']['info']['box_link']         = array( 'type' => 'st--text' , 'label' => __( 'Box link (optional)' , 'cosmotheme') , 'hint' => __('Make the box image and title clickable by adding a link here (optional)...','cosmotheme') );
    $form['box']['info']['background_color']            = array( 'type' => 'st--color-picker' , 'label' => __( 'Background color' , 'cosmotheme'), 'hint' => __('Add a custom CSS class to this box only.','cosmotheme') );
    $form['box']['info']['text_color']            = array( 'type' => 'st--color-picker' , 'label' => __( 'Text color' , 'cosmotheme'), 'hint' => __('Add a custom CSS class to this box only.','cosmotheme') );
    $form['box']['info']['custom_css']            = array( 'type' => 'st--text' , 'label' => __( 'Custom CSS class' , 'cosmotheme'), 'hint' => __('Add a custom CSS class to this box only.','cosmotheme') );
    
    $box['box']['info']                      = array( __('Box options' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['box']['info'] , 'box' => 'info', 'update' => true );
    //$box['box']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );


    resources::$labels['box']         = $res['box']['labels'];
    resources::$type['box']           = $res['box']['args'];
    resources::$box['box']            = $box['box'];

    /*---------------------EOF boxes post type--------------------------*/


    /*---------------------BOF teams post type--------------------------*/
    $res[ 'team' ][ 'labels' ] = array(
        'name' => __( 'Teams', 'cosmotheme' ),
        'singular_name' => __( 'Team', 'cosmotheme' ),
        'add_new' => __( 'Add New Team', 'cosmotheme' ),
        'add_new_item' => __( 'Add New Team', 'cosmotheme' ),
        'edit_item' => __( 'Edit Team', 'cosmotheme' ),
        'new_item' => __( 'New Team', 'cosmotheme' ),
        'view_item' => __( 'View Team', 'cosmotheme' ),
        'search_items' => __( 'Search Team', 'cosmotheme' ),
        'not_found' =>  __( 'Nothing found', 'cosmotheme' ),
        'not_found_in_trash' => __( 'Nothing found in Trash', 'cosmotheme' )
    );
    $res[ 'team' ][ 'args' ] = array(
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.team.png',
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 9,
        'supports' => array( 'title', 'editor' ),
        'exclude_from_search' => true,
        '__on_front_page' => false
    );


    $form[ 'team' ][ 'settings' ][ 'img' ]         = array( 'type' => 'st--upload-id' , 'label' => __( 'Team member photo' , 'cosmotheme') , 'id' => 'info_img' );
    $form[ 'team' ][ 'settings' ][ 'facebook' ]         = array( 'type' => 'st--text' , 'label' => __( 'Facebook' , 'cosmotheme') , 'id' => 'team_facebook', 'hint' => '(i.e. cosmo.themes)' );
    $form[ 'team' ][ 'settings' ][ 'twitter' ]         = array( 'type' => 'st--text' , 'label' => __( 'Twitter' , 'cosmotheme') , 'id' => 'team_twitter', 'hint' => '(i.e. cosmothemes)' );
    $form[ 'team' ][ 'settings' ][ 'linkedin' ]         = array( 'type' => 'st--text' , 'label' => __( 'LinkedIn' , 'cosmotheme') , 'id' => 'team_linkedin', 'hint' => '(i.e. http://www.linkedin.com/company/cosmothemes)' );
    $box[ 'team' ][ 'settings' ]                   = array( __( 'Team settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form[ 'team' ][ 'settings' ] , 'box' => 'info', 'update' => true );

    resources::$labels[ 'team' ]         = $res[ 'team' ][ 'labels' ];
    resources::$type[ 'team' ]           = $res[ 'team' ][ 'args' ];
    resources::$box[ 'team' ]            = $box[ 'team' ];

    /*---------------------EOF teams post type--------------------------*/


    /* post type portfolio */
    $res[ 'portfolio' ][ 'labels' ] = array(
        'name' => _x('Portfolios', 'post type general name','cosmotheme'),
        'singular_name' => _x(__('Portfolio','cosmotheme'), 'post type singular name'),
        'add_new' => _x('Add New', __('Portfolio','cosmotheme')),
        'add_new_item' => __('Add New Portfolio','cosmotheme'),
        'edit_item' => __('Edit Portfolio','cosmotheme'),
        'new_item' => __('New Portfolio','cosmotheme'),
        'view_item' => __('View Portfolio','cosmotheme'),
        'search_items' => __('Search Portfolio','cosmotheme'),
        'not_found' =>  __('Nothing found','cosmotheme'),
        'not_found_in_trash' => __('Nothing found in Trash','cosmotheme')
    );
    $res[ 'portfolio' ][ 'args' ] = array(
        'public' => true,
        'hierarchical' => false,
        'menu_position' => 3,
        '__on_front_page' => true,
        'supports' => array('title','editor','thumbnail','post-formats','comments','custom-fields','excerpt'),
        'menu_icon' => get_template_directory_uri() . '/lib/images/custom.portfolio.png',
        'has_archive' => true
    );

    /*=====================================================*/
    /*================------Slideshow-----=================*/
    /*=====================================================*/

    $struct[ 'slideshow' ][ 'box' ] = array(
        'layout' => 'B',
        'field-style' => 'line',
        'check-column' => array(
            'name' => 'idrow',
            'type' => 'hidden',
            'evisible' => false,
            'lvisible' => false,
        ),
        'icon-column' => array(
            'name' => 'slide',
            'type' => 'attachment',
            'attach_type' => 'background-image',
            'width' => 100,
            'height' => 100,
            'evisible' => false,
            'lvisible' => false,
        ),
        'info-column-0' => array(
            array(
                'name' => 'resources',
                'type' => 'hidden',
                'evisible' => true,
                'lvisible' => false,
                'post_link' => true,
            ),
            array(
                'name' => 'type_res',
                'type' => 'hidden',
                'evisible' => false,
                'lvisible' => false,
            ),
            array(
                'name' => 'title',
                'type' => 'text',
                'label' => __( 'Slide title' , 'cosmotheme' ),
                'before' => '<h2>',
                'after' => '</h2>',
                'evisible' => false,
                'lvisible' => true,
            ),
            array(
                'name' => 'title_color',
                'type' => 'color-picker',
                'label' => __( 'Title text color' , 'cosmotheme' ),
                'evisible' => false,
                'lvisible' => true
            ),
            array(
                'name' => 'description',
                'type' => 'textarea',
                'label' => __( 'Description' , 'cosmotheme' ),
                'evisible' => false,
                'lvisible' => true
            ),
            array(
                'name' => 'description_color',
                'type' => 'color-picker',
                'label' => __( 'Description text color' , 'cosmotheme' ),
                'evisible' => false,
                'lvisible' => true
            ),
            array(
                'name' => 'animation_type',
                'type' => 'select',
                'label' => __( 'Slideshow animation type' ,   'cosmotheme' ),
                'assoc' => array(
                    'horizontal' => __( 'Horizontal slide' ,   'cosmotheme'  ),
                    'vertical' => __( 'Vertical slide' ,   'cosmotheme'  ),
                ),
                'evisible' => false,
                'lvisible' => true,
            ),
            // array(
            //     'name' => 'background_position',
            //     'type' => 'select',
            //     'label' => __( 'Background position' , 'cosmotheme' ),
            //     'assoc' => array(
            //         'left' => __( 'Left' , 'cosmotheme' ),
            //         'center' => __( 'Center' , 'cosmotheme' ),
            //         'right' => __( 'Right' , 'cosmotheme' )
            //     ),
            //     'evisible' => false,
            //     'lvisible' => true,
            // ),
            // array(
            //     'name' => 'background_repeat',
            //     'type' => 'select',
            //     'label' => __( 'Background repeat' , 'cosmotheme' ),
            //     'assoc' => array(
            //         'no-repeat' => __( 'No repeat' , 'cosmotheme' ),
            //         'repeat' => __( 'Tile' , 'cosmotheme' ),
            //         'repeat-x' => __( 'Tile horizontally' , 'cosmotheme' ),
            //         'repeat-y' => __( 'Tile vertically' , 'cosmotheme' )
            //     ),
            //     'evisible' => false,
            //     'lvisible' => true,
            // ),
            // array( 
            //     'name' => 'background_attachment',
            //     'type' => 'select',
            //     'label' => __( 'Background attachment type' , 'cosmotheme' ),
            //     'assoc' => array(
            //         'scroll' => __( 'Scroll' , 'cosmotheme' ),
            //         'fixed' => __( 'Fixed' , 'cosmotheme' )
            //     ),
            //     'evisible' => false,
            //     'lvisible' => true,
            // )
        ),
        'actions' => array(
            0 => array( 'slug' => 'edit' , 'label' => 'edit' ,  'args' => array( 'res' => 'slideshow' , 'box' => 'box' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#slideshow_box div.inside div#box_slideshow_box' ) ),
            1 => array( 
                'slug' => 'update' , 
                'label' => 'update' , 
                'args' => array( 
                    'res' => 'slideshow' , 
                    'box' => 'box' , 
                    'post_id' => '' , 
                    'index' => '' , 
                    'data' => array( 
                        'input' =>  "['slideshow-box-slide_id' , 
                                    'slideshow-box-slide' , 
                                    'slideshow-box-title', 
                                    'slideshow-box-title_color',
                                    'slideshow-box-description', 
                                    'slideshow-box-description_color',
                                    'slideshow-box-slider_caption',
                                    'slideshow-box-animation_type',
                                    'slideshow-box-background_color',
                                    'slideshow-box-background_position',
                                    'slideshow-box-background_repeat',
                                    'slideshow-box-background_attachment' ]" 
                        ), 
                        'selector' => 'div#slideshow_box div.inside div#box_slideshow_box' 
                 ) 
            ),
            2 => array( 'slug' => 'del' , 'label' => 'delete' , 'args' => array( 'res' => '' , 'box' => '' , 'post_id' => '' , 'index' => '' , 'selector' => 'div#slideshow_box div.inside div#box_slideshow_box' ) )
        )
    );

    $sl_res = array( 'none' => __( 'Simple image' , 'cosmotheme' ) , 'post' => __( 'Post' , 'cosmotheme' ) );

    $form['slideshow']['box']['type_res']   = array( 'type' => 'st--m-select' , 'label' => __( 'Select slider type' , 'cosmotheme') , 'value' =>  $sl_res , 'action' => "act.select('#type_resource' , { 'post' : '.mis-hint .generic-hint , .slider_resources' }, 'sh_');" , 'id' => 'type_resource' );
    $form['slideshow']['box'][ 'resources' ]  = array( 'type' => 'st--m-search' , 'label' => __( 'Select a post' , 'cosmotheme' ) , 'classes' => 'slider_resources hidden' , 'query' => array( 'post_type' => 'post' , 'post_status' => 'publish' ) , 'action' => "act.search( this , '-');", 'hint'=>__('Start typing the post title','cosmotheme') );
    $form['slideshow']['box']['slide' ]      = array( 'type' => 'st--m-upload-id' , 'label' => __( 'Choose a background image for this slide' , 'cosmotheme') , 'id' => 'box_slide' , 'hint' =>  __( 'If not uploaded will use post Featured image' , 'cosmotheme' ) , 'classes' => 'mis-hint' , 'hclass' => 'hidden' );

    $form['slideshow']['box']['title']		= array( 'type' => 'st--m-text' , 'label' =>  __( 'Slide title' , 'cosmotheme' ) , 'hint' => __( 'If not completed will use post title' , 'cosmotheme'  ) , 'classes' => 'mis-hint' , 'hclass' => 'hidden' );
    $form[ 'slideshow' ][ 'box' ][ 'title_color' ]= array(
            'type' => 'st--m-color-picker',
            'label' => __( 'Title text color' , 'cosmotheme' ),
            'set' => 'slider-title_color',
    );

    $form[ 'slideshow' ][ 'box' ][ 'description' ] = array(
        'type' => 'st--m-textarea',
        'label' => __( 'Description' , 'cosmotheme' ),
        'id' => 'slider_caption'
    );

    $form[ 'slideshow' ][ 'box' ][ 'description_color' ] = array(
            'type' => 'st--m-color-picker',
            'label' => __( 'Description text color' , 'cosmotheme' ),
            'set' => 'slider-description_color',
    );

    $form[ 'slideshow' ][ 'box' ][ 'animation_type' ] = array(
        'type' => 'st--m-select',
        'label' => __( 'Slideshow animation type' , 'cosmotheme' ),
        'value' => array(
            'horizontal' => __( 'Horizontal slide' ,   'cosmotheme'  ),
            'vertical' => __( 'Vertical slide' ,   'cosmotheme'  ),
        ),
        'id' => 'slider_animation_type'
    );

    // $form[ 'slideshow' ][ 'box' ][ 'background_position' ] = array(
    //     'type' => 'st--m-select',
    //     'label' => __( 'Image background position' , 'cosmotheme' ),
    //     'value' => array(
    //         'left' => __( 'Left' , 'cosmotheme' ),
    //         'center' => __( 'Center' , 'cosmotheme' ),
    //         'right' => __( 'Right' , 'cosmotheme' )
    //     ),
    //     'id' => 'slider_background-image-position'
    // );

    // $form[ 'slideshow' ][ 'box' ][ 'background_repeat' ] = array(
    //     'type' => 'st--m-select',
    //     'label' => __( 'Image background repeat' , 'cosmotheme' ),
    //     'value' => array(
    //         'repeat' => __( 'Tile' , 'cosmotheme' ),
    //         'no-repeat' => __( 'No Repeat' , 'cosmotheme' ),
    //         'repeat-x' => __( 'Tile Horizontally' , 'cosmotheme' ),
    //         'repeat-y' => __( 'Tile Vertically' , 'cosmotheme' )
    //     ),
    //     'id' => 'slider_background-image-repeat'
    // );

    // $form[ 'slideshow' ][ 'box' ][ 'background_attachment' ] = array(
    //     'type' => 'st--m-select',
    //     'label' => __( 'Image background attachment type' , 'cosmotheme' ),
    //     'value' => array(
    //         'fixed' => __( 'Fixed' , 'cosmotheme' ),
    //         'scroll' => __( 'Scroll' , 'cosmotheme' )
            
    //     ),
    //     'id' => 'slider_background-image-attachment-type'
    // );

    $form['slideshow']['box']['submit']     = array( 'type' => 'st--meta-save' ,  'value' => __( 'Add to slideshow' ,'cosmotheme' ) , 'selector' => 'div#slideshow_box div.inside div#box_slideshow_box'  );

    if(isset($_GET['post'])){
        $slideshow_settings = meta::get_meta( $_GET['post'], 'slidesettings' );
        if( (isset($slideshow_settings['slideshowSource']) && $slideshow_settings['slideshowSource'] == 'none') || !isset($slideshow_settings['slideshowSource'])){
            $add_manual_hint = 'add-manual-hint';
            $add_automat_hint = 'add-automat-hint hidden';
            $number_posts = 'number_posts hidden';    
        }else{
            $add_manual_hint = 'add-manual-hint hidden';
            $add_automat_hint = 'add-automat-hint ';
            $number_posts = 'number_posts ';
        }
    }else{
        $add_manual_hint = 'add-manual-hint';
        $add_automat_hint = 'add-automat-hint hidden';
        $number_posts = 'number_posts hidden';
    }

    $form[ 'slideshow' ][ 'slidesettings' ]      = array(

        'slideshowSource' => array(
            'type' => 'st--select',
            'label' => __( 'Slides source' ,   'cosmotheme' ),
            'value' => array(
                'none' => __( 'None(user defined)' ,   'cosmotheme' ),
                'latest_posts' => __( 'Latest posts' ,   'cosmotheme'  ),
                'latest_portfolios' => __( 'Latest portfolios' ,   'cosmotheme'  ),
                'featured_posts' => __( 'Latest featured posts' ,   'cosmotheme'  )
            ),
            'classes' => 'slide_source', 
            'action' => "act.select('#slide_source' , {  'none' : '.add-manual-hint', 'latest_posts' : '.add-automat-hint, .number_posts' , 'latest_portfolios' : '.add-automat-hint, .number_posts', 'featured_posts' : '.add-automat-hint, .number_posts' }, 'sh_');" ,
            'id' => 'slide_source'
        ),

        'hint-manual' => array(
            'type' => 'st--hint',
            'value' => __( 'Use Additional slideshow items box below to populate your slideshow manualy.' , 'cosmotheme' ),
            'classes' => $add_manual_hint
        ),
        'hint-automat' => array(
            'type' => 'st--hint',
            'value' => __( 'Select this value if you wish to automatically populate your slideshow. Use Additional slideshow items box below to add additional images.' , 'cosmotheme' ),
            'classes' => $add_automat_hint
        ),
        'numberOfPosts' => array(
            'type' => 'st--digit',
            'label' => __( 'Number of posts' ,   'cosmotheme'  ),
            'hint' => __( 'Select number of posts that will be inserted automatically in the slideshow' ,   'cosmotheme'  ),
            'classes' => $number_posts,
            'cvalue' => 5
        ),
        
    );


    $box[ 'slideshow' ][ 'slidesettings' ]       = array( __( 'Slideshow Settings' , 'cosmotheme' ) , 'normal' , 'low' , 'content' => $form[ 'slideshow' ][ 'slidesettings' ] , 'box' => 'slidesettings' , 'update' => true  );
    $box['slideshow']['box']                = array( __('Compose slideshow (drag and drop items to rearange position)' , 'cosmotheme' ) , 'normal' , 'low' , 'content' => $form['slideshow']['box'] , 'box' => 'box' , 'struct' => $struct['slideshow']['box'] , 'callback' => array( 'get_meta_records' , array( 'slideshow' , 'box' , 'box' ) ) , 'records-title' => __('Slideshow items' , 'cosmotheme' ) );
    $form['slideshow']['manager']['link']   = array( 'type' => 'sh--post-upload' , 'title' => __( 'Manage Slideshow' , 'cosmotheme' ) );

    $box['slideshow']['manager']            = array( __('Manage Slideshow' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['slideshow']['manager'] , 'box' => 'manager' );


    resources::$labels['slideshow']         = $res['slideshow']['labels'];
    resources::$type['slideshow']           = $res['slideshow']['args'];
    resources::$box['slideshow']            = $box['slideshow'];

    resources::$labels['portfolio']         = $res['portfolio']['labels'];
    resources::$type['portfolio']           = $res['portfolio']['args'];

    /* standard post */
    $form['post']['layout']['type']         = array( 'type' => 'sh--select' , 'label' =>  __( 'Select layout type' , 'cosmotheme' ) , 'value' => array( 'right' => __( 'Right Sidebar'  , 'cosmotheme' ) , 'left' => __( 'Left Sidebar' , 'cosmotheme' ) , 'full' => __( 'Full Width' , 'cosmotheme' )  ) , 'action' => "act.select( '#post_layout' , { 'full' : '.sidebar_list' } , 'hs_');" , 'id' => 'post_layout' , 'ivalue' =>  options::get_value( 'layout' , 'single' ) );
    $form['post']['layout']['sidebar']      = array( 'type' => 'sh--select' , 'label' =>  __( 'Select sidebar' , 'cosmotheme' ) , 'value' => $sidebar_value , 'classes' => $classes );
    $form['post']['layout']['link']         = array( 'type' => 'sh--link' , 'url' => 'admin.php?page=cosmothemes___sidebar' , 'title' => __( 'Add new Sidebar' , 'cosmotheme' ) );

    if( options::get_value( 'layout' , 'single' ) == 'full' ){
        $form['post']['layout']['sidebar']['classes'] = $classes . ' hidden';
        $form['post']['layout']['link']['classes'] = $classes .' hidden';
    }

    $form['post']['settings']['related']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show related posts' , 'cosmotheme' ) , 'hint' => __( 'Show related posts on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'blog_post' , 'show_similar' ) );
    $form['post']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show post meta' , 'cosmotheme' ) , 'hint' => __( 'Show post meta on this post' , 'cosmotheme' ) , 'cvalue' => options::get_value(  'general' , 'meta' ), 'action' => "act.check( this , { 'yes' : '.meta_view'  } , 'sh');" );
	$meta_view_type = array('horizontal' => __('Horizontal','cosmotheme'), 'vertical' => __('Vertical','cosmotheme') );  

	$form['post']['settings']['love']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show post love' , 'cosmotheme' ) , 'hint' => __( 'Show post love on this post' , 'cosmotheme' )  , 'cvalue' => options::get_value(  'general' , 'enb_likes' ) );
    $form['post']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => __( 'Show social sharing on this post'  , 'cosmotheme' ) , 'cvalue' => options::get_value( 'blog_post' , 'post_sharing' ) );
    $form['post']['settings']['show_feat_on_archive'] = array( 'type' => 'st--logic-radio' , 'label' => __( 'Display featured image on archive pages' , 'cosmotheme' ) ,  'cvalue' => options::get_value( 'blog_post' , 'show_feat_on_archive' ) );
    $form['post']['settings']['post_bg']    = array( 'type' => 'st--upload' , 'label' => __( 'Upload or choose image from media library' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'This will be the background image for this post' , 'cosmotheme' ) );
    $form['post']['settings']['position']   = array( 'type' => 'st--select' , 'label' => __( 'Image background position' , 'cosmotheme' ) , 'value' => array( 'left' => __( 'Left' , 'cosmotheme' ) , 'center' => __( 'Center' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) ) );
    $form['post']['settings']['repeat']     = array( 'type' => 'st--select' , 'label' => __( 'Image background repeat' , 'cosmotheme' ) , 'value' => array( 'no-repeat' => __( 'No Repeat' , 'cosmotheme' ) , 'repeat' => __( 'Tile' , 'cosmotheme' ) , 'repeat-x' => __( 'Tile Horizontally' , 'cosmotheme' ) , 'repeat-y' => __( 'Tile Vertically' , 'cosmotheme' ) ) );
    $form['post']['settings']['attachment'] = array( 'type' => 'st--select' , 'label' => __( 'Image background attachment type' , 'cosmotheme' ) , 'value' => array( 'scroll' => __( 'Scroll' , 'cosmotheme' ) , 'fixed' => __( 'Fixed' , 'cosmotheme' ) ) );
    $form['post']['settings']['color']      = array( 'type' => 'st--color-picker' , 'label' => __( 'Set background color for this post' , 'cosmotheme' ) );

    if( isset( $_GET['post'] ) ){
        $post_format = get_post_format( $_GET['post'] );
    }else{
        $post_format = 'standard';
    }
    
    $form['post']['format']['type']         = array( 'type' => 'st--select' , 'label' => __( 'Select post format' , 'cosmotheme' ) , 'value' => array(  'standard' => __( 'Standard' , 'cosmotheme' ) , 'video' => __( 'Video' , 'cosmotheme' ) , 'image' => __( 'Image' , 'cosmotheme' ) , 'audio' => __( 'Audio' , 'cosmotheme' )  , 'link' => __( 'Attachment' , 'cosmotheme' ), 'gallery' => __( 'Gallery' , 'cosmotheme' ) )  , 'action' => "act.select( '.post_format_type' , { 'video' : '.post_format_video' , 'image' : '.post_format_image' , 'audio' : '.post_format_audio' , 'link' : '.post_format_link', 'gallery' : '.post_format_gallery' } , 'sh_' );" , 'iclasses' => 'post_format_type' , 'ivalue' =>  $post_format );

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'video' ){
		$form['post']['format']['video']=array('type'=>'ni--form-upload', 'format'=>'video', 'classes'=>"post_format_video", 'post_id'=>$_GET['post']);
//         $form['post']['format']['video']        = array( 'type' => 'st--text' , 'label' => __( 'Set video URL ( YouTube , Vimeo or self hosted )' , 'cosmotheme' ) , 'hint' => __( 'If a valid YouTube, Vimeo or self hosted URL is provided, the embeded video <br /> for the provided link will be appended at the beginning of the post <br /> content. Otherwise it will be ignored.' , 'cosmotheme' ) , 'classes' => 'post_format_video' );
    }else{
		$form['post']['format']['video']=array('type'=>'ni--form-upload', 'format'=>'video', 'classes'=>"hidden post_format_video");
//         $form['post']['format']['video']        = array( 'type' => 'st--text' , 'label' => __( 'Set video URL ( YouTube , Vimeo )' , 'cosmotheme' ) , 'hint' => __( 'If a valid YouTube or Vimeo URL is provided, the embeded video <br /> for the provided link will be appended at the beginning of the post <br /> content. Otherwise it will be ignored.' , 'cosmotheme' ) , 'classes' => 'post_format_video hidden' );
    }

	
	$form['post']['format']['init']=array('type'=>"no--form-upload-init");

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'image' ){
		$form['post']['format']['image']=array('type'=>'ni--form-upload', 'format'=>'image', 'classes'=>"post_format_image", 'post_id'=>$_GET['post']);
//         $form['post']['format']['image']        = array( 'type' => 'st--hint' , 'label' => '' , 'value' => __( 'Please set featured image'  , 'cosmotheme' )  , 'classes' => 'post_format_image' );
    }else{
		$form['post']['format']['image']=array('type'=>'ni--form-upload', 'format'=>'image', 'classes'=>"post_format_image hidden");
//         $form['post']['format']['image']        = array( 'type' => 'st--hint' , 'label' => '' , 'value' => __( 'Please set featured image'  , 'cosmotheme' )  , 'classes' => 'post_format_image hidden' );
    }

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'gallery' ){
        $form['post']['format']['gallery']=array('type'=>'ni--form-upload', 'format'=>'gallery', 'classes'=>"post_format_gallery", 'post_id'=>$_GET['post']);
    }else{
        $form['post']['format']['gallery']=array('type'=>'ni--form-upload', 'format'=>'gallery', 'classes'=>"post_format_gallery hidden");
    }

    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'audio' ){
		$form['post']['format']['audio']=array('type'=>'ni--form-upload', 'format'=>'audio', 'classes'=>"post_format_audio", 'post_id'=>$_GET['post']);
//         $form['post']['format']['audio']        = array( 'type' => 'st--upload' , 'label' => __( 'Please add audio file or URL'  , 'cosmotheme' )  , 'classes' => 'post_format_audio' , 'id' => 'format_audio' , 'hint' => __( 'Please use  only MP3 files' , 'cosmotheme' ) );
    }else{
		$form['post']['format']['audio']=array('type'=>'ni--form-upload', 'format'=>'audio', 'classes'=>"post_format_audio hidden");
//         $form['post']['format']['audio']        = array( 'type' => 'st--upload' , 'label' => __( 'Please add audio file or URL'  , 'cosmotheme' )  , 'classes' => 'post_format_audio hidden' , 'id' => 'format_audio' , 'hint' => __( 'Please use  only MP3 files' , 'cosmotheme' ) );
    }
    
    if( isset( $_GET['post'] ) && get_post_format( $_GET['post'] ) == 'link' ){
		$form['post']['format']['link']=array('type'=>'ni--form-upload', 'format'=>'link', 'classes'=>"post_format_link", 'post_id'=>$_GET['post']);
//         $form['post']['format']['link']        = array( 'type' => 'st--upload-id' , 'label' => __( 'Please add attachment file or URL'  , 'cosmotheme' )  , 'classes' => 'post_format_link' , 'id' => 'format_link' , 'hint' => __( 'Please use only .ZIP, .RAR, .DOC, .DOCX, .PDF files' , 'cosmotheme' ) );
    }else{
		$form['post']['format']['link']=array('type'=>'ni--form-upload', 'format'=>'link', 'classes'=>"post_format_link hidden");
//         $form['post']['format']['link']        = array( 'type' => 'st--upload-id' , 'label' => __( 'Please add attachment file or URL'  , 'cosmotheme' )  , 'classes' => 'post_format_link hidden' , 'id' => 'format_link' , 'hint' => __( 'Please use only .ZIP, .RAR, .DOC, .DOCX, .PDF files' , 'cosmotheme' ) );
    }

    if( !(isset($_GET['post']) || (isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio' )  )  ){ /*this will show up only for portfolios because we don't need it for posts*/
        $form['post']['source']['post_source']   = array( 'type' => 'st--text' , 'label' => __( 'Source' , 'cosmotheme' ) , 'hint' => __( 'Example: http://cosmothemes.com' , 'cosmotheme' ) );
    }
    
    $box['post']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['post']['layout']                  = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['post']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['post']['settings']                = array( __('Post Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['settings'] , 'box' => 'settings' , 'update' => true  );
    $box['post']['format']                  = array( __('Post Format' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['format'] , 'box' => 'format' , 'update' => true );
    if( !(isset($_GET['post']) || (isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio' )  )  ){ /*this will show up only for portfolios because we don't need it for posts*/
        $box['post']['source']                  = array( __('Post Source' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['post']['source'] , 'box' => 'source' , 'update' => true );
    }

    resources::$type['post']                = array();
    resources::$box['post']                 = $box['post'];


    resources::$box[ 'portfolio' ]          = $box[ 'post' ];

    if(isset($_GET['post'])){
        $the_source = post::get_source($_GET['post']);
    }
    if( (isset($_GET['post']) || (isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio' )  )  ){ /*show source box only if it is globally enabled, or it has value*/
        
        $form[ 'portfolio' ][ 'source' ][ 'post_source' ]   = array( 'type' => 'st--text' , 'label' => __( 'Source' , 'cosmotheme' ) , 'hint' => __( 'Example: http://cosmothemes.com' , 'cosmotheme' ) );
        $form[ 'portfolio' ][ 'source' ][ 'post_client' ]   = array( 'type' => 'st--text' , 'label' => __( 'Client' , 'cosmotheme' ) , 'hint' => __( 'Example: John Doe' , 'cosmotheme' ) );
        $form[ 'portfolio' ][ 'source' ][ 'post_services' ] = array( 'type' => 'st--text' , 'label' => __( 'Services' , 'cosmotheme' ) , 'hint' => __( 'Example: Graphic design, Print' , 'cosmotheme' ) );
        resources::$box['portfolio']['source']   = array( __('Portfolio details' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['portfolio']['source'] , 'box' => 'source' , 'update' => true );
    }

    $form[ 'page' ][ 'settings' ][ 'love' ] = array( 
        'type' => 'st--logic-radio' , 
        'label' => __( 'Show post love' , 'cosmotheme' ) , 
        'hint' => __( 'Show post love on this post' , 'cosmotheme' )  ,
        'cvalue' => options::get_value(  'general' , 'enb_likes' )
    );
    $form['page']['layout']['type']         = array( 'type' => 'sh--select' , 'label' =>  __( 'Select layout type' , 'cosmotheme' ) , 'value' => array( 'right' => __( 'Right Sidebar'  , 'cosmotheme' ) , 'left' => __( 'Left Sidebar' , 'cosmotheme' ) , 'full' => __( 'Full Width' , 'cosmotheme' )  ) , 'action' => "act.select( '#post_layout' , { 'full' : '.sidebar_list' } , 'hs_');" , 'id' => 'post_layout' , 'ivalue' =>  options::get_value( 'layout' , 'page' ) );
    $form['page']['layout']['sidebar']      = array( 'type' => 'sh--select' , 'label' =>  __( 'Select sidebar' , 'cosmotheme' ) , 'value' => $sidebar_value , 'classes' => $classes );
    $form['page']['layout']['link']         = array( 'type' => 'sh--link' , 'url' => 'admin.php?page=cosmothemes___sidebar' , 'title' => __( 'Add new Sidebar' , 'cosmotheme' ) );

    if( options::get_value( 'layout' , 'page' ) == 'full' ){
        $form['page']['layout']['sidebar']['classes'] = $classes . ' hidden';
        $form['page']['layout']['link']['classes'] = $classes .' hidden';
    }
    
    $form['page']['settings']['meta']       = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show page meta' , 'cosmotheme' ) , 'hint' => 'Show post meta on this page' , 'cvalue' => 'no' );
    $form['page']['settings']['sharing']    = array( 'type' => 'st--logic-radio' , 'label' => __( 'Show social sharing' , 'cosmotheme' ) , 'hint' => 'Show social sharing on this page' , 'cvalue' => options::get_value( 'blog_post' , 'page_sharing' ) );
    $form['page']['settings']['post_bg']    = array( 'type' => 'st--upload' , 'label' => __( 'Upload image, or choose from media library.' , 'cosmotheme') , 'id' => 'post_background' , 'hint' => __( 'This will be the background image for this page' , 'cosmotheme' ) );
    $form['page']['settings']['position']   = array( 'type' => 'st--select' , 'label' => __( 'Background position' , 'cosmotheme' ) , 'value' => array( 'left' => __( 'Left' , 'cosmotheme' ) , 'center' => __( 'Center' , 'cosmotheme' ) , 'right' => __( 'Right' , 'cosmotheme' ) ) );
    $form['page']['settings']['repeat']     = array( 'type' => 'st--select' , 'label' => __( 'Background repeat' , 'cosmotheme' ) , 'value' => array( 'no-repeat' => __( 'No Repeat' , 'cosmotheme' ) , 'repeat' => __( 'Tile' , 'cosmotheme' ) , 'repeat-x' => __( 'Tile Horizontally' , 'cosmotheme' ) , 'repeat-y' => __( 'Tile Vertically' , 'cosmotheme' ) ) );
    $form['page']['settings']['attachment'] = array( 'type' => 'st--select' , 'label' => __( 'Background attachment type' , 'cosmotheme' ) , 'value' => array( 'scroll' => __( 'Scroll' , 'cosmotheme' ) , 'fixed' => __( 'Fixed' , 'cosmotheme' ) ) );
    $form['page']['settings']['color']      = array( 'type' => 'st--color-picker' , 'label' => __( 'Set background color for this post' , 'cosmotheme' ) );

    $box['page']['shcode']                  = array( __('Shortcodes' , 'cosmotheme' ) , 'normal' , 'high'  , 'box' => 'shcode' , 'includes' => 'shcode/main.php' );
    $box['page']['layout']                  = array( __('Layout and Sidebars' , 'cosmotheme' ) , 'side' , 'low' , 'content' => $form['page']['layout'] , 'box' => 'layout' , 'update' => true  );
    $box['page']['settings']                = array( __('Page Settings' , 'cosmotheme' ) , 'normal' , 'high' , 'content' => $form['page']['settings'] , 'box' => 'settings' , 'update' => true  );
    
    
    resources::$type['page']                = array();
    resources::$box['page']                 = $box['page'];
?>