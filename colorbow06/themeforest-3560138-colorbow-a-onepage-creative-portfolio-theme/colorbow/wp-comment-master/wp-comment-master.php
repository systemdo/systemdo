<?php

/*

Plugin Name: wp-comment-master

Plugin URI: 

Description: an elegant and must-have comment plugin to better satisfy your visitors, it has two main features: AJAX comment posting and comment paginitaion.

Version: 1.7

Author: 

Author URI: 

*/



add_action('wp_enqueue_scripts', 'wpcm');


function wpcm(){

   if(!is_admin()){

     
      //if(is_singular()) 
	  wp_enqueue_script('paginating_js', get_template_directory_uri().'/wp-comment-master/cm.js',array('jquery'),'',true);

      //if(is_singular()) 
	  wp_enqueue_style('paginating_css', get_template_directory_uri().'/wp-comment-master/cm.css','',true);

      wp_localize_script('paginating_js','yjlSettings',array(

           'pagination'=>get_option('com_paging'),

            'comPerpage'=>get_option('com_per_page'),

            'numPerpage'=>get_option('num_per_page'),   

            'pagerPos'=>get_option('pager_pos'),

            'repForm'=>get_option('rep_form','disable'),

            'gifUrl'=>get_template_directory_uri().'/wp-comment-master/ajax-loader.gif',

            'prev'=>get_option('yjlprev'),

            'next'=>get_option('yjlnext'),

            'timeOut'=>get_option('yjltimeout'),

            'fast'=>get_option('yjlfast'),

            'thank'=>get_option('yjlthank'),

            'order'=>get_option('comment_order') 

      ));

   }

}



add_action('admin_init', 'wpcm_admin_init');

function wpcm_admin_init(){

   wp_enqueue_script('admin_js', get_template_directory_uri().'/wp-comment-master/admin.js',array('jquery'),'',true);

}



add_action('admin_menu', 'mt_add_pages');

// action function for above hook

function mt_add_pages() {

    add_options_page('WP-comment-master','WP-comment-master', 'administrator', 'WP-comment-master', 'YJL_options');

    add_action( 'admin_init', 'register_mysettings' );

}



function register_mysettings() {

	//register our settings

         register_setting( 'YJL-settings-group', 'com_paging' );

 	 register_setting( 'YJL-settings-group', 'com_per_page' );

  	 register_setting( 'YJL-settings-group', 'num_per_page' );

	 register_setting( 'YJL-settings-group', 'pager_pos' );

         register_setting( 'YJL-settings-group', 'rep_form' );

         register_setting( 'YJL-settings-group', 'yjlprev' );

         register_setting( 'YJL-settings-group', 'yjlnext' );

         register_setting( 'YJL-settings-group', 'yjltimeout' );

         register_setting( 'YJL-settings-group', 'yjlfast' );

         register_setting( 'YJL-settings-group', 'yjlthank' );

}



