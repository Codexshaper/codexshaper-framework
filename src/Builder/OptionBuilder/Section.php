<?php
/**
 * Section Builder
 *
 * @category   Builder
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

namespace CodexShaper\Framework\Builder\OptionBuilder;

/**
 * Section Option class
 *
 * @category   Class
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
class Section {

	/**
	 * Field Create
	 *
	 * Create Field option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id Option identifier.
	 * @param array  $options Option arguments.
	 *
	 * @return void
	 */
	public static function render( $section, $post_id, $identifier, $options ) {

		/**
		 * Filter section allowed html
		 *
		 * @since 1.0.0
		 *
		 * @param array $allowed_html Allowed html.
		 */
		$allowed_html = apply_filters(
			'cxf/builder/section/allowed_html', 
			array(
				'p' => array(
					'class' => array()
				), 
				'a' => array(
					'href' => array(), 
					'target' => array()
				), 
				'mark' => array()
			)
		);

		cxf_view(
			'builder.fields.section', 
			compact(
				'section',
				'allowed_html', 
				'options', 
				'post_id', 
				'identifier'
			)
		);
	}
}
