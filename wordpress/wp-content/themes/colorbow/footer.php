
        <footer id="colophon" role="contentinfo" data-role="footer" data-position="fixed" data-fullscreen="true">
            <div class="row " id="footerCopyright">
                <div class="five columns"> 
                    <p class="copyright"><?php echo str_replace('%year%',date('Y') , options::get_value('general' , 'copy_right') ); ?></p>
                </div>
                <div class="seven columns">
                    <?php echo menu( 'footer_menu' , array( 'class' => 'right no-margin' , 'number-items' => 20  , 'current-class' => 'active','type' => 'category') ); ?>    
                </div>
            </div>
            
        </footer>  
    </div>
    
    <div class="overlay">&nbsp;</div>
        
    <script type="text/javascript">
        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
    
    <!-- init ajaxurl -->
    <script type="text/javascript">
        <?php
            $siteurl = get_option('siteurl');
            if( !empty($siteurl) ){
                $siteurl = rtrim( $siteurl , '/') . '/wp-admin/admin-ajax.php' ;
            }else{
                $siteurl = home_url('/wp-admin/admin-ajax.php');
            }
        ?>

        var ajaxurl = "<?php echo $siteurl; ?>";
        var cookies_prefix = "<?php echo ZIP_NAME; ?>";  
        var themeurl = "<?php echo get_template_directory_uri(); ?>";
        jQuery( function(){
            jQuery( '.demo-tooltip' ).tour();
        });

    </script>
    <?php  
        if( options::logic( 'general' , 'fb_comments' ) && options::get_value( 'social' , 'facebook_app_id' ) != '' && is_user_logged_in ()){ 
            ?>
                <script type="text/javascript">
                    FB.getLoginStatus(function(response) {
                        if( typeof response.status == 'unknown' ){
                            jQuery(function(){
                                jQuery.cookie('fbs_<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>' , null , {expires: 365, path: '/'} );
                            });
                        }else{
                            if( response.status == 'connected' ){
                                jQuery(function(){
                                    jQuery('#fb_script').attr( 'src' ,  document.location.protocol + '//connect.facebook.net/en_US/all.js#appId=<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>' );
                                });
                            }
                        }
                    });
                </script>
            <?php
        }
    ?>
    <?php 
        wp_footer();
        echo options::get_value('general' , 'tracking_code');
    ?>
    </body> 
</html>