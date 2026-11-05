<?php
add_action( 'vc_before_init', 'g5plus_vcSetAsTheme' );
function g5plus_vcSetAsTheme() {
    vc_set_as_theme();
}

function g5plus_vc_remove_frontend_links() {
    vc_disable_frontend();
}
add_action( 'vc_after_init', 'g5plus_vc_remove_frontend_links' );

function g5plus_number_settings_field($settings, $value) {
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $min = isset($settings['min']) ? $settings['min'] : '';
    $max = isset($settings['max']) ? $settings['max'] : '';
    $suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
    $class = isset($settings['class']) ? $settings['class'] : '';
    $output = '<input type="number" min="'.esc_attr($min).'" max="'.esc_attr($max).'" class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '" value="'.esc_attr($value).'" style="max-width:100px; margin-right: 10px;" />'.esc_attr($suffix);
    return $output;
}

function g5plus_icon_text_settings_field($settings, $value) {
    return '<div class="vc-text-icon">'
    .'<input  name="'.$settings['param_name'] .'" style="width:80%;" class="wpb_vc_param_value wpb-textinput widefat input-icon ' .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" value="' .esc_attr($value).'"/>'
    .'<input title="'.__('Click to browse icon','g5plus-darna').'" style="width:20%; height:34px;" class="browse-icon button-secondary" type="button" value="'. __('Browse Icon','g5plus-darna') .'" >'
    .'<span class="icon-preview"><i class="'. esc_attr($value).'"></i></span>'
    .'</div>';
}

function g5plus_multi_select_settings_field_shortcode_param($settings, $value) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $param_option     =  isset( $settings['options'] ) ? $settings['options'] : '';
    $output     = '<input type="hidden" name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value ' . $param_name . '" value="' . $value . '"/>';
    $output .= '<select multiple id="' . $param_name . '_select2" name="' . $param_name . '_select2" class="multi-select">';
    if ( $param_option != '' && is_array( $param_option ) ) {
        foreach ( $param_option as $text_val => $val ) {
            if ( is_numeric( $text_val ) && ( is_string( $val ) || is_numeric( $val ) ) ) {
                $text_val = $val;
            }
            $output .= '<option id="' . $val.'" value="' . $val . '">' . htmlspecialchars( $text_val ) . '</option>';
        }
    }

    $output .= '</select><input type="checkbox" id="' . $param_name . '_select_all" >'.__('Select All','g5plus-darna');
    $output.='<script type="text/javascript">
		        jQuery(document).ready(function($){

					$("#' . $param_name . '_select2").select2({width : "100%"});

					var order = $("#' . $param_name . '").val();
					if (order != "") {
						order = order.split(",");
						var choices = [];
						for (var i = 0; i < order.length; i++) {
							var option = $("#' . $param_name . '_select2 option[value="+ order[i]  + "]");
							if (option.length > 0) {
							    choices[i] = {id:order[i], text:option[0].label, element: option};
							    option.detach();
						        $("#' . $param_name . '_select2").append(option);
							}
						}

						$("#' . $param_name . '_select2").val(order).trigger("change");
					}


                    $("#' . $param_name . '_select2").on("select2:selecting",function(e){
                        var ids = $("#' . $param_name . '").val();
			            if (ids != "") {
			                ids +=",";
			            }
			            ids += e.params.args.data.id;
			            $("#' . $param_name . '").val(ids);
                    }).on("select2:unselecting",function(e){
                        var ids = $("#' . $param_name . '").val();
                         var arr_ids = ids.split(",");
                         var newIds = "";
                         for(var i = 0 ; i < arr_ids.length; i++) {
				            if (arr_ids[i] != e.params.args.data.id){
				                if (newIds != "") {
			                        newIds +=",";
					            }
					            newIds += arr_ids[i];
				            }
				          }
				          $("#' . $param_name . '").val(newIds);
                    }).on("select2:select", function(e){
                        var element = e.params.data.element;
						var $element = $(element);

						$element.detach();
						$(this).append($element);
						$(this).trigger("change");

                    });


		            $("#' . $param_name . '_select_all").click(function(){
		                if($("#' . $param_name . '_select_all").is(":checked") ){
		                    $("#' . $param_name . '_select2 > option").prop("selected","selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    var arr_ids =  $("#' . $param_name . '_select2").select2("val");
		                    var ids = "";
                            for (var i = 0; i < arr_ids.length; i++ ) {
                                if (ids != "") {
                                    ids +=",";
                                }
                                ids += arr_ids[i];
                            }
                            $("#' . $param_name . '").val(ids);

		                }else{
		                    $("#' . $param_name . '_select2 > option").removeAttr("selected");
		                    $("#' . $param_name . '_select2").trigger("change");
		                    $("#' . $param_name . '").val("");
		                }
		            });
		        });
		        </script>
		        <style>
		            .multi-select
		            {
		              width: 100%;
		            }
		            .select2-dropdown
		            {
		                z-index: 100000;
		            }
		        </style>';
    return $output;
}

