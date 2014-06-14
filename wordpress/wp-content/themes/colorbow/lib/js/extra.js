var extra = new Object();
extra.add = function( group , struct ){
    var data = new Array();
    var k = 0;
    for (var key in struct ) {
        if ( struct.hasOwnProperty( key ) ) {
            if( ( typeof struct[ key ] ).toString() != "string" ){
                for( var i = 0; i < struct[ key ].length; i++ ){ //alert(extra.val( key + '#' + struct[ key ][i] ) +' __ '+jQuery(key + '#' + struct[ key ][i]).val());
                    data[ k ] = { 'name' : jQuery( key + '#' + struct[ key ][i] ).attr( 'name' ) , 'value' : jQuery(key + '#' + struct[ key ][i]).val() }

                    k++;
                }
            }else{
                data[ k ] = { 'name' : extra.name( key + '#' + struct[ key ] ) , 'value' : extra.val( key + '#' + struct[ key ] ) }
                k++;
            }
        }
    }


    jQuery( document ).ready(function(){
        jQuery.post( 
            ajaxurl , { "action" : 'extra_add' , 
                        "group" : group , 
                        "data" : data
                    } , 
            function( result ){ 
                extra.clear( struct ); 
                jQuery( '#container_' + group  ).html( result ); 
            } 
        );
    });
}


extra.del = function( group , index ){
    if(  confirm('You sure you want to delete this item from group ?') ){
        jQuery( document ).ready(function(){
            jQuery.post( ajaxurl , { "action" : 'extra_del' , "group" : group , "index" : index } , function( data ){
                 

                json = eval("(" + data + ")");
            
                jQuery( '#container_' + group  ).html( json['content'] );

                if(json['clear_default_selected_menu'] && json['clear_default_selected_menu'] != ''){
                    jQuery(json['clear_default_selected_menu']).val(''); /*clear the value for the input that holds  default_selected_menu */
                }
                

            } );
        });
    }
}

