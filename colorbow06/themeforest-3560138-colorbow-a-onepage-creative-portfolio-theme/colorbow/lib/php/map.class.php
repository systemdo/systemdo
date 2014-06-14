<?php
    class map {
        
        function get_contact_map( ){
            $id     = isset( $_GET['id'] ) && (int)$_GET['id'] > 0 ? (int) $_GET['id'] : exit;
            $type   = isset( $_GET['type'] ) && strlen( $_GET['type'] ) > 0 ? $_GET['type'] : exit;
            
            $post   = get_post( $id );


?>

            <link href="<?php echo get_template_directory_uri() ?>/lib/css/shcode/contact.css" type="text/css" rel="stylesheet"  />

            <form action="" method="post" style="">
                <fieldset>
                    <?php

                        $map_title          = get_post_meta( $post -> ID , 'map_title');
                        $map_description    = get_post_meta( $post -> ID , 'map_description');
                        $map_phone1         = get_post_meta( $post -> ID , 'map_phone1');
                        $map_phone2         = get_post_meta( $post -> ID , 'map_phone2');
                        $map_fax            = get_post_meta( $post -> ID , 'map_fax');
                        $map_email          = get_post_meta( $post -> ID , 'map_email');
                        $message            = get_post_meta( $post -> ID , 'message');
                        $hidde_contact      = get_post_meta( $post -> ID , 'hidde_contact');

                        $map_title          = !empty( $map_title ) ? $map_title[0] : '';
                        $map_description    = !empty( $map_description ) ? $map_description[0] : '';
                        $map_phone1         = !empty( $map_phone1 ) ? $map_phone1[0] : '';
                        $map_phone2         = !empty( $map_phone2 ) ? $map_phone2[0] : '';
                        $map_fax            = !empty( $map_fax ) ? $map_fax[0] : '';
                        $map_email          = !empty( $map_email ) ? $map_email[0] : get_the_author_meta( 'user_email' , get_current_user_id());
                        $message            = !empty( $message ) ? $message[0] : '';
                        $hidde_contact      = !empty( $hidde_contact ) ? $hidde_contact[0] : '';

                        $type               = 'hidden';

                        

                    ?>
                       
                    <p>
                        <label for="map_title">
                            <?php _e( 'Title Info' , 'cosmotheme' ); ?><br />
                            <input type="text" id="map_title" onkeyup="javascript:addTitleMap( this.value)" value="<?php echo $map_title; ?>">
                        </label>
                    </p>

                    <p>
                        <label for="map_description_info">
                            <?php _e( 'Description Info ' , 'cosmotheme' ); ?><br />
                            <textarea id="map_description" onkeyup="javascript:addDescriptionMap( this.value )"><?php echo $map_description; ?></textarea>
                        </label>
                    </p>

                    <p>
                        <label for="map_phone1">
                            <?php _e( 'Contact phone 1' , 'cosmotheme' ); ?><br />
                            <input type="text" id="map_phone1" onkeyup="javascript:addPhone1Map( this.value )" value="<?php echo $map_phone1; ?>">
                        </label>
                    </p>
                    <p>
                        <label for="map_phone2">
                            <?php _e( 'Contact phone 2' , 'cosmotheme' ); ?><br />
                            <input type="text" id="map_phone2" onkeyup="javascript:addPhone2Map( this.value )" value="<?php echo $map_phone2; ?>">
                        </label>
                    </p>
                    <p>
                        <label for="map_fax">
                            <?php _e( 'Fax' , 'cosmotheme' ); ?><br />
                            <input type="text" id="map_fax" onkeyup="javascript:addFaxMap( this.value )" value="<?php echo $map_fax; ?>">
                        </label>
                    </p>
                    <p>
                        <label for="map_email">
                            <?php _e( 'Contact email' , 'cosmotheme' ); ?><br />
                            <input id="map_email" type="text" onkeyup="javascript:addEmailMap( this.value )" value="">
                        </label>
                    </p>

                    <p>
                        <label for="message"> <?php _e( 'Aditional Info' , 'cosmotheme' ); ?><br />
                            <textarea id="message" ></textarea>
                        </label>
                    </p>
                   
					
                </fieldset>
                
                <div class="clearfix"></div>
            </form>
<?php
            exit();
        }
    }
?>