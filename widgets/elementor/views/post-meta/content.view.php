<?php
/**
 * Post-meta Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<li <?php echo $meta_list_attr; ?>>
	<?php if ($separator && 'html' === $separator_display_on && 'before' === $separator_location) : ?>
		<span><?php echo $separator; ?></span>
	<?php endif ?>
	<?php if ($show_link) : ?>
		<a <?php echo $meta_link; ?>>
		<?php endif; ?>
		<?php echo $render_meta_icon_or_image; ?>
		<?php echo $render_meta_title; ?>
		<?php if ($show_link) : ?>
		</a>
	<?php endif; ?>
	<?php if ($separator && 'html' === $separator_display_on && 'after' === $separator_location) : ?>
		<span class="cxf-custom-text-separator"><?php echo $separator; ?></span>
	<?php endif ?>
</li>