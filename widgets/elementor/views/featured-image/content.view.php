<?php
/**
 * Featured Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div class="cxf-featured-image-wrapper">
            <?php if(get_post_thumbnail_id( $post_id )): ?>
			<?php echo get_the_post_thumbnail( $post_id, $image_size, array('loading' => 'lazy') ); ?>
            <?php elseif($fallback_size_image):?>
                <?php echo $fallback_size_image; ?>
            <?php endif;?>
        </div>