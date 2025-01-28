<?php
/**
 * Progress-bar Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div class="progress-wrapper">
	<span class="progress-title"> <?php echo esc_html( $settings['progress_title'] ); ?></span>
	<span class="progress-percentage"> <?php echo esc_html( $settings['progress_percentage'] ); ?>%</span>
</div>
<div class="progress-container">
	<div class="<?php echo esc_attr( $class ); ?>" style="width: <?php echo esc_html( $settings['progress_percentage'] ); ?>%;"></div>
</div>