function g5plus_tags_settings_field_shortcode_param($settings, $value) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $output = '<input  name="' . $settings['param_name']
        . '" class="wpb_vc_param_value wpb-textinput '
        . $settings['param_name'] . ' ' . $settings['type']
        . '" type="hidden" value="' . $value . '"/>';
    $output .= '<input type="text" name="'.$param_name.'_tagsinput" id="'.$param_name.'_tagsinput" value="'.$value.'" data-role="tagsinput"/>';
    $output .= '<script type="text/javascript">
							jQuery(document).ready(function($){
								$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();

								$("#'. $param_name .'_tagsinput").on("itemAdded", function(event) {
		                             $("input[name='.$param_name.']").val($(this).val());
								});

								$("#'. $param_name .'_tagsinput").on("itemRemoved", function(event) {
		                             $("input[name='.$param_name.']").val($(this).val());
								});
							});
						</script>';
    return $output;
}

if ( function_exists('vc_add_shortcode_param'))
{
    vc_add_shortcode_param('number' , 'g5plus_number_settings_field' );
    vc_add_shortcode_param('icon_text' , 'g5plus_icon_text_settings_field' );
    vc_add_shortcode_param('multi-select', 'g5plus_multi_select_settings_field_shortcode_param');
    vc_add_shortcode_param('tags', 'g5plus_tags_settings_field_shortcode_param');
}

function g5plus_get_css_animation($css_animation){
    $output = '';
    if ($css_animation != '') {
        wp_enqueue_script('waypoints');
        $output = ' wpb_animate_when_almost_visible g5plus-css-animation ' . $css_animation;
    }
    return $output;
}

function g5plus_get_style_animation($duration, $delay)
{
    $styles = array();
    if ($duration != '0' && !empty($duration)) {
        $duration = (float)trim($duration, "\n\ts");
        $styles[] = "-webkit-animation-duration: {$duration}s";
        $styles[] = "-moz-animation-duration: {$duration}s";
        $styles[] = "-ms-animation-duration: {$duration}s";
        $styles[] = "-o-animation-duration: {$duration}s";
        $styles[] = "animation-duration: {$duration}s";
    }
    if ($delay != '0' && !empty($delay)) {
        $delay = (float)trim($delay, "\n\ts");
        $styles[] = "opacity: 0";
        $styles[] = "-webkit-animation-delay: {$delay}s";
        $styles[] = "-moz-animation-delay: {$delay}s";
        $styles[] = "-ms-animation-delay: {$delay}s";
        $styles[] = "-o-animation-delay: {$delay}s";
        $styles[] = "animation-delay: {$delay}s";
    }
    if (count($styles) > 1) {
        return 'style="' . implode(';', $styles) . '"';
    }
    return implode(';', $styles);
}

