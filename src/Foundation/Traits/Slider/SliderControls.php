<?php
/**
 * Slider Controls file
 *
 * @category   Controls
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Foundation\Traits\Slider;

use Elementor\Controls_Manager;

/**
 * Slider Controls trait
 *
 * @category   Trait
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
trait SliderControls {

	use Fields;

	/**
	 * Register Slider Controls.
	 *
	 * @param object $element Elementor element object.
	 * @param string $prefix Prefix.
	 *
	 * @return void
	 */
	protected function register_slider_controls( $element, $prefix = 'cxf' ) {
		// $fields = $this->init_fields_by_name($prefix);

		// foreach( $fields as $control => $field ) {
		// $control_name = "{$prefix}_{$control}";
		// $condition = $field['condition'] ?? null;
		// $conditions = [];

		// if ( is_array( $condition ) ) {
		// foreach( $condition as $name => $value ) {
		// $conditions["{$prefix}_{$name}"] = $value;
		// }
		// }
		// if ( count( $conditions ) > 0 ) {
		// $field['condition'] = $conditions;
		// }

		// $element->add_control($control_name, $field);
		// }

		/**
		 *  Get slider options.
		 *
		 * Fires when Slider widget is being initialized.
		 *
		 * @since 1.0.0
		 *
		 * @param array $options Slider options.
		 */
		$this->options   = apply_filters( 'cxf/slider/options', $this->options );
		$slides_per_view = array(
			'auto'   => esc_html__( 'Auto', 'codexshaper-framework' ),
			'1'      => 1,
			'2'      => 2,
			'3'      => 3,
			'4'      => 4,
			'5'      => 5,
			'6'      => 6,
			'7'      => 7,
			'8'      => 8,
			'9'      => 9,
			'10'     => 10,
			'custom' => esc_html__( 'Custom', 'codexshaper-framework' ),
		);
		/**
		 *  Get slider slides per screen.
		 *
		 * Fires when Slider widget is being initialized.
		 *
		 * @since 1.0.0
		 *
		 * @param array $slides_per_view Slides per screeen.
		 */
		$slides_per_view = apply_filters( "cxf/slider/{$this->get_name()}/slides_per_view", $slides_per_view );
		$element->add_control(
			"{$prefix}_slider_type",
			array(
				'label'              => esc_html__( 'Provider', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['slider_type'],
				'options'            => array(
					'default' => esc_html__( 'Deafult', 'codexshaper-framework' ),
					'swiper'  => esc_html__( 'Swiper', 'codexshaper-framework' ),
				),
				'frontend_available' => true,
			)
		);
		$element->add_responsive_control(
			"{$prefix}_slides_per_view",
			array(
				'label'              => esc_html__( 'Slides to Show', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => $slides_per_view,
				'default'            => $this->options['slides_per_view'],
				'frontend_available' => true,
			)
		);
		$element->add_responsive_control(
			"{$prefix}_custom_slides_per_view",
			array(
				'label'              => esc_html__( 'Custom Slides to Show', 'codexshaper-framework' ),
				'type'               => Controls_Manager::TEXT,
				'description'        => esc_html__( 'Enter either string or integer number. E.g: Either auto,1,5, etc', 'codexshaper-framework' ),
				'default'            => $this->options['custom_slides_per_view'],
				'condition'          => array(
					"{$prefix}_slides_per_view" => 'custom',
				),
				'frontend_available' => true,
			)
		);
		// Loop and autoplay.
		$element->add_control(
			"{$prefix}_loop_heading",
			array(
				'label'     => esc_html__( 'Autoplay & Loop', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$element->add_control(
			"{$prefix}_loop",
			array(
				'label'              => esc_html__( 'Loop', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['loop'],
				'options'            => array(
					'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
					'no'  => esc_html__( 'No', 'codexshaper-framework' ),
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_autoplay",
			array(
				'label'              => esc_html__( 'Autoplay', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => esc_html__( 'Enter value as a miliseconds. E.g: Input 1000 use as 1000ms.', 'codexshaper-framework' ),
				'options'            => array(
					'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
					'no'  => esc_html__( 'No', 'codexshaper-framework' ),
				),
				'default'            => $this->options['autoplay'],
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_autoplay_delay",
			array(
				'label'              => esc_html__( 'Autoplay delay', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'description'        => esc_html__( 'Enter value as a miliseconds. E.g: Input 1000 use as 1000ms.', 'codexshaper-framework' ),
				'default'            => $this->options['autoplay_delay'],
				'condition'          => array(
					"{$prefix}_autoplay" => 'yes',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_autoplay_interaction",
			array(
				'label'              => esc_html__( 'Autoplay Interaction', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['autoplay_interaction'],
				'options'            => array(
					'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
					'no'  => esc_html__( 'No', 'codexshaper-framework' ),
				),
				'condition'          => array(
					"{$prefix}_autoplay" => 'yes',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_reverse_direction",
			array(
				'label'              => esc_html__( 'Reverse direction', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
				'default'            => $this->options['reverse_direction'],
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_allow_touch_move",
			array(
				'label'              => esc_html__( 'Allow Touch Move', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'separator'          => 'before',
				'default'            => $this->options['allow_touch_move'],
				'options'            => array(
					'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
					'no'  => esc_html__( 'No', 'codexshaper-framework' ),
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_mousewheel",
			array(
				'label'              => esc_html__( 'Mousewheel', 'codexshaper-framework' ),
				'description'        => esc_html__( 'If you want to use mousewheel, please disable loop.', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
				'return_value'       => 'yes',
				'default'            => $this->options['mousewheel'],
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_speed",
			array(
				'label'              => esc_html__( 'Animation Speed', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => $this->options['speed'],
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_space_between",
			array(
				'label'              => esc_html__( 'Space Between', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => $this->options['space_between'],
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_effect",
			array(
				'label'              => esc_html__( 'Effect', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['effect'],
				'options'            => array(
					'slide'     => esc_html__( 'Slide', 'codexshaper-framework' ),
					'fade'      => esc_html__( 'Fade', 'codexshaper-framework' ),
					'coverflow' => esc_html__( 'Coverflow', 'codexshaper-framework' ),
					'flip'      => esc_html__( 'Flip', 'codexshaper-framework' ),
					'cube'      => esc_html__( 'Cube', 'codexshaper-framework' ),
					'cards'     => esc_html__( 'Cards', 'codexshaper-framework' ),
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_slide_shadows",
			array(
				'label'              => esc_html__( 'Slide Shadows', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
				'default'            => 'yes',
				'return_value'       => 'yes',
				'condition'          => array(
					"{$prefix}_effect" => array(
						'coverflow',
						'flip',
						'cube',
						'cards',
					),
				),
				'frontend_available' => true,
			)
		);
		// Swiper Fade.
		$element->add_control(
			"{$prefix}_cross_fade",
			array(
				'label'              => esc_html__( 'Navigation', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
				'default'            => $this->options['navigation'],
				'return_value'       => 'yes',
				'condition'          => array(
					"{$prefix}_effect" => 'fade',
				),
				'frontend_available' => true,
			)
		);
		// Swiper Coverflow effect.
		$element->add_control(
			"{$prefix}_effect_coverflow_heading",
			array(
				'label'     => esc_html__( 'Coverflow Effect', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => array(
					"{$prefix}_effect" => 'coverflow',
				),
			)
		);
		$element->add_control(
			"{$prefix}_coverflow_depth",
			array(
				'label'              => esc_html__( 'Depth', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 100,
				'condition'          => array(
					"{$prefix}_effect" => 'coverflow',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_coverflow_modifier",
			array(
				'label'              => esc_html__( 'Modifier', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'condition'          => array(
					"{$prefix}_effect" => 'coverflow',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_coverflow_rotate",
			array(
				'label'              => esc_html__( 'Rotate', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 50,
				'condition'          => array(
					"{$prefix}_effect" => 'coverflow',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_coverflow_scale",
			array(
				'label'              => esc_html__( 'Scale', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'condition'          => array(
					"{$prefix}_effect" => 'coverflow',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_coverflow_stretch",
			array(
				'label'              => esc_html__( 'Stretch', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0,
				'condition'          => array(
					"{$prefix}_effect" => 'coverflow',
				),
				'frontend_available' => true,
			)
		);
		// Swiper Flip effect.
		$element->add_control(
			"{$prefix}_effect_flip_heading",
			array(
				'label'     => esc_html__( 'Flip Effect', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => array(
					"{$prefix}_effect" => 'flip',
				),
			)
		);
		$element->add_control(
			"{$prefix}_flip_limit_rotation",
			array(
				'label'              => esc_html__( 'Limit Rotation', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
				'default'            => 'yes',
				'return_value'       => 'yes',
				'condition'          => array(
					"{$prefix}_effect" => 'flip',
				),
				'frontend_available' => true,
			)
		);
		// Swiper Cube effect.
		$element->add_control(
			"{$prefix}_effect_cube_heading",
			array(
				'label'     => esc_html__( 'Cube Effect', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => array(
					"{$prefix}_effect" => 'cube',
				),
			)
		);
		$element->add_control(
			"{$prefix}_cube_shadow",
			array(
				'label'              => esc_html__( 'Shadow', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
				'default'            => 'yes',
				'return_value'       => 'yes',
				'condition'          => array(
					"{$prefix}_effect" => 'cube',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_cube_shadow_offset",
			array(
				'label'              => esc_html__( 'Shadow Offset', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 20,
				'condition'          => array(
					"{$prefix}_effect" => 'cube',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_cube_shadow_scale",
			array(
				'label'              => esc_html__( 'Shadow Scale', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0.94,
				'step'               => 0.01,
				'condition'          => array(
					"{$prefix}_effect" => 'cube',
				),
				'frontend_available' => true,
			)
		);
		// Swiper Cards Effect.
		$element->add_control(
			"{$prefix}_effect_cards_heading",
			array(
				'label'     => esc_html__( 'Cards Effect', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => array(
					"{$prefix}_effect" => 'cards',
				),
			)
		);
		$element->add_control(
			"{$prefix}_cards_rotate",
			array(
				'label'              => esc_html__( 'Rotate', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
				'default'            => 'yes',
				'return_value'       => 'yes',
				'condition'          => array(
					"{$prefix}_effect" => 'cards',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_cards_per_slide_offsett",
			array(
				'label'              => esc_html__( 'Per Slide Offset', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 8,
				'condition'          => array(
					"{$prefix}_effect" => 'cards',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_cards_per_slide_rotate",
			array(
				'label'              => esc_html__( 'Per Slide Rotate', 'codexshaper-framework' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 2,
				'condition'          => array(
					"{$prefix}_effect" => 'cards',
				),
				'frontend_available' => true,
			)
		);
		// Navigation.
		$element->add_control(
			"{$prefix}_navigation_heading",
			array(
				'label'     => esc_html__( 'Navigation', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$element->add_responsive_control(
			"{$prefix}_navigation",
			array(
				'label'              => esc_html__( 'Navigation', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['navigation'],
				'options'            => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
				'frontend_available' => true,
			)
		);
		$element->add_responsive_control(
			"{$prefix}_navigation_previous_icon",
			array(
				'label'              => esc_html__( 'Previous Arrow Icon', 'codexshaper-framework' ),
				'type'               => Controls_Manager::ICONS,
				'fa4compatibility'   => 'icon',
				'skin'               => 'inline',
				'label_block'        => false,
				'skin_settings'      => array(
					'inline' => array(
						'none' => array(
							'label' => 'Default',
							'icon'  => 'eicon-chevron-left',
						),
						'icon' => array(
							'icon' => 'eicon-star',
						),
					),
				),
				'recommended'        => array(
					'fa-regular' => array(
						'arrow-alt-circle-left',
						'caret-square-left',
					),
					'fa-solid'   => array(
						'angle-double-left',
						'angle-left',
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'caret-left',
						'caret-square-left',
						'chevron-circle-left',
						'chevron-left',
						'long-arrow-alt-left',
					),
				),
				'condition'          => array(
					"{$prefix}_navigation" => 'yes',
				),
				'frontend_available' => true,
			)
		);
		$element->add_responsive_control(
			"{$prefix}_navigation_next_icon",
			array(
				'label'              => esc_html__( 'Next Arrow Icon', 'codexshaper-framework' ),
				'type'               => Controls_Manager::ICONS,
				'fa4compatibility'   => 'icon',
				'skin'               => 'inline',
				'label_block'        => false,
				'skin_settings'      => array(
					'inline' => array(
						'none' => array(
							'label' => 'Default',
							'icon'  => 'eicon-chevron-right',
						),
						'icon' => array(
							'icon' => 'eicon-star',
						),
					),
				),
				'recommended'        => array(
					'fa-regular' => array(
						'arrow-alt-circle-right',
						'caret-square-right',
					),
					'fa-solid'   => array(
						'angle-double-right',
						'angle-right',
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'caret-right',
						'caret-square-right',
						'chevron-circle-right',
						'chevron-right',
						'long-arrow-alt-right',
					),
				),
				'condition'          => array(
					"{$prefix}_navigation" => 'yes',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_pagination_heading",
			array(
				'label'     => esc_html__( 'Pagination', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		$element->add_responsive_control(
			"{$prefix}_pagination",
			array(
				'label'              => esc_html__( 'Pagination', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['pagination'],
				'options'            => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
				'frontend_available' => true,
			)
		);
		$element->add_responsive_control(
			"{$prefix}_pagination_type",
			array(
				'label'              => esc_html__( 'Pagination Type', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['pagination_type'],
				'options'            => array(
					'bullets'     => esc_html__( 'Bullets', 'codexshaper-framework' ),
					'fraction'    => esc_html__( 'Fraction', 'codexshaper-framework' ),
					'progressbar' => esc_html__( 'Progressbar', 'codexshaper-framework' ),
				),
				'condition'          => array(
					"{$prefix}_pagination" => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$element->add_responsive_control(
			"{$prefix}_pagination_bullets_type",
			array(
				'label'              => esc_html__( 'Pagination Type', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['pagination_bullets_type'],
				'options'            => array(
					'default' => esc_html__( 'Deafault', 'codexshaper-framework' ),
					'number'  => esc_html__( 'Number', 'codexshaper-framework' ),
				),
				'condition'          => array(
					"{$prefix}_pagination"      => 'yes',
					"{$prefix}_pagination_type" => 'bullets',
				),
				'frontend_available' => true,
			)
		);
		// Advanced settings.
		$element->add_control(
			"{$prefix}_slider_advanced_heading",
			array(
				'label'     => esc_html__( 'Advanced', 'codexshaper-framework' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);
		// $element->add_control(
		// "{$prefix}_default_min_breakpoint",
		// array(
		// 'label'     => esc_html__( 'Desktop Min Screen Size', 'codexshaper-framework' ),
		// 'type'      => Controls_Manager::NUMBER,
		// 'default'   => $this->options['default_min_breakpoint'],
		// 'frontend_available' => true,
		// )
		// );
		$element->add_control(
			"{$prefix}_direction",
			array(
				'label'              => esc_html__( 'Slide Direction', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['direction'],
				'options'            => array(
					'horizontal' => esc_html__( 'Horizontal', 'codexshaper-framework' ),
					'vertical'   => esc_html__( 'Vertical', 'codexshaper-framework' ),
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_dir",
			array(
				'label'              => esc_html__( 'Horizontal Direction', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['horizontal_direction'],
				'options'            => array(
					'ltr' => esc_html__( 'Left', 'codexshaper-framework' ),
					'rtl' => esc_html__( 'Right', 'codexshaper-framework' ),
				),
				'condition'          => array(
					"{$prefix}_direction" => 'horizontal',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_loop_additional_slides",
			array(
				'label'              => esc_html__( 'Loop Additional Slides', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => $this->options['loop_additional_slides'],
				'options'            => array(
					'slides_per_view' => esc_html__( 'Same as slides per view', 'codexshaper-framework' ),
					'custom'          => esc_html__( 'Custom', 'codexshaper-framework' ),
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_custom_loop_additional_slides",
			array(
				'label'              => esc_html__( 'Custom Loop Additional Slides', 'codexshaper-framework' ),
				'type'               => Controls_Manager::TEXT,
				'description'        => esc_html__( 'Enter either string or integer number. E.g: Either auto,1,5, etc', 'codexshaper-framework' ),
				'default'            => $this->options['custom_slides_per_view'],
				'condition'          => array(
					"{$prefix}_loop_additional_slides" => 'custom',
				),
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_watch_slides_progress",
			array(
				'label'              => esc_html__( 'Watch Slides Progress', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
				'default'            => $this->options['watch_slides_progress'],
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_slide_to_clicked_slide",
			array(
				'label'              => esc_html__( 'Slide To Clicked Slide', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
				'default'            => $this->options['slide_to_clicked_slide'],
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_centered_slides",
			array(
				'label'              => esc_html__( 'Centered Slides', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
				'default'            => $this->options['centered_slides'],
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);
		$element->add_control(
			"{$prefix}_slideshow_lazyload",
			array(
				'label'              => esc_html__( 'Slide show lazyload?', 'codexshaper-framework' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
				'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
				'default'            => $this->options['slideshow_lazyload'],
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);
	}
}