extra.update = function( group , index , struct ){
    var data = new Array();
    var k = 0;
    for (var key in struct ) {
        if ( struct.hasOwnProperty( key ) ) {
            if( ( typeof struct[ key ] ).toString() != "string" ){
                for( var i = 0; i < struct[ key ].length; i++ ){
                    data[ k ] = { 'name' : extra.name( 'div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ][i] ) , 'value' : extra.val( 'div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ][i] ) }
                    k++;
                }
            }else{
                data[ k ] = { 'name' : extra.name( 'div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ] ) , 'value' : extra.val( 'div#multiple_record_' + group + '_' + index + ' ' + key + '.' + struct[ key ] ) }
                k++;
            }
        }
    }

    jQuery( document ).ready(function(){
        jQuery.post( ajaxurl , { 
            "action" : 'extra_update' , 
            "group" : group , 
            "index": index , 
            "data" : data } , 
            function( result ){ 
                jQuery( '#container_' + group  ).html( result ); 
                if(group == '_content_menu'){
                    showMsg('.init_menu_save_msg');
                }
            } );
    });
}

extra.edite = function( group , index ){
    jQuery( document ).ready(function(){
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .edit-action').hide();
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .update-action').show();
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .fvisible' ).show();
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .lvisible' ).hide();

        jQuery( 'div#multiple_record_' + group + '_' + index + ' .close_box-action').css('display','inline-block').show();
    });
}

extra.close_box = function( group , index ){
    jQuery( document ).ready(function(){
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .edit-action').show(); /*show edit button*/
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .close_box-action').hide(); /*hide close button*/
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .fvisible' ).hide(); /*hide options inputs*/
        jQuery('input[type="button"].update-action').hide(); /*hide update button*/
        jQuery( 'div#multiple_record_' + group + '_' + index + ' .lvisible' ).show();
    });
}

extra.clear = function( struct ){
	jQuery( document ).ready(function(){
		for (var key in struct ) {
			if ( struct.hasOwnProperty( key ) ) {
				if( ( typeof struct[ key ] ).toString() != "string" ){
					for( var i = 0; i < struct[ key ].length; i++ ){
						jQuery( key + '#' + struct[ key ][i] ).val('');
					}
				}else{
					jQuery( key + '#' + struct[ key ] ).val('');
				}
			}
		}
	});
}
extra.name = function( selector ){
	var name = '';
	jQuery( document ).ready(function(){
		name = jQuery( selector ).attr( 'name' );
	});
	return name;
}
extra.val = function( selector ){
    var result = '';
    jQuery(document).ready(function(){
        if( jQuery( selector ).attr('type') == 'checkbox' || jQuery( selector ).attr('type') == 'radio' ){
            if( jQuery( selector ).is(':checked') ){
                result = jQuery( selector ).val();
            }else{
                result = '';
            }
        }else{
            result = jQuery( selector ).val();
        }
    });
    
    return result;
}


extra.sort = function( group , name ){
    var data = new Array();
    jQuery( document ).ready(function(){
        jQuery( 'input.' + group + '.index' ).each(function( i ){
            data[i] = { 'name' : name , 'value' : jQuery(this).val() };
        });

        jQuery.post( ajaxurl , { "action" : "extra_sort" , "group" : group , "data" : data } ,
            function( result ){
                jQuery( '#container_' + group ).html( result );
            }
        );
    });
}


function init_ui_slider(obj_selector){
    jQuery(obj_selector).each(function (i) {
        jQuery(this).slider({
             range: "min",
             min: jQuery(this).data('min'),
             max: jQuery(this).data('max'),
             value: jQuery(this).data('val') ,
             slide: function (event, ui) {
                jQuery(this).next('span.slider_val').text(ui.value);
                jQuery(this).prev('.slider_value').val(ui.value);
             },
             
             change: function (event, ui) {

             }
        });
    });
}


/*used for content_menu to hine options that are not related to a given Object type*/
function hide_non_related_content_menu_settings(){
    
    var object_types = ['category','post_tag', 'portfolio-category', 'portfolio-tag','box-sets','team-group',  'testimonial-category',  'page', 'post',  'slideshow'  ];
    
    
    /*add here the element classes you want to hide (usualy it is the input  class, we will hide the parent and label for this input) */
    var category_object_type = ['.filter_by', '.enable_filter', '.slide_transition', '.auto_play',  '.delimiter3','.content_background_color','.bg_color_opacity', '.content_number_of_columns']; 
    var post_tag_object_type = category_object_type;
    var portfolio_category_object_type = category_object_type;
    var portfolio_tag_object_type = category_object_type;
    var post_format_object_type = [ '.slide_transition', '.auto_play',  '.delimiter3','.content_background_color','.bg_color_opacity', '.content_number_of_columns']; 
    var box_sets_object_type = [ 'enable_filter', 'filter_by', '.slide_transition', '.auto_play',  '.delimiter3','.content_background_color','.bg_color_opacity', '.color_picker_text','.content_view_type','.content_resize_method','.enable_load_more', '.enable_ajax_post', '.content-menu-order-by','.content-menu-order'];
    var team_group_object_type = [ 'enable_filter', 'filter_by' ,'.slide_transition', '.auto_play', '.delimiter3','.enable_masonry ', '.content_background_color','.bg_color_opacity', '.color_picker_text','.content_view_type','.content_resize_method','.enable_load_more', '.enable_ajax_post', '.content-menu-order-by','.content-menu-order'];
    var testimonial_category_object_type = [ 'enable_filter', 'filter_by' ,'.slide_transition', '.auto_play', '.delimiter3', '.content_number_of_columns', '.enable_masonry ', '.content_background_color','.bg_color_opacity', '.color_picker_text','.content_view_type','.content_resize_method','.enable_load_more', '.enable_ajax_post', '.content-menu-order-by','.content-menu-order'];
    var page_object_type = [  'enable_filter', 'filter_by' , '.slide_transition', '.text_box', '.auto_play', '.delimiter3','.digit', /*'.color_picker_text', '.color_picker', */ '.enable_masonry ', '.content_number_columns', '.content_number_of_columns' , '.content_view_type','.content_resize_method','.enable_load_more', '.enable_ajax_post', '.content-menu-order-by','.content-menu-order'];
    var post_object_type = page_object_type;
    var portfolio_object_type = page_object_type;
    var slideshow_object_type = ['enable_filter', 'filter_by' ,'.enable_masonry', '.content_number_columns', '.content_number_of_columns', '.digit', '.delimiter2', '.delimiter1', '.color_picker', '.background_color', '.background_image', '.bg_object', '.text_box', '.content_background_color','.bg_color_opacity', '.color_picker_text','.content_view_type','.content_resize_method','.enable_load_more', '.enable_ajax_post', '.content-menu-order-by','.content-menu-order'];;

    /*iterate through sortable rows that have class  multiple-record-_content_menu*/
    jQuery('.multiple-record-_content_menu').each(function (i) { 
        var row = jQuery(this);
        var obj_type = row.attr('object_type'); /*each _content_menu row has an attribute 'object_type' */

        var exact_class = ['.delimiter2', '.delimiter1', '.delimiter3'];
        /*eval(obj_type + '_object_type')  -  uses the Object_type atribute to determine which arrays from above must be used for the current row */
        jQuery.each( eval(obj_type + '_object_type') , function(index,value) {  
            /*get the element that has given ID, then we get Parent with class .fvisible, and hide children with classes '.label, .input' */
            row.find(value).parents('.fvisible').find('.label, label, .input').hide();

            if(jQuery.inArray( value, exact_class) > -1){
                row.find(value).hide();
            }
            //if(value =='.delimiter1'){ row.find(value).hide(); }
        });
    
        
    });
    
}