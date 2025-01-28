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
trait Fields {

	/**
	 * Fields
	 *
	 * @var array $fields Fields.
	 */
	protected static $fields;

	/**
	 * Get options
	 *
	 * @return array $options Options.
	 */
	protected $options = array(
		'slider_type'                => 'swiper',
		'thumb_slider'               => '',
		'slides_per_view'            => 'auto',
		'custom_slides_per_view'     => 1,
		'autoplay'                   => 'yes',
		'autoplay_delay'             => 3000,
		'autoplay_interaction'       => 'yes',
		'allow_touch_move'           => 'no',
		'loop'                       => 'yes',
		'mousewheel'                 => '',
		'speed'                      => 500,
		'space_between'              => 20,
		'effect'                     => 'slide',
		'navigation'                 => 'yes',
		'pagination'                 => 'yes',
		'pagination_type'            => 'bullets',
		'pagination_bullets_type'    => 'default',
		'direction'                  => 'horizontal',
		'thumb_direction'            => 'vertical',
		'horizontal_direction'       => 'ltr',
		'thumb_horizontal_direction' => 'ltr',
		'reverse_direction'          => '',
		'thumb_reverse_direction'    => '',
		'slideshow_lazyload'         => '',
		'loop_additional_slides'     => 'slides_per_view',
		'watch_slides_progress'      => '',
		'slide_to_clicked_slide'     => '',
		'centered_slides'            => '',
		'default_min_breakpoint'     => 1367,
	);

	/**
	 * Init fields
	 *
	 * @return array $fields Fields.
	 */
	protected function init_fields() {
		$args = $this->get_args();
		return $this->init_fields_by_name( $args['name'] );
	}

