<?php
/**
 * Notification box
 * 
 * Creates a notification box to inform visitors
 */
if ( ! defined( 'ABSPATH' ) ) {  exit;  }    // Exit if accessed directly


if ( ! class_exists( 'avia_sc_notification' ) ) 
{
	class avia_sc_notification extends aviaShortcodeTemplate
	{
		/**
		 * Create the config array for the shortcode button
		 */
		function shortcode_insert_button()
		{
			$this->config['version']		= '1.0';
			$this->config['self_closing']	= 'no';
			$this->config['base_element']	= 'yes';

			$this->config['name']			= __( 'Notification', 'avia_framework' );
			$this->config['tab']			= __( 'Content Elements', 'avia_framework' );
			$this->config['icon']			= AviaBuilder::$path['imagesURL'] . 'sc-notification.png';
			$this->config['order']			= 80;
			$this->config['target']			= 'avia-target-insert';
			$this->config['shortcode']		= 'av_notification';
			$this->config['tooltip']		= __( 'Creates a notification box to inform visitors', 'avia_framework' );
			$this->config['tinyMCE']		= array( 'tiny_always' => true );	
			$this->config['preview']		= true;
			$this->config['disabling_allowed'] = true;
		}

		function extra_assets()
		{
			//load css
			wp_enqueue_style( 'avia-modfule-notification', AviaBuilder::$path['pluginUrlRoot'] . 'avia-shortcodes/notification/notification.css', array( 'avia-layout' ), false );

			//load js
			wp_enqueue_script( 'avia-mofdule-notification', AviaBuilder::$path['pluginUrlRoot'] . 'avia-shortcodes/notification/notification.js', array( 'avia-shortcodes' ), false, true );
		}
		
		/**
		 * Popup Elements
		 *
		 * If this function is defined in a child class the element automatically gets an edit button, that, when pressed
		 * opens a modal window that allows to edit the element properties
		 *
		 * @return void
		 */
        function popup_elements()
        {
            $this->elements = array(

				array(
						'type' 	=> 'tab_container', 
						'nodescription' => true
					),
						
				array(
						'type' 	=> 'tab',
						'name'  => __( 'Content', 'avia_framework' ),
						'nodescription' => true
					),
						array(	
								'type'			=> 'template',
								'template_id'	=> $this->popup_key( 'content_notification' )
							),
				
				array(
						'type' 	=> 'tab_close',
						'nodescription' => true
					),

				array(
						'type' 	=> 'tab',
						'name'  => __( 'Styling', 'avia_framework' ),
						'nodescription' => true
					),
				
					array(
							'type'			=> 'template',
							'template_id'	=> 'toggle_container',
							'templates_include'	=> array(
													$this->popup_key( 'styling_colors' ),
													$this->popup_key( 'styling_appearance' )
												),
							'nodescription' => true
						),
				
				array(
						'type' 	=> 'tab_close',
						'nodescription' => true
					),
				
				array(
						'type' 	=> 'tab',
						'name'  => __( 'Advanced', 'avia_framework' ),
						'nodescription' => true
					),
				
					array(
							'type' 	=> 'toggle_container',
							'nodescription' => true
						),
				
						array(	
								'type'			=> 'template',
								'template_id'	=> 'screen_options_toggle',
								'lockable'		=> true
							),
				
						array(	
								'type'			=> 'template',
								'template_id'	=> 'developer_options_toggle',
								'args'			=> array( 'sc' => $this )
							),
				
					array(
							'type' 	=> 'toggle_container_close',
							'nodescription' => true
						),
				
				array(
						'type' 	=> 'tab_close',
						'nodescription' => true
					),
				
				array(	
						'type'			=> 'template',
						'template_id'	=> 'element_template_selection_tab',
						'args'			=> array( 'sc' => $this )
					),

				array(
						'type' 	=> 'tab_container_close',
						'nodescription' => true
					)
                
            );

        }

		/**
		 * Create and register templates for easier maintainance
		 * 
		 * @since 4.6.4
		 */
		protected function register_dynamic_templates()
		{
			
			/**
			 * Content Tab
			 * ===========
			 */
			
			$c = array(
						array(	
							'name' 	=> __( 'Title', 'avia_framework' ),
							'desc' 	=> __( 'This is the small title at the top of your Notification.', 'avia_framework' ),
							'id' 	=> 'title',
							'type' 	=> 'input',
							'std'	=> __( 'Note', 'avia_framework' ),
							'lockable'	=> true,
							'tmpl_set_default'	=> false
						),

						array(	
							'name' 	=> __( 'Message', 'avia_framework' ),
							'desc' 	=> __( 'This is the text that appears in your Notification.', 'avia_framework' ),
							'id' 	=> 'content',
							'type' 	=> 'textarea',
							'std'	=> __( 'This is a notification of some sort.', 'avia_framework' ),
							'lockable'	=> true,
							'tmpl_set_default'	=> false
						),
                
						array(
							'name' 	=> __( 'Button Icon', 'avia_framework' ),
							'desc' 	=> __( 'Should an icon be displayed at the left side of the button', 'avia_framework' ),
							'id' 	=> 'icon_select',
							'type' 	=> 'select',
							'std' 	=> 'yes',
							'lockable'	=> true,
							'subtype'	=> array(
												__( 'No Icon', 'avia_framework' )			=> 'no',
												__( 'Yes, display Icon', 'avia_framework' )	=> 'yes'
											)
						),

						array(
							'name' 	=> __( 'Button Icon', 'avia_framework' ),
							'desc' 	=> __( 'Select an icon for your Button below', 'avia_framework' ),
							'id' 	=> 'icon',
							'type' 	=> 'iconfont',
							'std' 	=> '',
							'lockable'	=> true,
							'locked'	=> array( 'icon', 'font' ),
							'required'	=> array( 'icon_select', 'equals', 'yes' )
						),
				
						array(
							'name' 	=> __( 'Close Button', 'avia_framework' ),
							'desc' 	=> __( 'Display a button that closes the notification when clicked.', 'avia_framework' ),
							'id' 	=> 'close_btn',
							'type' 	=> 'select',
							'std' 	=> '',
							'lockable'	=> true,
							'subtype'	=> array(
												__( 'No Close Button ', 'avia_framework' )		=> '',
												__( 'Yes, display a Close Button - Set Cookie for the current Session', 'avia_framework' )	=> 'session_cookie',
												__( 'Yes, display a Close Button - Set Cookie with a custom Lifetime', 'avia_framework' )	=> 'custom_cookie',
											)
						),

						array(	
							'name' 	=> __( 'Cookie Lifetime', 'avia_framework' ),
							'desc' 	=> __( 'How many days until the Cookie expires and the message is displayed again? The Cookie expires automatically if either the title, text or message color is changed.', 'avia_framework' ),
							'id' 	=> 'cookie_lifetime',
							'type' 	=> 'select',
							'std'	=> '60',
							'lockable'	=> true,
							'required'	=> array( 'close_btn', 'equals', 'custom_cookie' ),
							'subtype'	=> AviaHtmlHelper::number_array( 1, 800, 1 ),
						)
				
				);
			
			
			AviaPopupTemplates()->register_dynamic_template( $this->popup_key( 'content_notification' ), $c );
			
			
			/**
			 * Styling Tab
			 * ===========
			 */
			
			$c = array(
						array(
							'name' 	=> __( 'Message Colors', 'avia_framework' ),
							'desc' 	=> __( 'Choose the color for your Box here', 'avia_framework' ),
							'id' 	=> 'color',
							'type' 	=> 'select',
							'std' 	=> 'green',
							'lockable'	=> true,
							'subtype'	=> array(
												__( 'Success (Green)', 'avia_framework' )		=> 'green',
												__( 'Notification (Blue)', 'avia_framework' )	=> 'blue',
												__( 'Warning (Red)',  'avia_framework' )		=> 'red',
												__( 'Alert (Orange)', 'avia_framework' )		=> 'orange',
												__( 'Neutral (Light Grey)', 'avia_framework' )	=> 'silver',
												__( 'Neutral (Dark Grey)', 'avia_framework' )	=> 'grey',
												__( 'Custom Color', 'avia_framework' )			=> 'custom',
											)
						),
				
						array(
							'name' 	=> __( 'Custom Background Color', 'avia_framework' ),
							'desc' 	=> __( 'Select a custom background color for your Notification here', 'avia_framework' ),
							'id' 	=> 'custom_bg',
							'type' 	=> 'colorpicker',
							'std' 	=> '#444444',
							'lockable'	=> true,
							'required'	=> array( 'color', 'equals', 'custom' )
						),

						array(
							'name' 	=> __( 'Custom Font Color', 'avia_framework' ),
							'desc' 	=> __( 'Select a custom font color for your Notification here', 'avia_framework' ),
							'id' 	=> 'custom_font',
							'type' 	=> 'colorpicker',
							'std' 	=> '#ffffff',
							'lockable'	=> true,
							'required'	=> array( 'color', 'equals', 'custom' )
						)

				);
			
			$template = array(
							array(	
								'type'			=> 'template',
								'template_id'	=> 'toggle',
								'title'			=> __( 'Colors', 'avia_framework' ),
								'content'		=> $c 
							),
					);
			
			AviaPopupTemplates()->register_dynamic_template( $this->popup_key( 'styling_colors' ), $template );
			
			$c = array(
						array(
							'name' 	=> __( 'Notification Box Border', 'avia_framework' ),
							'desc' 	=> __( 'Choose the border for your Box here', 'avia_framework' ),
							'id' 	=> 'border',
							'type' 	=> 'select',
							'std' 	=> '',
							'lockable'	=> true,
							'subtype'	=> array(
												__( 'None', 'avia_framework' )		=> '',
												__( 'Solid', 'avia_framework' )		=> 'solid',
												__( 'Dashed', 'avia_framework' )	=> 'dashed',
                    )),

						array(
							'name' 	=> __( 'Box Size', 'avia_framework' ),
							'desc' 	=> __( 'Choose the size of your Box here', 'avia_framework' ),
							'id' 	=> 'size',
							'type' 	=> 'select',
							'std' 	=> 'large',
							'lockable'	=> true,
							'subtype'	=> array(
												__( 'Normal', 'avia_framework' )	=> 'normal',
												__( 'Large', 'avia_framework' )		=> 'large',
											)
						)
				);
			
			$template = array(
							array(	
								'type'			=> 'template',
								'template_id'	=> 'toggle',
								'title'			=> __( 'Appearance', 'avia_framework' ),
								'content'		=> $c 
							),
					);
			
			AviaPopupTemplates()->register_dynamic_template( $this->popup_key( 'styling_appearance' ), $template );
				
		}

		/**
		 * Editor Element - this function defines the visual appearance of an element on the AviaBuilder Canvas
		 * Most common usage is to define some markup in the $params['innerHtml'] which is then inserted into the drag and drop container
		 * Less often used: $params['data'] to add data attributes, $params['class'] to modify the className
		 *
		 *
		 * @param array $params this array holds the default values for $content and $args. 
		 * @return $params the return array usually holds an innerHtml key that holds item specific markup.
		 */
		function editor_element( $params )
		{
			$default = array();
			$locked = array();
			$attr = $params['args'];
			$content = $params['content'];
			
			Avia_Element_Templates()->set_locked_attributes( $attr, $this, $this->config['shortcode'], $default, $locked, $content );
			
			extract( av_backend_icon( array( 'args' => $attr ) ) ); // creates $font and $display_char if the icon was passed as param 'icon' and the font as 'font'

			$inner  = "<div class='avia_message_box avia_hidden_bg_box avia_textblock avia_textblock_style' data-update_element_template='yes'>";
			$inner .=		'<div ' . $this->class_by_arguments_lockable( 'color, size, icon_select, border', $attr, $locked ) . '>';
			$inner .=			'<span ' . $this->class_by_arguments_lockable( 'font', $font, $locked ) . '>';
			$inner .=				'<span ' . $this->update_option_lockable( array( 'icon', 'icon_fakeArg' ), $locked ) . " class='avia_message_box_icon'>{$display_char}</span>";
			$inner .=			'</span>';
			$inner .=			'<span ' . $this->update_option_lockable( 'title', $locked ) . " class='avia_message_box_title' >{$attr['title']}</span>";
			$inner .=			'<span ' . $this->update_option_lockable( 'content', $locked ) . " class='avia_message_box_content' >{$content}</span>";
			$inner .=		'</div>';
			$inner .= '</div>';

			$params['innerHtml'] = $inner;
			$params['class'] = '';
			
			return $params;
		}
			
			
			
		/**
		 * Frontend Shortcode Handler
		 *
		 * @param array $atts array of attributes
		 * @param string $content text within enclosing form of shortcode element 
		 * @param string $shortcodename the shortcode found, when == callback name
		 * @return string $output returns the modified html string 
		 */
		function shortcode_handler( $atts, $content = '', $shortcodename = '', $meta = '' )
		{
			$default = array(
						'title'			=> '',
						'color'			=> 'green',
						'border'		=> '',
						'custom_bg'		=> '#444444',
						'custom_font'	=> '#ffffff',
						'size'			=> 'large',
						'icon_select'	=> 'yes',
						'icon'			=> '',
						'font'			=> '',
						'close_btn'		=> '',
						'cookie_lifetime' => ''
					);
			
			$locked = array();
			Avia_Element_Templates()->set_locked_attributes( $atts, $this, $shortcodename, $default, $locked, $content );
			Avia_Element_Templates()->add_template_class( $meta, $atts, $default );
			
			extract( AviaHelper::av_mobile_sizes( $atts ) ); //return $av_font_classes, $av_title_font_classes and $av_display_classes

			$atts = shortcode_atts( $default, $atts, $this->config['shortcode'] );

			$display_char = av_icon( $atts['icon'], $atts['font'] );

			$output = '';
			$style = '';
			$cookie_contents = '';
			$cookie_lifetime = '';
			$cookie_contents_hash = '';

			if( $atts['color'] == 'custom' )
			{
				$style .= "style='background-color:{$atts['custom_bg']}; color:{$atts['custom_font']}; '";
			}

			if( $atts['close_btn'] ) 
			{
				$meta['el_class'] = $meta['el_class'].' messagebox-hidden messagebox-'.$atts['close_btn'];
				$cookie_contents_hash = md5( $atts['color'] . $atts['custom_bg'] . $atts['custom_font'] . $atts['title'] . ShortcodeHelper::avia_apply_autop( ShortcodeHelper::avia_remove_autop( $content ) ) );
				$cookie_contents = " data-contents='{$cookie_contents_hash}'";
				$cookie_lifetime = " data-cookielifetime='{$atts['cookie_lifetime']}'";
			}

			$output .= "<div id='avia-messagebox-{$cookie_contents_hash}'";
			$output .= $style;
			$output .= " class='avia_message_box {$av_display_classes} " . $this->class_by_arguments( 'color, size, icon_select, border', $atts, true ) . $meta['el_class'] . "'";
			$output .= $cookie_contents;
			$output .= $cookie_lifetime;
			$output .= '>';


			if( $atts['title'] )
			{
				$output .= "<span class='avia_message_box_title' >{$atts['title']}</span>";
			}

			$output .= "<div class='avia_message_box_content' >";

			if( $atts['icon_select'] == 'yes' )
			{
				$output .= "<span class='avia_message_box_icon' {$display_char}></span>";
			}
			$output .= ShortcodeHelper::avia_apply_autop( ShortcodeHelper::avia_remove_autop( $content ) ) . '</div>';

			if( $atts['close_btn'] ) 
			{
				$output .= '<a class="av_message_close">×</a>';
			}

			$output .= '</div>';

			return $output;
		}

    }
}
