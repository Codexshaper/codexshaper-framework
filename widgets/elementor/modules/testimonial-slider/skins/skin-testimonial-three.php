<?php
/**
 * Testimonial_Three Widget file
 *
 * @category   Widget
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Widgets\Elementor\Modules\TestimonialSlider\Skins;

use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Skin_Testimonial_Three widget class
 *
 * @category   Class
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Skin_Testimonial_Three extends Skin_Testimonial_Base {

	/**
	 * Get skin ID.
	 *
	 * Retrieve the skin ID.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_id() {
		return 'skin-testimonial-three';
	}

	/**
	 * Get skin title.
	 *
	 * Retrieve the skin title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Testimonial Three', 'codexshaper-framework' );
	}

	/**
	 * Register skin controls actions.
	 *
	 * Run on init and used to register new skins to be injected to the widget.
	 * This method is used to register new actions that specify the location of
	 * the skin in the widget.
	 *
	 * Example usage:
	 * `add_action( 'elementor/element/{widget_id}/{section_id}/before_section_end', [ $this, 'register_controls' ] );`
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls_actions() {}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render() {

		$settings = $this->parent->get_settings_for_display();
		$parent   = $this->parent;
		$data     = array(
			'class' => 'cdx-testimonial-slider-3',
		);

		$this->parent->add_slider_attributes( $this->parent, $data );
		// Get star icon.
		$star_icon = ! empty( $settings['star_icon'] ) ? Icons_Manager::try_get_icon_html(
			$settings['star_icon'],
			array(
				'aria-hidden' => 'true',
				'fill'        => 'currentColor',
				'width'       => '16',
			)
		) : '';

		$is_lazy_load = 'yes' === $settings['lazy_load'];
		if ( ! empty( $settings['items'] ) ) {
			foreach ( $settings['items'] as $item ) {
				$image_size          = $item['author_image_size'] ?? 'full';
				$author_image        = $item['testimonial_author_image'] ?? null;
				$author_image_id     = $author_image['id'] ?? null;
				$author_size_image[] = $this->get_size_image(
					image_id: $author_image_id,
					size: $image_size,
					is_custom_lazy: $is_lazy_load,
					attributes: array(
						'alt'          => 'Image',
						'class'        => '',
						'fallback_url' => 0 < $author_image_id ? '' : $author_image['url'],
					)
				);
			}
		}

		$data = array(
			'parent'            => $parent,
			'settings'          => $settings,
			'star_icon'         => $star_icon,
			'author_size_image' => $author_size_image ?? null,
		);
		cxf_view( 'testimonial-slider.skins.testimonial-slider-three', $data );
	}
}
