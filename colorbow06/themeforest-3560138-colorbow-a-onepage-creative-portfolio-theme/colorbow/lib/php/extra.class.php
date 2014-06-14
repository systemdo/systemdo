<?php
    class extra{

        /* new version */
        function get_new_struct( $struct ){
            $result = array();
            if( is_array( $struct ) ){
                foreach( $struct as $container => $inputs ){
                    if( $container != 'actions' ){
                        if( substr( $container , 0 , 12 ) == 'info-column-' ){
                            foreach($inputs as $index => $input){
                                $result = array_merge( $result , self::get_attachment_struct( $input ) );
                            }
                        }else{
                            $result = array_merge( $result , self::get_attachment_struct( $inputs ) );
                        }
                    }
                }
            }
            if( !empty( $result ) ){
                $struct['info-column-0'] = array_merge( $struct['info-column-0'] , $result );
            }
            
            return $struct;

        }

        /* new version */
        function get_attachment_struct( $inputs ){
            $attach = array();

            if( isset($inputs['type']) && $inputs['type'] == 'attach' ){
                $name = $inputs['name'];
                $attach = array(
                    0 => array(
                        'name' => $name,
                        'type' => 'text',
                        'label' =>  'Attachment URL',
                        'lvisible' => false,
                        'upload' => true,
                    ),
                    1 => array(
                        'name' => $name .'_id',
                        'type' => 'hidden',
                        'upload' => true
                    ),
                );

                if( isset( $inputs[ 'classes' ] ) ){
                    $attach[0]['classes'] = $inputs[ 'classes' ];
                    $attach[1]['classes'] = $inputs[ 'classes' ] . '_id';
                }
            }
            return $attach;
        }

        /* new version */
        function get_input_ID( $group , $id , $name ){
            return $group . '_' . $name . $id;
        }

        /* new version */
		function get( $group = null ){
            if( $group ){
                $ajax   = false;
            }else{
                $ajax   = true;
                $group  = isset( $_POST[ 'group' ] ) ? $_POST[ 'group' ] : exit;
            }
            
			/*delete_option( $group );*/
			
			/* return data from options */
            $options   	=   get_option( $group );
			
			/* check if options is empty */
            if( !(is_array( $options ) && isset( $options ) && is_array( $options ) ) ){
			
				/* check if exists default values */
                if( isset( options::$fields[ $group ][ 'values' ] ) ){
				
					/* add default values */
                    $options = options::$fields[ $group ][ 'values' ];
                    $options      = array_map( 'stripslashes_deep', $options );
                    update_option( $group , $options );
                }
            }

			$struct = options::$fields[ $group ][ 'struct' ];
            $result = '';

            /* add sort action */
            if( isset( $struct[ 'actions' ][ 'sortable' ] ) ){
                $check_name = self::get_check_name( $group );
                $result  = '<script>';
                $result .= 'jQuery(document).ready(function(){';
                $result .= 'jQuery("form#serial_multiple_record_' . $group . '").sortable({ handle: ".draggable_area", beforeStop : function(){';
                $result .= "extra.sort( '" . $group . "' , '" . $check_name . "' );";
                $result .= '}});';
                $result .= '});';
                $result .= '</script>';
            }
            if( isset( options::$fields[ $group ][ 'hint' ] ) ){
                $result .= '<i>' . options::$fields[ $group ][ 'hint' ] . '</i>';
            }
            $result .= '<form id="serial_multiple_record_' . $group . '" action="" method="post" class="custom" >';
            if( isset( options::$fields[ $group ][ 'classes' ] ) ){
                $classes = options::$fields[ $group ][ 'classes' ];
            }else{
                $classes = 'list-rows';
            }
            
            $result .= self::layout_a( $group );
            
            if($group == '_content_menu'){
                /* this script will hide non related inputs for the content menu */
                $result .= '<script type="text/javascript"> hide_non_related_content_menu_settings(); </script>';    
            }
            
            $result .= '</form>';
            if( $ajax ){
                echo $result;
                exit;
            }else{
                return $result;
            }
        }

        function select_value( $group ){
            $struct     = options::$fields[ $group ]['struct'];
            $struct     = self::get_new_struct( $struct );

            $result     = array( '' => __( 'main sidebar' , 'cosmotheme' ) );

            if( isset( options::$fields[ $group ]['struct']['select'] ) ){
                $label  = options::$fields[ $group ]['struct']['select'];
            }else{
                $label  = $check_name;
            }

            $options    = get_option( $group );

            $check_name = self::get_check_name( $group );
            if( is_array( $options ) && !empty( $options ) ){
                foreach($options as $index => $record ){
                    $result[ trim( strtolower( str_replace( ' ' , '-' , $record[ $label ] ) ) ) ] = $record[ $label ];
                }
            }

            return $result;
        }

        /* new version */
        function layout_a( $group ){

            $result     =   '';
			
			/* get structure and minimalize */
            $struct  	=   options::$fields[ $group ]['struct'];
            $struct  	=   self::get_new_struct( $struct );
			
			/* return data from options */
            $options	=   get_option( $group );
			
            if( is_array( $options ) ){
                foreach($options as $index => $record ) {
                    
                    $object_type = '';
                    if(isset($record['object_type']) && isset($record['object_name']) ){
                        /*usually this will be the case for content menu (for tooltips and other cases we won't have this)*/ 
                        $object_type = 'object_type="' . str_replace('-', '_', $record['object_type'])  . '"';
                    }

					/* record container */
                    $result .= '<div  id="multiple_record_' . $group . '_' . $index . '" class="multiple-record multiple-record-' . $group . '" '.$object_type.'  >';
                    $i = 1;
                    foreach( $struct as $container => $inputs ){
                        switch( substr($container , 0 , 12) ){
							/* record antet check-column, actions-comun*/
                            case 'check-column' : {
								/* antet container */
								$result .= '<div class="record-antet record-antet-' . $group . '">';
                                $inputs['index'] = $index;
                                $inputs['group'] = $group;
                                if( isset( $record[ $inputs['name'] ] ) ){
                                    $inputs['value'] = $record[ $inputs['name'] ];
                                }else{
                                    $inputs['value'] = null;
                                }
								
								/* get check element */
                                $result .= self::input( $inputs );

                                /* get actions edit, update, delete */
                                // if( isset($record['use_case']) && $record['use_case'] == 'content_menu' && (  /*$record['object_type'] == 'page' || $record['object_type'] == 'post' ||*/ $record['object_type'] == 'slideshow' ) ){
                                //     //for menu_content - we don't want to show update option for pages/posts 
                                //     $show_edit_update  = false;    
                                // }else{
                                //     $show_edit_update  = true;
                                // }
                                
                                $show_edit_update  = true;    

                                $result .= self::get_action( $group , $index,$show_edit_update );

                                $result .= '<i class="draggable_area"></i>';  /*this is the daraggable area - used to sort rows*/

                                if(isset($record['object_type']) && isset($record['object_name']) ){
                                    /*usually this will be the case for content menu (for tooltips and other cases we won't have this)*/ 
                                    $obj_type = str_replace('_', ' ', $record['object_type']);
                                    $obj_type = ucfirst( str_replace('-', ' ', $obj_type)  ); 
                                    $result .= '<div class="multiple-record-content-menu-title"><span>'.$obj_type.':</span> '.$record['object_name'].'</div>';
                                }

                                
                                $result .= '</div>';
                                break;
                            }
                            case 'icon-column' : {
                                $inputs['index'] = $index;
                                $inputs['group'] = $group;

                                if( isset( $record[ $inputs['name'] ] ) ){
                                    $inputs['value'] = $record[ $inputs['name'] ];
                                }else{
                                    $inputs['value'] = null;
                                }

                                $result .= '<div class="icon-column">';
                                $result .= self::input( $inputs );
                                $result .= '</div>';
                                break;
                            }
                            case 'info-column-' : {
                                $result .= '<div class="info-column">';
                                foreach ( $inputs as $input ){
                                    $input['index'] = $index;
                                    $input['group'] = $group;
                                    if( isset( $record[ $input['name'] ] ) ){
                                        $input['value'] = $record[ $input['name'] ];
                                    }else{
                                        $input['value'] = null;
                                    }
                                    $result .= self::input( $input );
                                }
                                $result .= '<input type="button" class="button-primary update-action  hidden" value="'.__('Update','cosmotheme').'" onclick="' . self::update_action( $group , $index ) . '"></input>';

                                $result .= '</div>';
                                break;
                            }
                        }

                        $i++;
                    }
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                }
            }

            if( empty( $result ) ){
                $result .= '<div class="multiple-record multiple-record' . $group . '">';
                $result .= '<p>'.__('Sorry, no results found.','cosmotheme').'</p>';
                $result .= '</div>';
            }

            return $result;
        }

        /* new version */
        function get_action( $group , $id ,$show_edit_update = true ){
            $struct = options::$fields[ $group ][ 'struct' ];
            $result = '<span class="actions">';
            if( isset( $struct[ 'actions' ] ) ){
                foreach( $struct[ 'actions' ] as $index => $action ){
                    if( $index > 0 ){
                        $result .= ' | ';
                    }


                    if( $show_edit_update && $action == 'edit_update' ){
                        $result .= '<a class="edit-action" href="' . self::edit_action( $group , $id ) . '">'.__('Edit','cosmotheme').'</a>';
                        //$result .= '<a class="update-action  hidden" href="' . self::update_action( $group , $id ) . '">Update</a>';
                        $result .= '<a class="close_box-action  hidden" href="javascript:extra.close_box(\''.$group.'\' , \''.$id.'\' );">'.__('Close','cosmotheme').'</a>';
                        
                    }

                    if( $action == 'delete' ) {
                        $result .= '<a class="delete-action" href="' . self::delete_action( $group , $id ) . '">'.__('Delete','cosmotheme').'</a>';
                    }
                }
            }else{
                if($show_edit_update){
                    $result .= '<a class="edit-action" href="' . self::edit_action( $group , $id ) . '">'.__('Edit','cosmotheme').'</a>';
                    //$result .= '<a class="update-action hidden" href="' . self::update_action( $group , $id ) . '">Update</a> |';
                    $result .= '<a class="close_box-action  hidden" href="javascript:extra.close_box(\''.$group.'\' , \''.$id.'\' );">'.__('Close','cosmotheme').'</a>';
                }
                $result .= '<a class="delete-action" href="' . self::delete_action( $group , $id ) . '">'.__('Delete','cosmotheme').'</a>';
            }

            $result .= '</span>';

            return $result;
        }

        /* new version */
        function set_action( $group , $id ){
            $struct     = self::min_struct( $group );
            $values     = options::get_value( $group , $id );
            $data       = '';

            foreach( $struct as $rescord ){
                if( isset( $rescord['upload'] ) && $rescord['type'] == 'hidden' ){
                    $data .= " , '" . $rescord['name'] . "': extra.val('#img_id_" . self::get_input_ID( $group , $id , $rescord['name'] ) . "')";
                }else{
                    $data .= " , '" . $rescord['name'] . "': extra.val('#" . self::get_input_ID( $group , $id , $rescord['name'] ) . "')";
                }
            }

            $result = "javascript:extra.set( { 'action':'set_record' , 'group':'".$group."' , 'id':".$id." ".$data." });";
            return $result;
        }

        /* new version */
        function delete_action( $group , $id ){
            $result = "javascript:extra.del('".$group."' , " . $id . " );";
            return $result;
        }

        /* new version */
        function edit_action( $group , $id ){
            $result = "javascript:extra.edite('".$group."' , " . $id . " );";
            return $result;
        }

        /* new version */
        function upload_action( $group , $name , $index ){
            $result = "javascript:act.upload( '".$group."' , '".$name."' , '" . $index . "' );";
            return $result;
        }

        /* new version */
        function update_action( $group , $id ){
            $struct = self::get_new_struct( options::$fields[ $group ][ 'struct' ] );
            $params = array();
            foreach( $struct as $container => $records ){
                
                switch( substr( $container , 0 , 12 ) ){
                    case 'check-column' : {
                        if( $records['type'] != 'textarea' && $records['type'] != 'select' ){
                            $type = 'input';
                        }else{
                            $type = $records['type'];
                        }
                        if( isset( $records[ 'classes' ] ) ){
                            $params[ $type ][] = $records[ 'classes' ];
                        }
                        break;
                    }
                    case 'info-column-' : {
                        
                        foreach( $records as $record ){
                            if( $record['type'] != 'textarea' && $record['type'] != 'select' ){
                                $type = 'input';
                            }else{
                                $type = $record['type'];
                            }
                            if( isset( $record[ 'classes' ] ) ){
                                $params[ $type ][] = $record[ 'classes' ];
                            }
                        }
                        break;
                    }
                    case 'icon-column' : {
                        if( $records['type'] == 'attach' ){
                            continue;
                        }
                        
                        if( $records['type'] != 'textarea' && $records['type'] != 'select' ){
                            $type = 'input';
                        }else{
                            $type = $records['type'];
                        }
                        if( isset( $records[ 'classes' ] ) ){
                            $params[ $type ][] = $records[ 'classes' ];
                        }
                        break;
                    }
                }
            }
            $data = " {";
            $i = 0;
            foreach( $params as $type => $classes ){
                if( $i > 0 ){
                    $data .= " , ";
                }
                $data .= "'" . $type . "' : ";
                if( count( $classes ) > 1 ){
                    $data .= " [ ";
                    foreach( $classes as $index =>  $class_ ){
                        if( $index > 0 ){
                            $data .= " , ";
                        }

                        $data .= "'" . $class_ . "'";
                    }
                    $data .= " ] ";
                }else{
                    $data .= "'" . $classes[0] . "'";
                }

                $i++;
            }

            $data .= "} ";

            $result = "javascript:extra.update( '".$group."' , " . $id . "  , ".$data."  );";
            return $result;
        }

        /* new version */
        function min_struct( $group ){
            $struct	= options::$fields[ $group ]['struct'];
            $struct	= self::get_new_struct( $struct );

            $result	= array();
            foreach( $struct as $container => $inputs ){
                switch( substr($container , 0 , 12) ){
                    case 'check-column' : {
                        $inputs['index'] = '';
                        $inputs['group'] = $group;
                        $inputs['value'] = '';
                        $result[] = $inputs;
                        break;
                    }
                    case 'icon-column' : {
                        $inputs['index'] = '';
                        $inputs['group'] = $group;
                        $inputs['value'] = '';
                        $result[] = $inputs;
                        break;
                    }
                    case 'info-column-' : {
                        foreach ( $inputs as $input ){
                            $input['index'] = '';
                            $input['group'] = $group;
                            $input['value'] = '';
                            $result[] = $input;
                        }
                        break;
                    }
                }
            }

            return $result;
        }

        /* new version */
        function input( $input ){
            foreach( $input as $var => $attr ){
                    $$var = $attr;
            }

            if( !isset( $before ) ){
                $before = '';
            }

            if( !isset( $after ) ){
                $after = '';
            }

            $struct     = options::$fields[ $group ]['struct'];
            $check_name = self::get_check_name( $group );
            $id         = self::get_input_ID( $group, $index , $name );
            $classes    = isset( $classes ) ? $classes : '';

            /* text visible */
            if( !isset( $lvisible ) || $lvisible ){
                $lvisible = '';
            }else{
                if( isset( $lvisible ) && $lvisible ){
                    $lvisible = '';
                }else{
                    if( isset( $lvisible ) && !$lvisible ){
                        $lvisible = 'hidden';
                    }
                }
            }
            /* fields visible */
            if( !isset( $fvisible ) || $fvisible ){
                $fvisible = 'hidden';
            }else{
                if( isset( $fvisible ) && $fvisible ){
                    $fvisible = 'hidden';
                }else{
                    if( isset( $fvisible ) && !$fvisible ){
                        $fvisible = '';
                    }
                }
            }

            $label      = isset( $label ) ? '<label for="' . $id . '">' . $label . '</label>' : '';
            $result     = '';
            switch( $type ){
                case 'text' :{

                    $result .= '<div class="option_value ' . $lvisible . '">'  . $before . $value . stripslashes( $after ) . '</div>';
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div  class="label">';
                    $result .= $label;
                    $result .= '</div>';

                    $result .= '<div  class="input">';
                    $result .= '<input type="text" id="' . $id . '" class="' . $classes . '" name="' . $name . '" value="' . stripslashes( $value ) . '"/>';
                    if(isset($hint)){
                        $result .= '<span class="hint">'.$hint.'</span>';    
                    }
                    $result .= '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    
                    break;
                }

                case 'checkbox' :{
                    
                    $c = '';

                    if( $check_name == $name ){
                        if( strlen( $value )  &&  (int)$value == $index ){
                            $c = 'checked="checked"';
                        }else{
                            $value = $index;
                        }
                    }else{
                        if( $value == $name ){
                            $c = 'checked="checked"';
                        }else{
                            $value = $name;
                        }
                    }
                    
                    if( isset( $linked ) ){
                        $opt = get_option( $group );
                        if(isset($linked[1])){
                            if(is_array($linked[1])){
                                if( isset( $opt[ $index ][ $linked[0]] ) && !in_array($opt[ $index ][ $linked[0]], $linked[1])  ){
                                    $classes .= ' hidden';
                                    $aclasses = ' hidden';

                                }
                            }else{
                                if( isset( $opt[ $index ][ $linked[0]] ) && $opt[ $index ][ $linked[0]] != $linked[1] ){
                                    $classes .= ' hidden';
                                    $aclasses = ' hidden';
                                }    
                            }
                                
                        }
                    }
                    
                    if( !isset( $aclasses ) ){
                        $aclasses = '';
                    }

                    $result .= '<div class="fvisible field ' . $fvisible . ' ">';

                    $result .= '<div class="label '.$aclasses.' " id="'.$id.'_title" >';
                    $result .= $label;
                    $result .= '</div>';

                    $result .= '<div class="input  ">';
                    $result .= '<input type="checkbox" id="' . $id . '" class="' . $classes . ' '.$aclasses.'" name="' . $name . '" value="' . $value . '" ' . $c . ' />';
                    $result .= '</div>';

                    $result .= '<div class="clear"></div>';
                    
                    $result .= '</div>';
 
                    break;
                }

                case 'hidden' :{
                    if( $check_name == $name ){
                        if( strlen( $value )  &&  (int)$value == $index ){
                            $value = $index;
                        }
                        $classes .= " index " . $group;
                        $name .= '[]';
                    }

                    $result .= '<input type="hidden" id="' . $id . '" class="' . $classes . '" name="' . $name . '" value="' . $value . '"/>';

                    break;
                }

                case 'attach' :{

                    if( isset( $upload ) ){
                        $action = 'onclick="'.self::upload_action( $group , $name , $index ).'"';
                    }else{
                        $action = '';
                    }
                    
                    if( isset( $struct['icon-column']['name'] ) && $struct['icon-column']['name'] == $name ){
                        $record = options::get_value( $group , $index );
                        
                        if( isset( $record[ $name . '_id' ] ) && $record[ $name . '_id' ] > 0 ){

                            /* upload action is active on edit */
                            $result .= '<div  class="fvisible icon  hidden" ' . $action . '>';
                            $src = @wp_get_attachment_image_src( (int)$record[ $name . '_id' ] , array( 80 , 60 ), true );
                            if( (int) $src[1] * (int)$src[2] > 0 ){
                                $result .= '<img class="attach_' . $classes . ' upload-images" id="attach_' . $id . '" src="' . $src[0] . '" width="80" height="60" />';
                            }else{
                                $result .= '<img class="attach_' . $classes . ' upload-images" id="attach_' . $id . '" src="' . $value . '" width="80" height="60" />';
                            }
                            $result .= '</div>';

                            /* upload action is inactive on preview */
                            $result .= '<div  class="lvisible icon">';
                            $src = @wp_get_attachment_image_src( (int)$record[ $name . '_id' ] , array( 80 , 60 ), true );
                            if( (int) $src[1] * (int)$src[2] > 0 ){
                                $result .= '<img class="attach_' . $classes . ' upload-images"  src="' . $src[0] . '" width="80" height="60" />';
                            }else{
                                $result .= '<img class="attach_' . $classes . ' upload-images"  src="' . $value . '" width="80" height="60" />';
                            }
                            $result .= '</div>';
                            
                        }else{
                            /* upload action is active on edit */
                            $result .= '<div class="fvisible icon  hidden" ' . $action . '>';
                            $result .= '<img class="attach_' . $classes . ' upload-images" id="attach_' . $id . '" src="' . $value . '" width="80" height="60" />';
                            $result .= '</div>';

                            /* upload action is inactive on preview */
                            $result .= '<div class="lvisible icon" ' . $action . '>';
                            $result .= '<img class="attach_' . $classes . ' upload-images" src="' . $value . '" width="80" height="60" />';
                            $result .= '</div>';
                        }
                    }else{
                        /* upload action is active on edit */
                        $result .= '<div class="fvisible icon  hidden" ' . $action . '>';
                        $result .= '<img class="attach_' . $classes . ' upload-images" id="attach_' . $id . '" src="' . $value . '" width="80" height="60" />';
                        $result .= '</div>';

                        /* upload action is inactive on preview */
                        $result .= '<div class="lvisible icon" ' . $action . '>';
                        $result .= '<img class="attach_' . $classes . ' upload-images" src="' . $value . '" width="80" height="60" />';
                        $result .= '</div>';
                    }
                    $result .= '<center><small class="fvisible icon  hidden"><i>Click on the <br />image to edit.</i></small></center>';
                    break;
                }

                case 'textarea' :{
                    $result .= '<div class="option_value ' . $lvisible . '">' . $before . stripslashes( $value ) . $after . '</div>';
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div  class="label" id="'.$id.'_title" >';
                    $result .= $label;
                    $result .= '</div>';

                    $result .= '<div  class="input">';
                    $result .= '<textarea  id="' . $id . '" class="' . $classes . '" name="' . $name . '">' . stripslashes( $value ) . '</textarea>';
                    if(isset($hint)){
                        $result .= '<span class="hint">'.$hint.'</span>';    
                    }
                    $result .= '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    break;
                }
                case 'slider' :{
                    $result .= '<p class="option_value ' . $lvisible . '">' . $before . stripslashes( $value ) . $after . '</p>';
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div  class="label" id="'.$id.'_title" >';
                    $result .= $label;
                    $result .= '</div>';

                    $result .= '<div  class="input">';
                    $result .= '<input  type="hidden" id="' . $id . '" class="slider_value '.$classes.'" name="' . $name . '" value="' . stripslashes( $value ) . '" />';
                    $result .= '<div class="ui_slider" data-val="'.stripslashes( $value ).'" data-min="'.$min_value.'" data-max="'.$max_value.'" ></div> <span class="slider_val" >'.stripslashes( $value ).'</span>';
                    
                    //$result .= '<textarea  id="' . $id . '" class="' . $classes . '" name="' . $name . '">' . stripslashes( $value ) . '</textarea>';
                    if(isset($hint)){
                        $result .= '<span class="hint">'.$hint.'</span>';    
                    }
                    $result .= '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    //$result .= '<script>init_color_pickers(\'input.'.$classes.'\' );</script>';
                    $result .= '<script>init_ui_slider(\'.ui_slider\');</script>';
                    
                    break;
                }
                
                
                case 'search' :{
                    if( !empty( $value ) && (int)$value > 0 ){
                        $p = get_post( $value );
                        $title = $p -> post_title;
                        $post_id = $p -> ID;
                    }else{
                        $title = '';
                        $post_id = '';
                    }
                    
                    $result .= '<p class="option_value ' . $lvisible . '">' . $before . stripslashes( $title ) . $after . '</p>';
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div  class="label" id="'.$id.'_title" >';
                    $result .= $label;
                    $result .= '</div>';

                    
                    
                    $act = "javascript:act.search( this , '";
                    if( isset( $action ) ){
                        foreach( $action as $k => $v ){
                            if( $k > 0 ){
                                $act .= "#" . self::get_input_ID( $group , $index , $v ) . " , ";
                            }else{
                                $act .= "#" . self::get_input_ID( $group , $index , $v );
                            }
                        }
                    }else{
                        $act .= '-';
                    }
                    $act .= "' );";
                    $action = 'onchange="'. $act .'"';
                    
                    if( isset( $linked ) ){
                        $opt = get_option( $group );
                        if( isset( $opt[ $index ][ $linked[0]] ) && $opt[ $index ][ $linked[0]] != $linked[1] ){
                            $classes.= ' hidden';
                            $aclasses = ' hidden';
                        }
                    }
                    
                    if( !isset( $aclasses ) ){
                        $aclasses = '';
                    }
                    
                    $result .= '<div  class="input">' ;
                    
                    $result .= '<input type="text" id="' . $id . '_title" name="s" class="generic-record-search ' . $aclasses . '" value="' . $title . '" ' . $action . ' />';
                    $result .= '<input type="hidden"  id="' . $id . '" class="generic-value ' . $classes . '" name="' . $name . '"  value="' . $post_id . '" />';
                    $result .= '<input type="hidden" class="generic-params" value="' . urlencode( json_encode( $query ) ) . '" />';
                    $result .= '<span class="generic-hint">' . __( 'Start typing the post tile'  , 'cosmotheme' ) . '</span>';
                    $result .= '</div>';
                    
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    break;
                }
                
                case 'color-picker' : {

                    if( isset( $linked ) ){
                        $opt = get_option( $group );
                        if( isset( $opt[ $index ][ $linked[0]] ) && $opt[ $index ][ $linked[0]] != $linked[1] ){
                            $classes .= ' hidden';
                        }
                    }
                    $result .= '<p class="option_value ' . $lvisible . '">' . $before . stripslashes( $value ) . $after . '</p>';
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div  class="label ' . $classes . '" id="'.$id.'_title" >';
                    $result .= $label;
                    $result .= '</div>';

                    $result .= '<div  class="input ' . $classes . '" id="'.$id.'_input_content">';
                    //$result .= '<textarea  id="' . $id . '" class="' . $classes . '" name="' . $name . '">' . stripslashes( $value ) . '</textarea>';

                    $result .= '<input type="text" name="' . trim($name) . '" id="' . $id . '" op_name="' . $id . '" value="' .  $value . '" class="generic-record ' . $classes . '" />';
                    $result .= '<a href="#" class="pickcolor hide-if-no-js" id="link_pick_' . $id . '"></a>';
                    $result .= '<div id="colorPickerDiv_' . $id . '" class="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>';
                    $result .= '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    $result .= '<script>init_color_pickers(\'input.'.$classes.'\' );</script>';
                    
                    break;
                }

                case 'upload' : {
                    $result .= '<p class="option_value ' . $lvisible . '">' . $before . stripslashes( $value ) . $after . '</p>';
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div  class="label" id="'.$id.'_title" >';
                    $result .= $label;
                    $result .= '</div>';

                    $result .= '<div  class="input">';
                    $result .= '<input type="text" name="' . $name . '"  value="' . $value  . '" class="generic-record ' . $classes . '" id="' . $id . '" />';
                    $result .= '<input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" ' . fields::action( $id , 'upload' ) . ' />';
                    $result .= '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    break;
                }

                case 'delimiter' : {
                    
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div class="hr_delimiter '.$name.'">'.$label.'</div>';
                    $result .= '<div class="'.$name.' hr_delimiter delim"></div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    
                    break;
                }

                case 'select' :{
                    if( isset( $linked ) ){
                        $opt = get_option( $group );
                        if(isset($linked[1])){
                            if(is_array($linked[1])){
                                if( isset( $opt[ $index ][ $linked[0]] ) && !in_array($opt[ $index ][ $linked[0]], $linked[1])  ){
                                    $classes .= ' hidden';
                                }
                            }else{
                                if( isset( $opt[ $index ][ $linked[0]] ) && $opt[ $index ][ $linked[0]] != $linked[1] ){
                                    $classes .= ' hidden';
                                }    
                            }
                                
                        }
                    }

                    $result .= '<p class="option_value ' . $lvisible . '">' . $before . stripslashes( $value ) . $after . '</p>';
                    $result .= '<div class="fvisible field ' . $fvisible . '">';
                    $result .= '<div  class="label '.$classes.'" id="'.$id.'_title" >';
                    $result .= $label;
                    $result .= '</div>';

                    $result .= '<div  class="input"> ' ;
                    
                    if( isset( $action ) ){
                        $act = "javascript:act.select( '#" . $id . "' , {";
                        $method = $action['method'];
                        unset( $action['method'] );
                        foreach( $action as $k => $v ){
                            $q = "':'";
                            if(is_array($v) && sizeof($v)){
                                /*if an array is found (more elements depent on the given element) we will built the action in a different way*/
                                $counter = 1;
                                foreach ($v as $v_elem) {
                                    $q .= "#" . self::get_input_ID( $group , $index , $v_elem ) . " , #" . self::get_input_ID( $group , $index , $v_elem ) . "_title , #" . self::get_input_ID( $group , $index , $v_elem ) . "_input_content  ";
                                    if($counter != count($v)){
                                        $q .= " , ";
                                    }
                                    $counter++;

                                }
                                $q .= "' ,";
                            }else{
                                $q .= "#" . self::get_input_ID( $group , $index , $v ) . " , #" . self::get_input_ID( $group , $index , $v ) . "_title  , #"  . self::get_input_ID( $group , $index , $v ) . "_input_content '";
                                //$q .= "#" . self::get_input_ID( $group , $index , $v ) . " , #" . self::get_input_ID( $group , $index , $v ) . "_input_content' , ";
                                
                            }

                            $act .= "'" . $k . $q;
                        }
                        
                        $act .= "} , '" . $method . "' );";
                        $action = 'onchange="'. $act .'"';
                    }else{
                        $action = '';
                    }
                    
                    
                    $result .= '<select id="' . $id . '" class="' . $classes . '" name="' . $name . '" ' . $action . ' >';
                    foreach( $assoc as $k => $v ){
                        
                        if( $value == $k ){
                            $result .= '<option value="' . $k . '" selected="selected">' . $v .'</option>';
                        }else{
                            $result .= '<option value="' . $k . '">' . $v . '</option>';
                        }
                    }
                    $result .= '</select>';
                    $result .= '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    break;
                }
            }

            return $result;
        }


        /* new version */
        function add(  ){
            
			/* colect ajax requested data */
			$group  	= isset( $_POST['group'] ) && strlen( $_POST['group'] ) ? trim( $_POST['group'] ) : exit;
			$method 	= isset( $_POST['method'] ) && strlen( $_POST['method'] ) ? trim( $_POST['method'] ) : 'FIFO';
			$data   	= isset( $_POST['data'] ) ? $_POST['data'] : exit;
            
            
			/* minimize structure */
			$struct   	= self::min_struct( $group );

			/* return existent data from options */
			$options	= get_option( $group );

			$check_name = self::get_check_name( $group );
		
			/* set insert method - first in first out OR first in last out ( FIFO | LIFO )*/
			if( is_array( $options ) && is_array( $options ) ){
				if( $method == 'FIFO' ){
					$index = count( $options );
				}else{
					$index = 0;
				}
			}else{
				/* init option if not exists */
				$options = array();
                add_option( $group  );
				$index = 0;
			}
			/* init new record */
			foreach( $struct as $field ){
				if( isset( $field['require'] ) ){
					/* if field is required */
					foreach( $data as $input ){
						if( isset( $input[ 'name' ] ) && $input[ 'name' ] == $field[ 'name' ] ){
							if( $check_name == $input['name'] ){
								$new[ $field['name'] ] = $index;
							}else{
								/* exit if is empty */
								$new[ $field['name'] ] = isset( $input['value'] ) && strlen( $input['value'] ) ? $input['value'] : exit;
							}
						}
					}
				}else{
					/* if field is not required */
					foreach( $data as $input ){
						if( isset( $input['name'] ) && $input['name'] == $field['name'] ){ 
							if( $check_name == $input['name'] ){
								$new[ $field['name'] ] = $index;
							}else{
								$new[ $field['name'] ] = $input['value'];
							}
						}
					}
				}
			}
            $new_options = array();
            
            if(!isset($new)){
                $new = array();
            }
			/* add new record */
            switch( $method ){
                case 'LIFO' : {
                    $new_options[] = $new;
                    foreach( $options as $index => $option ){
						$check_value =  $option[ $check_name ];
						if( strlen( $check_value )  &&  (int)$check_value == $index ){
							$option[ $check_name ]++;
						}
                        $new_options[] = $option;
                    }
                    break;
				}

                default : {
                    $options[] = $new;
                    $new_options = $options;
                    break;
                }
            }
        
            $new_options      = array_map( 'stripslashes_deep', $new_options );
            update_option( $group , $new_options );
            
            echo self::get( $group); 
 
			exit;
        }

        function set(  ){
            
            if( empty( $group ) ){
                $group  = isset( $_POST['group'] ) && strlen( $_POST['group'] ) ? trim( $_POST['group'] ) : exit;
                $id     = isset( $_POST['id'] ) && strlen( $_POST['id'] ) ? trim( $_POST['id'] ) : exit;
                $mins   = self::min_structure( $group , $side );
                foreach($mins as $min ){
                    if( isset( $min['require'] ) ){
                        $new[ $min['name'] ] = isset( $_POST[ $min['name'] ] ) && strlen( $_POST[ $min['name'] ] ) ? $_POST[ $min['name'] ] : exit;
                    }else{
                        $new[ $min['name'] ] = $_POST[ $min['name'] ];
                    }
                }

                $ajax   = true;
            }else{
                $ajax   = false;
            }

            $op_group   = get_option( $group );

            if( !is_array( $op_group ) ){
                $op_group[ $side ] = array();
                add_option( $group  );
            }

            $op_group[ $side ][ $id ] = $new;
            update_option( $group , $op_group );

            if( $ajax ){
                echo self::get( $group , $side );
                exit;
            }
        }

        function set_by_meta( $group = null , $side = null , $meta = null , $value = null , $new = array() ){

            if( empty( $group ) ){
                $group  = isset( $_POST['group'] ) && strlen( $_POST['group'] ) ? trim( $_POST['group'] ) : exit;
                $side   = isset( $_POST['side'] ) && strlen( $_POST['side'] ) ? trim( $_POST['side'] ) : exit;
                $meta   = isset( $_POST['meta'] ) && strlen( $_POST['meta'] ) ? trim( $_POST['meta'] ) : exit;
                $value  = isset( $_POST['value'] ) && strlen( $_POST['value'] ) ? trim( $_POST['value'] ) : exit;
                $mins   = self::min_structure( $group , $side );
                foreach($mins as $min ){
                    if( isset( $min['require'] ) ){
                        $new[ $min['name'] ] = isset( $_POST[ $min['name'] ] ) && strlen( $_POST[ $min['name'] ] ) ? $_POST[ $min['name'] ] : exit;
                    }else{
                        $new[ $min['name'] ] = $_POST[ $min['name'] ];
                    }
                }

                $ajax   = true;
            }else{
                $ajax   = false;
            }

            $op_group   = get_option( $group );

            if( !is_array( $op_group ) ){
                $op_group[ $side ] = array();
                add_option( $group  );
            }

            foreach( $op_group[ $side ] as $index => $val ){
                if( $val[ $meta ] == $value ){
                    $op_group[ $side ][ $index ] = $new;
                }
            }

            update_option( $group , $op_group );

            if( $ajax ){
                echo self::get( $group , $side );
                exit;
            }
        }

        /* new version */
        function update( $group = null , $index = null , $data = null ){
            if( empty( $group ) ){
                $group  = isset( $_POST['group'] ) && strlen( $_POST['group'] ) ? trim( $_POST['group'] ) : exit;
                $index  = isset( $_POST['index'] ) && strlen( $_POST['index'] ) ? (int)trim( $_POST['index'] ) : exit;
                $data   = isset( $_POST['data'] ) && is_array( $_POST['data'] ) ? $_POST['data'] : exit;
                $ajax   = true;
            }else{
                $ajax   = false;
            }

            /* return current options */
            $options   = get_option( $group );

            /* init options if not exists */
            if( !is_array( $options ) ){
                $options = array();
                add_option( $group  );
            }

            foreach( $data as $field ){
                //if( isset( $options[ $index ][ $field[ 'name' ] ]  ) ){
                    $options[ $index ][ $field[ 'name' ] ] = $field[ 'value' ];
                //}
            }
            
            $options      = array_map( 'stripslashes_deep', $options );
            update_option( $group , $options );

            if( $ajax ){
                echo self::get( $group );
                exit;
            }
        }

        /* new version */
        function del( $group = null ,  $index = null ){
            if( empty( $group ) ){
                $group  = isset( $_POST['group'] ) && strlen( $_POST['group'] ) ? trim( $_POST['group'] ) : exit;
                $index  = isset( $_POST['index'] )  ? (int) $_POST['index']  : exit;
                $ajax   = true;
            }else{
                $ajax   = false;
            }

            /* return current options */
            $options   = get_option( $group );


            /* init options if not exists */
            if( !is_array( $options ) ){
                $options = array();
                add_option( $group  );
            }

            $new_options    = array();

            /* delete options from $index  */
            unset($options[ $index ]);

            $check_name = self::get_check_name( $group );

            /* reorder options */
            foreach( $options as $i => $option ){
                if( $i > $index && isset( $check_name ) ){
                    $option[ $check_name ] = $i - 1;
                }

                $new_options[] = $option;
            }

            /*  Only for _content_menu !!! */
            if($group == '_content_menu'){

                $new_default_selected = array();
                $default_selected_menu = get_option('default_selected_menu');
            
                $counter = 0;
                foreach ($new_options as $key => $option) {
                    /*  Only for _content_menu !!! */
                    if( !sizeof($new_default_selected)){  /*we want to update this option witht the first matching value*/
                        if($option['object_name'] == $default_selected_menu['value']){
                            $new_default_selected = array('id' => $counter, 'value' => $option['object_name'] );
                        }
                    }

                    $counter ++;
                }
            
                if(!sizeof($new_default_selected)){
                    /*if the new value is empty, then we delete the existing option*/
                    delete_option('default_selected_menu');   
                    $result['clear_default_selected_menu'] = '.generic-record-search_menu_content_items'; /*class of the input that holds old value and  needs to be cleared*/   
                }else{
                    update_option('default_selected_menu',$new_default_selected);      
                }
                
            }

            /* update options */
            $new_options      = array_map( 'stripslashes_deep', $new_options );
            update_option( $group , $new_options );


            if( $ajax ){

                $result['content'] = self::get( $group );

                echo json_encode( $result );
                
                exit;
            }
        }

        function del_by_meta( $group , $side , $meta , $value ){

            $op_group   = get_option( $group );

            if( !is_array( $op_group ) ){
                $op_group[ $side ] = array();
                add_option( $group  );
            }

            $options        = $op_group[ $side ];
            $new_options    = array();
            foreach( $options as  $n => $option ){
                if( isset( $option[ $meta ] ) && $option[ $meta ] == $value ){
                    unset($options[ $n ]);
                }
            }

            if( isset( admin_options::$inputs[ $group ][ $side ]['structure']['check-column'] ) ){
                $name = admin_options::$inputs[ $group ][ $side ]['structure']['check-column']['name'];
            }
            $i = 0;
            foreach( $options as $index => $option ){
                $option[ $name ] = $i;
                $new_options[$i] = $option;
                $i++;
            }

            $op_group[ $side ] = $new_options;
            update_option( $group , $op_group );

            return '';
        }

        function sort( $group = null ,  $data = array() ){
            
            if( empty( $group ) ){
                $group  = isset( $_POST['group'] ) && strlen( $_POST['group'] ) ? trim( $_POST['group'] ) : exit;
                $data   = isset( $_POST['data'] ) ? $_POST['data'] : exit;
                $ajax   = true;
            }else{
                $ajax   = false;
            }
            
            $op_group   = get_option( $group );

            if( !is_array( $op_group ) ){
                $op_group = array();
                add_option( $group  );
            }

            $new_options = array();

            $check_name = self::get_check_name( $group );
            if( strlen( $check_name ) == 0 ){
                exit;
            }
            $index = 0;
            foreach($data as $value ){
                if( $value['name'] == $check_name ){
                    $new_options[ $index ] =  $op_group[$value['value']];
                    $new_options[ $index ][ $check_name ] = $index;
                    unset( $op_group[$value['value']] );
                    $index++;
                }
            }
  
            $new_index = count( $new_options );
            
            foreach( $op_group as $value){ 
                $new_options[ $new_index ] = $value;
                $new_index++;
            }

            unset( $op_group );
            $op_group = $new_options;

            /*  Only for _content_menu !!! */
            if($group == '_content_menu'){

                $new_default_selected = array();
                $default_selected_menu = get_option('default_selected_menu');
            
                $counter = 0;
                foreach ($new_options as $key => $option) {
                    /*  Only for _content_menu !!! */
                    if( !sizeof($new_default_selected)){  /*we want to update this option witht the first matching value*/
                        if($option['object_name'] == $default_selected_menu['value']){
                            $new_default_selected = array('id' => $counter, 'value' => $option['object_name'] );
                        }
                    }

                    $counter ++;
                }
            
                if(!sizeof($new_default_selected)){
                    /*if the new value is empty, then we delete the existing option*/
                    delete_option('default_selected_menu');      
                }else{
                    update_option('default_selected_menu',$new_default_selected);      
                }
                
            }

            $op_group      = array_map( 'stripslashes_deep', $op_group );
            update_option( $group , $op_group );
            if( $ajax ){
                echo self::get( $group );
                exit;
            }
        }

        function get_id_by_meta( $group , $side , $meta , $value ){
            $op_group   = get_option( $group );

            if( !is_array( $op_group ) ){
                $op_group[ $side ] = array();
                add_option( $group  );
            }
            $result = '';
            foreach( $op_group[ $side ] as $index => $val ){
                if( $val[ $meta ] == $value ){
                    $result = $index;
                }
            }

            return $result;
        }

        function call( $group = null , $side = null ,  $value = null , $fn = null ){
            if( empty( $group ) ){
                $group  = isset( $_POST['group'] ) && strlen( $_POST['group'] ) ? trim( $_POST['group'] ) : exit;
                $side   = isset( $_POST['side'] ) && strlen( $_POST['side'] ) ? trim( $_POST['side'] ) : exit;
                $value  = isset( $_POST['value'] ) ? $_POST['value'] : exit;
                $fn     = isset( $_POST['fn'] ) ? $_POST['fn'] : exit;
                $ajax   = true;
            }else{
                $ajax   = false;
            }

            $fn( $value );

            if( $ajax ){
                echo self::get( $group , $side );
                exit;
            }
		}
		
		/* new version functions */
		/* return name of check column ( id extra record ) */
		function get_check_name( $group ){
			if( isset( options::$fields[ $group ]['struct']['check-column'] ) ){
                $name = options::$fields[ $group ]['struct']['check-column']['name'];
				return $name;
            }else{
				exit;
			}
		}

        /* get list active records  */
        function get_list_by( $group , $field = null ){
            $options = get_option( $group );
            $check_name = self::get_check_name( $group );
            $result = array();
            foreach( $options as $index => $record ){
                if( strlen( $record[ $check_name ] ) ){
                    if( !empty( $field ) ){
                        $result[ $index ] = $record[ $field ];
                    }else{
                        $result[ $index ] = $record;
                    }
                }
            }

            return $result;
        }
    }
?>