function YJL_options() { ?>

   <div class="wrap">

      <h2><?php _e('WP-Comment-Master Settings:','cosmotheme'); ?></h2>

      <form method="post" action="options.php">

       <?php settings_fields( 'YJL-settings-group' ); ?>

        <table class="form-table">       

        <tr valign="top" >

          <th scope="row"><?php _e('Reposition the comment form before all comments','cosmotheme'); ?></th>

          <td>

            <?php $rep_form=get_option('rep_form','disable');?>

          <input type="radio" name="rep_form" value="enable" <?php if( $rep_form!='disable')echo 'checked';?> ><?php _e('Enable ','cosmotheme'); ?>

          <input type="radio" name="rep_form" value="disable" <?php if( $rep_form=='disable')echo 'checked';?>  ><?php _e('Disable','cosmotheme'); ?>

          </td></tr>       



<tr valign="top">

          


         <tr valign="top">

          <th scope="row"><strong><?php _e('Pagination settings:','cosmotheme'); ?></strong></th>

           <td></td>

          </tr>



        <tr valign="top">

          <th scope="row"><?php _e('Comment Pagination','cosmotheme'); ?></th>

          <td>  

              <?php $com_paging=get_option('com_paging');?>

                <input type="radio" name="com_paging" value="enable" <?php if( $com_paging!='disable')echo 'checked';?> ><?php _e('Enable','cosmotheme'); ?>

                <input type="radio" name="com_paging" value="disable" <?php if( $com_paging=='disable')echo 'checked';?>  ><?php _e('Disable','cosmotheme'); ?>

          </td>

          </tr>



          <tr valign="top">

            <th scope="row"><?php _e('Comments per page','cosmotheme'); ?></th>

            <td><input name="com_per_page" id="com-per-page" value="<?php echo get_option('com_per_page'); ?>" /><br><?php _e('(If you enable threaded comments,threaded comments does not count towards this number.)','cosmotheme'); ?></td>

          </tr>

          <tr valign="top">

          <th scope="row"><?php _e('Number of page-number to show','cosmotheme'); ?></th>

          <td>  <select id="num_per_page" name="num_per_page">

              <?php $num_per_page=get_option('num_per_page');?>

                <option value="5" <?php if($num_per_page==5)echo 'selected';?>  >5</option>

                <option value="3" <?php if($num_per_page==3)echo 'selected';?> >3</option>  

                <option value="7" <?php if($num_per_page==7)echo 'selected';?>  >7</option>

                <option value="9" <?php if($num_per_page==9)echo 'selected';?>  >9</option>

                <option value="11" <?php if($num_per_page==11)echo 'selected';?>  >11</option>

                <option value="13" <?php if($num_per_page==13)echo 'selected';?>  >13</option>

             </select><?php _e('(default 5)','cosmotheme'); ?>             

          </td>

          </tr>

          <tr valign="top">

          <th scope="row"><?php _e('Page-number position','cosmotheme'); ?>  </th>

          <td>  

               <?php $pager_pos=get_option('pager_pos');?>

                <input type="radio" name="pager_pos" value="before" <?php if( $pager_pos!='after'&& $pager_pos!='both')echo 'checked';?> ><?php _e('Before comments','cosmotheme'); ?><br>

                <input type="radio" name="pager_pos" value="after" <?php if( $pager_pos=='after')echo 'checked';?>  ><?php _e('After comments','cosmotheme'); ?><br>

                <input type="radio" name="pager_pos" value="both" <?php if( $pager_pos=='both')echo 'checked';?>  ><?php _e('Both before and after comments','cosmotheme'); ?>

          </td>

          </tr>       



         <tr valign="top">

          <th scope="row"><strong><?php _e('Custom output Text:','cosmotheme'); ?></stong></th>

           <td></td>

          </tr>

         <tr valign="top">

          <th scope="row"><?php _e('Default Text:','cosmotheme'); ?></th>

           <td><?php _e('Custom Text:','cosmotheme'); ?></td>

          </tr>



          <tr valign="top">

            <th scope="row"><?php _e("'Prev'",'cosmotheme'); ?></th>

            <td><input name="yjlprev" id="yjlprev" value="<?php echo get_option('yjlprev'); ?>" /></td>

          </tr>

           <tr valign="top">

           <th scope="row"><?php _e("'Next'",'cosmotheme'); ?></th>

            <td><input name="yjlnext" id="yjlnext" value="<?php echo get_option('yjlnext'); ?>" /></td>

          </tr>

           <tr valign="top">

            <th scope="row"><?php _e("'Error:Server time out,try again!'",'cosmotheme'); ?></th>

            <td><input name="yjltimeout" id="yjltimeout" value="<?php echo get_option('yjltimeout'); ?>" /></td>

          </tr>

           <tr valign="top">

            <th scope="row"><?php _e("'Please slow down,you are posting to fast!'",'cosmotheme'); ?></th>

            <td><input name="yjlfast" id="yjlfast" value="<?php echo get_option('yjlfast'); ?>" /></td>

          </tr>



           <tr valign="top">

            <th scope="row"><?php _e("'Thank you for your comment!'",'cosmotheme'); ?></th>

            <td><input name="yjlthank" id="yjlthank" value="<?php echo get_option('yjlthank'); ?>" /></td>

          </tr>



          </table>

        <p class="submit">

         <input type="submit" class="button-primary" value="Save Changes" />

       </p>

     </form>

  
   </div>

<?php } ?>