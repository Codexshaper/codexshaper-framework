<?php
/**
 * Taxonomy Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div class="cdx-widget cdx-widget-category">
	<?php if ($title_html && $title) : ?>
		<?php echo wp_kses_post( $title_html ); ?>
	<?php endif; ?>
	<?php if (! empty($limited_terms)) : ?>
		<ul class="cdx-categories-wrap">
			<?php foreach ($limited_terms as $term) : ?>
				<li class="cdx-category-list">
					<a class="cdx-category-link" href="<?php echo esc_url( get_term_link($term) ); ?>" aria-label="Post taxonomy link">
						<span class="cxf--title"><?php echo esc_html( $term->name ); ?></span>
						<?php if ('yes' == $post_counter) : ?>
							<span class="cxf--post-counter"><?php echo esc_html( $settings['post_counter_prefix'] ); ?><?php echo esc_html( $term->count ); ?> <?php echo esc_html( $settings['post_counter_postfix'] ); ?></span>
						<?php endif; ?>
						<?php echo wp_kses( $taxonomy_icon, cxf_get_svg_rules() ); ?>
					</a>
				</li>
			<?php endforeach ?>
		</ul>
	<?php endif; ?>
</div>