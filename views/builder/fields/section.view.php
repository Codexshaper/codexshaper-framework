<?php
/**
 * Section View
 *
 * @category   View
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 * @version    1.0.0
 */

use CodexShaper\Framework\Builder\OptionBuilder\Field;

$section_class       = $section['class'] ?? '';
$section_class      .= ' cxf--builder-init';
$section_title       = $section['title'] ?? '';
$section_icon        = $section['icon'] ?? '';
$section_description = $section['description'] ?? '';
$is_error            = false;
?>

<div class="cxf--section <?php echo esc_attr( $section_class ); ?>">
	<!-- Title -->
	<?php if ( $section_title || $section_icon ) : ?>
		<div class="cxf--section-title">
			<h3>
				<?php if ( $section_icon ) : ?>
					<i class="cxf--section-icon <?php echo esc_attr( $section_icon ); ?>"></i>
				<?php endif; ?>
				<?php echo wp_kses( $section_title, $allowed_html ); ?>
			</h3>
		</div>
	<?php endif; ?>
	<!-- Description -->
	<?php if ( $section_description ) : ?>
		<div class="cxf--field cxf--section-description"><?php echo wp_kses( $section_description, $allowed_html ); ?></div>
	<?php endif; ?>
	<!-- Fields -->
	<?php

		$fields   = $section['fields'] ?? array();
		$is_error = ! is_array( $fields ) || empty( $fields );

	if ( ! $is_error ) {
		foreach ( $fields as $field ) {
			$value = Field::get_value( $post_id, $field, $identifier, $options );
			Field::render( $field, $value, $identifier, 'section' );
		}
	}
	?>
	<!-- No option found -->
	<?php if ( $is_error ) : ?>
		<div class="cxf--no-option"><?php esc_html__( 'No section data found.', 'codexshaper-framework' ); ?></div>
	<?php endif; ?>
</div>
