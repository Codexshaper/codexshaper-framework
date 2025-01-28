<?php
/**
 * Video_Popoup_button Widget View file
 *
 * @category   Widget
 * @package    CodexShaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<a aria-label="Video Popup Button" class="popup-video video-popup-btn palse-anim-wrap style-white position-relative" href="<?php echo esc_url( $settings['video-url']['url'] ) ?? '#'; ?>">
	<?php echo wp_kses( $play_btn_icon, cxf_get_svg_rules() ); ?>
	<?php if ( 'yes' === $settings['animation_control'] ) : ?>
		<span class="palse-anim"></span>
		<span class="palse-anim"></span>
		<span class="palse-anim"></span>
	<?php endif; ?>
</a>