	/**
	 * Get fields by name
	 *
	 * @return array $fields Fields.
	 */
	protected function init_fields_by_name( $prefix = 'cxf' ) {
		/**
		 *  Get slider options.
		 *
		 * Fires when Slider widget is being initialized.
		 *
		 * @since 1.0.0
		 *
		 * @param array $options Slider options.
		 */
		$this->options = apply_filters( 'cxf/slider/options', $this->options );

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
		$slides_per_view = apply_filters( "cxf/slider/{$prefix}/slides_per_view", $slides_per_view );
		$fields          = array();

		$fields['slider_type']              = array(
			'label'              => esc_html__( 'Provider', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['slider_type'],
			'options'            => array(
				'default' => esc_html__( 'Deafult', 'codexshaper-framework' ),
				'swiper'  => esc_html__( 'Swiper', 'codexshaper-framework' ),
			),
			'frontend_available' => true,
		);
		$fields['slides_per_view']          = array(
			'label'              => esc_html__( 'Slides to Show', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'options'            => $slides_per_view,
			'default'            => $this->options['slides_per_view'],
			'responsive'         => true,
			'frontend_available' => true,
		);
		$fields['custom_slides_per_view']   = array(
			'label'              => esc_html__( 'Custom Slides to Show', 'codexshaper-framework' ),
			'type'               => Controls_Manager::TEXT,
			'description'        => esc_html__( 'Enter either string or integer number. E.g: Either auto,1,5, etc', 'codexshaper-framework' ),
			'default'            => $this->options['custom_slides_per_view'],
			'condition'          => array(
				'slides_per_view' => 'custom',
			),
			'responsive'         => true,
			'frontend_available' => true,
		);
		$fields['loop_heading']             = array(
			'label'     => esc_html__( 'Autoplay & Loop', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		);
		$fields['loop']                     = array(
			'label'              => esc_html__( 'Loop', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['loop'],
			'options'            => array(
				'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
				'no'  => esc_html__( 'No', 'codexshaper-framework' ),
			),
			'frontend_available' => true,
		);
		$fields['autoplay']                 = array(
			'label'              => esc_html__( 'Autoplay', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'description'        => esc_html__( 'Enter value as a miliseconds. E.g: Input 1000 use as 1000ms.', 'codexshaper-framework' ),
			'options'            => array(
				'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
				'no'  => esc_html__( 'No', 'codexshaper-framework' ),
			),
			'default'            => $this->options['autoplay'],
			'frontend_available' => true,
		);
		$fields['autoplay_delay']           = array(
			'label'              => esc_html__( 'Autoplay delay', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'description'        => esc_html__( 'Enter value as a miliseconds. E.g: Input 1000 use as 1000ms.', 'codexshaper-framework' ),
			'default'            => $this->options['autoplay_delay'],
			'condition'          => array(
				'autoplay' => 'yes',
			),
			'frontend_available' => true,
		);
		$fields['autoplay_interaction']     = array(
			'label'              => esc_html__( 'Autoplay Interaction', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['autoplay_interaction'],
			'options'            => array(
				'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
				'no'  => esc_html__( 'No', 'codexshaper-framework' ),
			),
			'condition'          => array(
				'autoplay' => 'yes',
			),
			'frontend_available' => true,
		);
		$fields['reverse_direction']        = array(
			'label'              => esc_html__( 'Reverse direction', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
			'default'            => $this->options['reverse_direction'],
			'return_value'       => 'yes',
			'frontend_available' => true,
		);
		$fields['allow_touch_move']         = array(
			'label'              => esc_html__( 'Allow Touch Move', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'separator'          => 'before',
			'default'            => $this->options['allow_touch_move'],
			'options'            => array(
				'yes' => esc_html__( 'Yes', 'codexshaper-framework' ),
				'no'  => esc_html__( 'No', 'codexshaper-framework' ),
			),
			'frontend_available' => true,
		);
		$fields['mousewheel']               = array(
			'label'              => esc_html__( 'Mousewheel', 'codexshaper-framework' ),
			'description'        => esc_html__( 'If you want to use mousewheel, please disable loop.', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
			'return_value'       => 'yes',
			'default'            => $this->options['mousewheel'],
			'frontend_available' => true,
		);
		$fields['speed']                    = array(
			'label'              => esc_html__( 'Animation Speed', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => $this->options['speed'],
			'frontend_available' => true,
		);
		$fields['space_between']            = array(
			'label'              => esc_html__( 'Space Between', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => $this->options['space_between'],
			'frontend_available' => true,
		);
		$fields['effect']                   = array(
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
		);
		$fields['slide_shadows']            = array(
			'label'              => esc_html__( 'Slide Shadows', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
			'default'            => 'yes',
			'return_value'       => 'yes',
			'condition'          => array(
				'effect' => array(
					'coverflow',
					'flip',
					'cube',
					'cards',
				),
			),
			'frontend_available' => true,
		);
		$fields['cross_fade']               = array(
			'label'              => esc_html__( 'Navigation', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
			'default'            => $this->options['navigation'],
			'return_value'       => 'yes',
			'condition'          => array(
				'effect' => 'fade',
			),
			'frontend_available' => true,
		);
		$fields['effect_coverflow_heading'] = array(
			'label'     => esc_html__( 'Coverflow Effect', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
			'condition' => array(
				'effect' => 'coverflow',
			),
		);
		$fields['coverflow_depth']          = array(
			'label'              => esc_html__( 'Depth', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 100,
			'condition'          => array(
				'effect' => 'coverflow',
			),
			'frontend_available' => true,
		);
		$fields['coverflow_modifier']       = array(
			'label'              => esc_html__( 'Modifier', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 1,
			'condition'          => array(
				'effect' => 'coverflow',
			),
			'frontend_available' => true,
		);
		$fields['coverflow_rotate']         = array(
			'label'              => esc_html__( 'Rotate', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 50,
			'condition'          => array(
				'effect' => 'coverflow',
			),
			'frontend_available' => true,
		);
		$fields['coverflow_scale']          = array(
			'label'              => esc_html__( 'Scale', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 1,
			'condition'          => array(
				'effect' => 'coverflow',
			),
			'frontend_available' => true,
		);
		$fields['coverflow_stretch']        = array(
			'label'              => esc_html__( 'Stretch', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 0,
			'condition'          => array(
				'effect' => 'coverflow',
			),
			'frontend_available' => true,
		);
		$fields['effect_flip_heading']      = array(
			'label'     => esc_html__( 'Flip Effect', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
			'condition' => array(
				'effect' => 'flip',
			),
		);
		$fields['flip_limit_rotation']      = array(
			'label'              => esc_html__( 'Limit Rotation', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
			'default'            => 'yes',
			'return_value'       => 'yes',
			'condition'          => array(
				'effect' => 'flip',
			),
			'frontend_available' => true,
		);
		$fields['effect_cube_heading']      = array(
			'label'     => esc_html__( 'Cube Effect', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
			'condition' => array(
				'effect' => 'cube',
			),
		);
		$fields['cube_shadow']              = array(
			'label'              => esc_html__( 'Shadow', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
			'default'            => 'yes',
			'return_value'       => 'yes',
			'condition'          => array(
				'effect' => 'cube',
			),
			'frontend_available' => true,
		);
		$fields['cube_shadow_offset']       = array(
			'label'              => esc_html__( 'Shadow Offset', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 20,
			'condition'          => array(
				'effect' => 'cube',
			),
			'frontend_available' => true,
		);
		$fields['cube_shadow_scale']        = array(
			'label'              => esc_html__( 'Shadow Scale', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 0.94,
			'step'               => 0.01,
			'condition'          => array(
				'effect' => 'cube',
			),
			'frontend_available' => true,
		);
		$fields['effect_cards_heading']     = array(
			'label'     => esc_html__( 'Cards Effect', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
			'condition' => array(
				'effect' => 'cards',
			),
		);
		$fields['cards_rotate']             = array(
			'label'              => esc_html__( 'Rotate', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Show', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'Hide', 'codexshaper-framework' ),
			'default'            => 'yes',
			'return_value'       => 'yes',
			'condition'          => array(
				'effect' => 'cards',
			),
			'frontend_available' => true,
		);
		$fields['cards_per_slide_offsett']  = array(
			'label'              => esc_html__( 'Per Slide Offset', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 8,
			'condition'          => array(
				'effect' => 'cards',
			),
			'frontend_available' => true,
		);
		$fields['cards_per_slide_rotate']   = array(
			'label'              => esc_html__( 'Per Slide Rotate', 'codexshaper-framework' ),
			'type'               => Controls_Manager::NUMBER,
			'default'            => 2,
			'condition'          => array(
				'effect' => 'cards',
			),
			'frontend_available' => true,
		);
		$fields['navigation_heading']       = array(
			'label'     => esc_html__( 'Navigation', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		);
		$fields['navigation']               = array(
			'label'              => esc_html__( 'Navigation', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['navigation'],
			'options'            => array(
				'yes' => 'Yes',
				'no'  => 'No',
			),
			'responsive'         => true,
			'frontend_available' => true,
		);
		$fields['navigation_previous_icon'] = array(
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
				'navigation' => 'yes',
			),
			'responsive'         => true,
			'frontend_available' => true,
		);
		$fields['navigation_next_icon']     = array(
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
				'navigation' => 'yes',
			),
			'responsive'         => true,
			'frontend_available' => true,
		);
		$fields['pagination_heading']       = array(
			'label'     => esc_html__( 'Pagination', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		);
		$fields['pagination']               = array(
			'label'              => esc_html__( 'Pagination', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['pagination'],
			'options'            => array(
				'yes' => 'Yes',
				'no'  => 'No',
			),
			'responsive'         => true,
			'frontend_available' => true,

		);
		$fields['pagination_type']         = array(
			'label'              => esc_html__( 'Pagination Type', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['pagination_type'],
			'options'            => array(
				'bullets'     => esc_html__( 'Bullets', 'codexshaper-framework' ),
				'fraction'    => esc_html__( 'Fraction', 'codexshaper-framework' ),
				'progressbar' => esc_html__( 'Progressbar', 'codexshaper-framework' ),
			),
			'condition'          => array(
				'pagination' => 'yes',
			),
			'responsive'         => true,
			'frontend_available' => true,
		);
		$fields['pagination_bullets_type'] = array(
			'label'              => esc_html__( 'Pagination Type', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['pagination_bullets_type'],
			'options'            => array(
				'default' => esc_html__( 'Deafult', 'codexshaper-framework' ),
				'number'  => esc_html__( 'Number', 'codexshaper-framework' ),
			),
			'condition'          => array(
				'pagination'      => 'yes',
				'pagination_type' => 'bullets',
			),
			'responsive'         => true,
			'frontend_available' => true,
		);

		$fields['slider_advanced_heading'] = array(
			'label'     => esc_html__( 'Advanced', 'codexshaper-framework' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		);
		// $fields["default_min_breakpoint"] = array(
		// 'label'     => esc_html__( 'Desktop Min Screen Size', 'codexshaper-framework' ),
		// 'type'      => Controls_Manager::NUMBER,
		// 'default'   => $this->options['default_min_breakpoint'],
		// 'frontend_available' => true,
		// );
		$fields['direction']                     = array(
			'label'              => esc_html__( 'Slide Direction', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['direction'],
			'options'            => array(
				'horizontal' => esc_html__( 'Horizontal', 'codexshaper-framework' ),
				'vertical'   => esc_html__( 'Vertical', 'codexshaper-framework' ),
			),
			'frontend_available' => true,
		);
		$fields['dir']                           = array(
			'label'              => esc_html__( 'Horizontal Direction', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['horizontal_direction'],
			'options'            => array(
				'ltr' => esc_html__( 'Left', 'codexshaper-framework' ),
				'rtl' => esc_html__( 'Right', 'codexshaper-framework' ),
			),
			'condition'          => array(
				'direction' => 'horizontal',
			),
			'frontend_available' => true,
		);
		$fields['loop_additional_slides']        = array(
			'label'              => esc_html__( 'Loop Additional Slides', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SELECT,
			'default'            => $this->options['loop_additional_slides'],
			'options'            => array(
				'slides_per_view' => esc_html__( 'Same as slides per view', 'codexshaper-framework' ),
				'custom'          => esc_html__( 'Custom', 'codexshaper-framework' ),
			),
			'frontend_available' => true,
		);
		$fields['custom_loop_additional_slides'] = array(
			'label'              => esc_html__( 'Custom Loop Additional Slides', 'codexshaper-framework' ),
			'type'               => Controls_Manager::TEXT,
			'description'        => esc_html__( 'Enter either string or integer number. E.g: Either auto,1,5, etc', 'codexshaper-framework' ),
			'default'            => $this->options['custom_slides_per_view'],
			'condition'          => array(
				'loop_additional_slides' => 'custom',
			),
			'frontend_available' => true,
		);
		$fields['watch_slides_progress']         = array(
			'label'              => esc_html__( 'Watch Slides Progress', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
			'default'            => $this->options['watch_slides_progress'],
			'return_value'       => 'yes',
			'frontend_available' => true,
		);
		$fields['slide_to_clicked_slide']        = array(
			'label'              => esc_html__( 'Slide To Clicked Slide', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
			'default'            => $this->options['slide_to_clicked_slide'],
			'return_value'       => 'yes',
			'frontend_available' => true,
		);
		$fields['centered_slides']               = array(
			'label'              => esc_html__( 'Centered Slides', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
			'default'            => $this->options['centered_slides'],
			'return_value'       => 'yes',
			'frontend_available' => true,
		);
		$fields['slideshow_lazyload']            = array(
			'label'              => esc_html__( 'Slide show lazyload?', 'codexshaper-framework' ),
			'type'               => Controls_Manager::SWITCHER,
			'label_on'           => esc_html__( 'Yes', 'codexshaper-framework' ),
			'label_off'          => esc_html__( 'No', 'codexshaper-framework' ),
			'default'            => $this->options['slideshow_lazyload'],
			'return_value'       => 'yes',
			'frontend_available' => true,
		);

		return $fields;
	}
}