function  g5plus_convert_hex_to_rgba($hex,$opacity=1) {
    $hex = str_replace("#", "", $hex);
    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    }
    else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
    return $rgba;
}
if(!function_exists('vc_map_get_attributes'))
{
    function g5plus_add_vc_param() {
        if(function_exists('vc_remove_param')){
            vc_remove_param('vc_row','full_width');
            vc_remove_param('vc_row', 'parallax' );
            vc_remove_param('vc_row', 'parallax_image');
        }
        if(function_exists('vc_add_param')){

            $add_css_animation = array(
                'type' => 'dropdown',
                'heading' => __('CSS Animation', 'g5plus-darna'),
                'param_name' => 'css_animation',
                'value' => array(__('No', 'g5plus-darna') => '', __('Fade In', 'g5plus-darna') => 'wpb_fadeIn', __('Fade Top to Bottom', 'g5plus-darna') => 'wpb_fadeInDown', __('Fade Bottom to Top', 'g5plus-darna') => 'wpb_fadeInUp', __('Fade Left to Right', 'g5plus-darna') => 'wpb_fadeInLeft', __('Fade Right to Left', 'g5plus-darna') => 'wpb_fadeInRight', __('Bounce In', 'g5plus-darna') => 'wpb_bounceIn', __('Bounce Top to Bottom', 'g5plus-darna') => 'wpb_bounceInDown', __('Bounce Bottom to Top', 'g5plus-darna') => 'wpb_bounceInUp', __('Bounce Left to Right', 'g5plus-darna') => 'wpb_bounceInLeft', __('Bounce Right to Left', 'g5plus-darna') => 'wpb_bounceInRight', __('Zoom In', 'g5plus-darna') => 'wpb_zoomIn', __('Flip Vertical', 'g5plus-darna') => 'wpb_flipInX', __('Flip Horizontal', 'g5plus-darna') => 'wpb_flipInY', __('Bounce', 'g5plus-darna') => 'wpb_bounce', __('Flash', 'g5plus-darna') => 'wpb_flash', __('Shake', 'g5plus-darna') => 'wpb_shake', __('Pulse', 'g5plus-darna') => 'wpb_pulse', __('Swing', 'g5plus-darna') => 'wpb_swing', __('Rubber band', 'g5plus-darna') => 'wpb_rubberBand', __('Wobble', 'g5plus-darna') => 'wpb_wobble', __('Tada', 'g5plus-darna') => 'wpb_tada'),
                'description' => __('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'g5plus-darna'),
                'group' => __('Animation Settings', 'g5plus-darna')
            );

            $add_duration_animation = array(
                'type' => 'textfield',
                'heading' => __('Animation Duration', 'g5plus-darna'),
                'param_name' => 'duration',
                'value' => '',
                'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'g5plus-darna'),
                'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
                'group' => __('Animation Settings', 'g5plus-darna')
            );

            $add_delay_animation = array(
                'type' => 'textfield',
                'heading' => __('Animation Delay', 'g5plus-darna'),
                'param_name' => 'delay',
                'value' => '',
                'description' => __('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'g5plus-darna'),
                'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
                'group' => __('Animation Settings', 'g5plus-darna')
            );

            vc_add_param('vc_row',
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Layout', 'g5plus-darna' ),
                    'param_name' => 'layout',
                    'value'      => array(
                        __( 'Full Width', 'g5plus-darna' )  => 'wide',
                        __( 'Container', 'g5plus-darna' ) => 'boxed',
                        __( 'Container Fluid', 'g5plus-darna' ) => 'container-fluid',
                    ),
                )
            );
            vc_add_param('vc_row',
                array(
                    'type' => 'dropdown',
                    'heading' => __('Parallax Type','g5plus-darna'),
                    'param_name' => 'parallax_style',
                    'value' => array(
                        __('None','g5plus-darna') => 'none',
                        __('Vertical Parallax On Scroll','g5plus-darna') => 'vertical-parallax',
                        __('Horizontal Parallax On Scroll','g5plus-darna') => 'horizontal-parallax',
                        __('Video Background','g5plus-darna') => 'video-background',
                    ),
                    'description' => __('Select the kind of style you like for the background image of this row.','g5plus-darna'),
                )
            );
            vc_add_param('vc_row',
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Link Video (.mp4 or .ogg)', 'g5plus-darna' ),
                    'param_name' => 'video_link',
                    'value'      => '',
                    'dependency' => Array('element' => 'parallax_style','value' => array('video-background')),
                )
            );
            vc_add_param('vc_row',
                array(
                    'type' => 'dropdown',
                    'heading' => __('Scroll effect', 'g5plus-darna'),
                    'param_name' => 'parallax_scroll_effect',
                    'value' => array(
                        __('Fixed at its position', 'g5plus-darna') => 'fixed',
                        __('Move with the content', 'g5plus-darna') => 'scroll',
                    ),
                    'description' => __('Options to set whether a background image is fixed or scroll with the rest of the page.', 'g5plus-darna'),
                    'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),
                )
            );
            vc_add_param('vc_row',
                array(
                    'type' => 'number',
                    'heading' => __('Parallax speed', 'g5plus-darna'),
                    'param_name' => 'parallax_speed',
                    'value' =>'1',
                    'min'=>'1',
                    'max'=>'100',
                    'description' => __('Control speed of parallax. Enter value between 0 to 100', 'g5plus-darna'),
                    'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),
                )
            );
            vc_add_param('vc_row',
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Show background overlay', 'g5plus-darna' ),
                    'param_name' => 'overlay_set',
                    'description' => __( 'Hide or Show overlay on background images.', 'g5plus-darna' ),
                    'value' => array(
                        __( 'Hide, please', 'g5plus-darna' ) =>'hide_overlay',
                        __( 'Show Overlay Color', 'g5plus-darna' ) =>'show_overlay_color',
                        __( 'Show Overlay Image', 'g5plus-darna' ) =>'show_overlay_image',
                    )
                )
            );
            vc_add_param('vc_row',
                array(
                    'type'        => 'attach_image',
                    'heading'     => __( 'Upload image:', 'g5plus-darna' ),
                    'param_name'  => 'overlay_image',
                    'value'       => '',
                    'description' => __( 'Upload image overlay.', 'g5plus-darna' ),
                    'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),
                )
            );
            vc_add_param('vc_row',
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Overlay color', 'g5plus-darna' ),
                    'param_name' => 'overlay_color',
                    'description' => __( 'Select color for background overlay.', 'g5plus-darna' ),
                    'value' => '',
                    'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color')),
                )
            );
            vc_add_param('vc_row',array(
                    'type' => 'number',
                    'class' => '',
                    'heading' => __( 'Overlay opacity', 'g5plus-darna' ),
                    'param_name' => 'overlay_opacity',
                    'value' =>'50',
                    'min'=>'1',
                    'max'=>'100',
                    'suffix'=>'%',
                    'description' => __( 'Select opacity for overlay.', 'g5plus-darna' ),
                    'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color','show_overlay_image')),
                )
            );
            vc_add_param('vc_row',$add_css_animation);

            vc_add_param('vc_row',$add_duration_animation);

            vc_add_param('vc_row',$add_delay_animation);

            vc_add_param('vc_row_inner',
                array(
                    'type'       => 'dropdown',
                    'heading'    => __( 'Layout', 'g5plus-darna' ),
                    'param_name' => 'layout',
                    'value'      => array(
                        __( 'Full Width', 'g5plus-darna' )  => 'wide',
                        __( 'Container', 'g5plus-darna' ) => 'boxed',
                        __( 'Container Fluid', 'g5plus-darna' ) => 'container-fluid',
                    ),
                )
            );
            vc_add_param('vc_row_inner',
                array(
                    'type' => 'dropdown',
                    'heading' => __('Parallax Type','g5plus-darna'),
                    'param_name' => 'parallax_style',
                    'value' => array(
                        __('None','g5plus-darna') => 'none',
                        __('Vertical Parallax On Scroll','g5plus-darna') => 'vertical-parallax',
                        __('Horizontal Parallax On Scroll','g5plus-darna') => 'horizontal-parallax',
                        __('Video Background','g5plus-darna') => 'video-background',
                    ),
                    'description' => __('Select the kind of style you like for the background image of this row.','g5plus-darna'),
                )
            );
            vc_add_param('vc_row_inner',
                array(
                    'type'       => 'textarea',
                    'heading'    => __( 'Link Video (.mp4 or .ogg)', 'g5plus-darna' ),
                    'param_name' => 'video_link',
                    'value'      => '',
                    'dependency' => Array('element' => 'parallax_style','value' => array('video-background')),
                )
            );
            vc_add_param('vc_row_inner',
                array(
                    'type' => 'dropdown',
                    'heading' => __('Scroll effect', 'g5plus-darna'),
                    'param_name' => 'parallax_scroll_effect',
                    'value' => array(
                        __('Fixed at its position', 'g5plus-darna') => 'fixed',
                        __('Move with the content', 'g5plus-darna') => 'scroll',
                    ),
                    'description' => __('Options to set whether a background image is fixed or scroll with the rest of the page.', 'g5plus-darna'),
                    'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),
                )
            );
            vc_add_param('vc_row_inner',
                array(
                    'type' => 'number',
                    'heading' => __('Parallax speed', 'g5plus-darna'),
                    'param_name' => 'parallax_speed',
                    'value' =>'1',
                    'min'=>'1',
                    'max'=>'100',
                    'description' => __('Control speed of parallax. Enter value between 1 to 100', 'g5plus-darna'),
                    'dependency' => Array('element' => 'parallax_style','value' => array('vertical-parallax','horizontal-parallax')),
                )
            );
            vc_add_param('vc_row_inner',
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Show background overlay', 'g5plus-darna' ),
                    'param_name' => 'overlay_set',
                    'description' => __( 'Hide or Show overlay on background images.', 'g5plus-darna' ),
                    'value' => array(
                        __( 'Hide, please', 'g5plus-darna' ) =>'hide_overlay',
                        __( 'Show Overlay Color', 'g5plus-darna' ) =>'show_overlay_color',
                        __( 'Show Overlay Image', 'g5plus-darna' ) =>'show_overlay_image',
                    )
                )
            );
            vc_add_param('vc_row_inner',
                array(
                    'type'        => 'attach_image',
                    'heading'     => __( 'Upload image:', 'g5plus-darna' ),
                    'param_name'  => 'overlay_image',
                    'value'       => '',
                    'description' => __( 'Upload image overlay.', 'g5plus-darna' ),
                    'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),
                )
            );
            vc_add_param('vc_row_inner',
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Overlay color', 'g5plus-darna' ),
                    'param_name' => 'overlay_color',
                    'description' => __( 'Select color for background overlay.', 'g5plus-darna' ),
                    'value' => '',
                    'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color')),
                )
            );
            vc_add_param('vc_row_inner',array(
                    'type' => 'number',
                    'class' => '',
                    'heading' => __( 'Overlay opacity', 'g5plus-darna' ),
                    'param_name' => 'overlay_opacity',
                    'value' =>'50',
                    'min'=>'1',
                    'max'=>'100',
                    'suffix'=>'%',
                    'description' => __( 'Select opacity for overlay.', 'g5plus-darna' ),
                    'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color','show_overlay_image')),
                )
            );
            vc_add_param('vc_row_inner',$add_css_animation);

            vc_add_param('vc_row_inner',$add_duration_animation);

            vc_add_param('vc_row_inner',$add_delay_animation);

            vc_add_param('vc_accordion',array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Layout Style', 'g5plus-darna' ),
                    'param_name'  => 'layout_style',
                    'admin_label' => true,
                    'value'       => array( __( 'style 1', 'g5plus-darna' ) => 'style1'),
                    'description' => __( 'Select Layout Style.', 'g5plus-darna' ),
                    'weight' => 1
                )
            );
            vc_add_param('vc_accordion_tab',array(
                    'type'        => 'icon_text',
                    'heading'     => __( 'Select Icon:', 'g5plus-darna' ),
                    'param_name'  => 'icon',
                    'value'       => '',
                    'description' => __( 'Select the icon from the list.', 'g5plus-darna' ),
                )
            );
            vc_add_param('vc_tab',array(
                    'type'        => 'icon_text',
                    'heading'     => __( 'Select Icon:', 'g5plus-darna' ),
                    'param_name'  => 'icon',
                    'value'       => '',
                    'description' => __( 'Select the icon from the list.', 'g5plus-darna' ),
                )
            );
            vc_add_param('vc_tabs',array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Layout Style', 'g5plus-darna' ),
                    'param_name'  => 'layout_style',
                    'admin_label' => true,
                    'value'       => array( __( 'style 1', 'g5plus-darna' ) => 'style1'),
                    'description' => __( 'Select Layout Style.', 'g5plus-darna' ),
                    'weight' => 2
                )
            );
            vc_add_param('vc_tabs',array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Type', 'g5plus-darna' ),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'value'       => array( __( 'Left', 'g5plus-darna' ) => 'left', __( 'Right', 'g5plus-darna' ) => 'right'),
                    'weight' => 1
                )
            );
            $settings_vc_map = array (
                'category' => __( 'Darna Shortcodes', 'g5plus-darna' )
            );
            vc_map_update( 'vc_tabs', $settings_vc_map );
            vc_map_update( 'vc_accordion', $settings_vc_map );
        }
    }
    g5plus_add_vc_param();
}
else
{
    vc_add_param('vc_tta_accordion', array(
            'type' => 'dropdown',
            'param_name' => 'style',
            'value' => array(
                __('Darna', 'g5plus-darna') => 'accordion_style1',
                __('Classic', 'g5plus-darna') => 'classic',
                __('Modern', 'g5plus-darna') => 'modern',
                __('Flat', 'g5plus-darna') => 'flat',
                __('Outline', 'g5plus-darna') => 'outline',
            ),
            'heading' => __('Style', 'g5plus-darna'),
            'description' => __('Select accordion display style.', 'g5plus-darna'),
            'weight' => 1,
        )
    );
    vc_add_param('vc_tta_tabs', array(
            'type' => 'dropdown',
            'param_name' => 'style',
            'value' => array(
                __('Darna', 'g5plus-darna') => 'tab_style1',
                __('Classic', 'g5plus-darna') => 'classic',
                __('Modern', 'g5plus-darna') => 'modern',
                __('Flat', 'g5plus-darna') => 'flat',
                __('Outline', 'g5plus-darna') => 'outline',
            ),
            'heading' => __('Style', 'g5plus-darna'),
            'description' => __('Select tabs display style.', 'g5plus-darna'),
            'weight' => 1,
        )
    );
    $settings_vc_map = array (
        'category' => __( 'Darna Shortcodes', 'g5plus-darna' )
    );
    vc_map_update( 'vc_tta_tabs', $settings_vc_map );
    vc_map_update( 'vc_tta_accordion', $settings_vc_map );
    function register_vc_map()
    {
        $add_css_animation = array(
            'type' => 'dropdown',
            'heading' => __('CSS Animation', 'g5plus-darna'),
            'param_name' => 'css_animation',
            'value' => array(__('No', 'g5plus-darna') => '', __('Fade In', 'g5plus-darna') => 'wpb_fadeIn', __('Fade Top to Bottom', 'g5plus-darna') => 'wpb_fadeInDown', __('Fade Bottom to Top', 'g5plus-darna') => 'wpb_fadeInUp', __('Fade Left to Right', 'g5plus-darna') => 'wpb_fadeInLeft', __('Fade Right to Left', 'g5plus-darna') => 'wpb_fadeInRight', __('Bounce In', 'g5plus-darna') => 'wpb_bounceIn', __('Bounce Top to Bottom', 'g5plus-darna') => 'wpb_bounceInDown', __('Bounce Bottom to Top', 'g5plus-darna') => 'wpb_bounceInUp', __('Bounce Left to Right', 'g5plus-darna') => 'wpb_bounceInLeft', __('Bounce Right to Left', 'g5plus-darna') => 'wpb_bounceInRight', __('Zoom In', 'g5plus-darna') => 'wpb_zoomIn', __('Flip Vertical', 'g5plus-darna') => 'wpb_flipInX', __('Flip Horizontal', 'g5plus-darna') => 'wpb_flipInY', __('Bounce', 'g5plus-darna') => 'wpb_bounce', __('Flash', 'g5plus-darna') => 'wpb_flash', __('Shake', 'g5plus-darna') => 'wpb_shake', __('Pulse', 'g5plus-darna') => 'wpb_pulse', __('Swing', 'g5plus-darna') => 'wpb_swing', __('Rubber band', 'g5plus-darna') => 'wpb_rubberBand', __('Wobble', 'g5plus-darna') => 'wpb_wobble', __('Tada', 'g5plus-darna') => 'wpb_tada'),
            'description' => __('Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'g5plus-darna'),
            'group' => __('Animation Settings', 'g5plus-darna')
        );

        $add_duration_animation = array(
            'type' => 'textfield',
            'heading' => __('Animation Duration', 'g5plus-darna'),
            'param_name' => 'duration',
            'value' => '',
            'description' => __('Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'g5plus-darna'),
            'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
            'group' => __('Animation Settings', 'g5plus-darna')
        );

        $add_delay_animation = array(
            'type' => 'textfield',
            'heading' => __('Animation Delay', 'g5plus-darna'),
            'param_name' => 'delay',
            'value' => '',
            'description' => __('Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'g5plus-darna'),
            'dependency' => Array('element' => 'css_animation', 'value' => array('wpb_fadeIn', 'wpb_fadeInDown', 'wpb_fadeInUp', 'wpb_fadeInLeft', 'wpb_fadeInRight', 'wpb_bounceIn', 'wpb_bounceInDown', 'wpb_bounceInUp', 'wpb_bounceInLeft', 'wpb_bounceInRight', 'wpb_zoomIn', 'wpb_flipInX', 'wpb_flipInY', 'wpb_bounce', 'wpb_flash', 'wpb_shake', 'wpb_pulse', 'wpb_swing', 'wpb_rubberBand', 'wpb_wobble', 'wpb_tada')),
            'group' => __('Animation Settings', 'g5plus-darna')
        );
        $params_row = array(
            array(
                'type' => 'dropdown',
                'heading' => __('Layout', 'g5plus-darna'),
                'param_name' => 'layout',
                'value' => array(
                    __('Full Width', 'g5plus-darna') => 'wide',
                    __('Container', 'g5plus-darna') => 'boxed',
                    __('Container Fluid', 'g5plus-darna') => 'container-fluid',
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Full height row?', 'g5plus-darna'),
                'param_name' => 'full_height',
                'description' => __('If checked row will be set to full height.', 'g5plus-darna'),
                'value' => array(__('Yes', 'g5plus-darna') => 'yes')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Content position', 'g5plus-darna'),
                'param_name' => 'content_placement',
                'value' => array(
                    __('Middle', 'g5plus-darna') => 'middle',
                    __('Top', 'g5plus-darna') => 'top',
                ),
                'description' => __('Select content position within row.', 'g5plus-darna'),
                'dependency' => array(
                    'element' => 'full_height',
                    'not_empty' => true,
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => __('Use video background?', 'g5plus-darna'),
                'param_name' => 'video_bg',
                'description' => __('If checked, video will be used as row background.', 'g5plus-darna'),
                'value' => array(__('Yes', 'g5plus-darna') => 'yes')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('YouTube link', 'g5plus-darna'),
                'param_name' => 'video_bg_url',
                'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k', // default video url
                'description' => __('Add YouTube link.', 'g5plus-darna'),
                'dependency' => array(
                    'element' => 'video_bg',
                    'not_empty' => true,
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Parallax', 'g5plus-darna'),
                'param_name' => 'video_bg_parallax',
                'value' => array(
                    __('None', 'g5plus-darna') => '',
                    __('Simple', 'g5plus-darna') => 'content-moving',
                    __('With fade', 'g5plus-darna') => 'content-moving-fade',
                ),
                'description' => __('Add parallax type background for row.', 'g5plus-darna'),
                'dependency' => array(
                    'element' => 'video_bg',
                    'not_empty' => true,
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Parallax', 'g5plus-darna'),
                'param_name' => 'parallax',
                'value' => array(
                    __('None', 'g5plus-darna') => '',
                    __('Simple', 'g5plus-darna') => 'content-moving',
                    __('With fade', 'g5plus-darna') => 'content-moving-fade',
                ),
                'description' => __('Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'g5plus-darna'),
                'dependency' => array(
                    'element' => 'video_bg',
                    'is_empty' => true,
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('Image', 'g5plus-darna'),
                'param_name' => 'parallax_image',
                'value' => '',
                'description' => __('Select image from media library.', 'g5plus-darna'),
                'dependency' => array(
                    'element' => 'parallax',
                    'not_empty' => true,
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Parallax speed', 'g5plus-darna'),
                'param_name' => 'parallax_speed',
                'value' => '1.5',
                'dependency' => Array('element' => 'parallax', 'value' => array('content-moving', 'content-moving-fade')),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Show background overlay', 'g5plus-darna'),
                'param_name' => 'overlay_set',
                'description' => __('Hide or Show overlay on background images.', 'g5plus-darna'),
                'value' => array(
                    __('Hide, please', 'g5plus-darna') => 'hide_overlay',
                    __('Show Overlay Color', 'g5plus-darna') => 'show_overlay_color',
                    __('Show Overlay Image', 'g5plus-darna') => 'show_overlay_image',
                )
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('Image Overlay:', 'g5plus-darna'),
                'param_name' => 'overlay_image',
                'value' => '',
                'description' => __('Upload image overlay.', 'g5plus-darna'),
                'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_image')),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Overlay color', 'g5plus-darna'),
                'param_name' => 'overlay_color',
                'description' => __('Select color for background overlay.', 'g5plus-darna'),
                'value' => '',
                'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_color')),
            ),
            array(
                'type' => 'number',
                'class' => '',
                'heading' => __('Overlay opacity', 'g5plus-darna'),
                'param_name' => 'overlay_opacity',
                'value' => '50',
                'min' => '1',
                'max' => '100',
                'suffix' => '%',
                'description' => __('Select opacity for overlay.', 'g5plus-darna'),
                'dependency' => Array('element' => 'overlay_set', 'value' => array('show_overlay_color', 'show_overlay_image')),
            ),
            array(
                'type' => 'el_id',
                'heading' => __('Row ID', 'g5plus-darna'),
                'param_name' => 'el_id',
                'description' => sprintf(__('Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'g5plus-darna'), 'http://www.w3schools.com/tags/att_global_id.asp'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'g5plus-darna'),
                'param_name' => 'el_class',
                'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'g5plus-darna'),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __('CSS box', 'g5plus-darna'),
                'param_name' => 'css',
                'group' => __('Design Options', 'g5plus-darna')
            ),
            $add_css_animation,
            $add_duration_animation,
            $add_delay_animation,
        );
        vc_map(array(
            'name' => __('Row', 'g5plus-darna'),
            'base' => 'vc_row',
            'is_container' => true,
            'icon' => 'icon-wpb-row',
            'show_settings_on_create' => false,
            'category' => __('Content', 'g5plus-darna'),
            'description' => __('Place content elements inside the row', 'g5plus-darna'),
            'params' => $params_row,
            'js_view' => 'VcRowView'
        ));
        vc_map(array(
            'name' => __('Row', 'g5plus-darna'), //Inner Row
            'base' => 'vc_row_inner',
            'content_element' => false,
            'is_container' => true,
            'icon' => 'icon-wpb-row',
            'weight' => 1000,
            'show_settings_on_create' => false,
            'description' => __('Place content elements inside the row', 'g5plus-darna'),
            'params' => $params_row,
            'js_view' => 'VcRowView'
        ));
    }
    add_action('vc_after_init', 'register_vc_map');
}