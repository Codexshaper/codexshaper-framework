<?php
/**
 * Post-meta Widget icon-image View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<span class="cxf--meta-icon">
	<?php if ($show_image && ! $show_icon) : ?>
		<img <?php echo $avater_image; ?>>
	<?php endif; ?>
	<?php if ($show_icon && ! $show_image) : ?>
		<?php echo $render_meta_icon; ?>
	<?php endif; ?>
</span>