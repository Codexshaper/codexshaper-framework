<?php
/**
 * Pricing Table Widget Content View file.
 *
 * @package    CodexShaper_Framework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */

?>
<div class="single-pricing">
	<div>
		<p class="pricing-plan-duration">
			<span class="<?php echo esc_attr( $class_monthly ); ?>">Monthly </span>/
			<span class="<?php echo esc_attr( $class_yearly ); ?>">Yearly</span>
		</p>
		<h3 class="pricing-plan"><?php echo esc_html( $settings['plan_type'] ); ?></h3>
	</div>
	<ul>
		<?php foreach ( $settings['features'] as $feature ) : ?>
			<li class='pricing-plan-item'>
				<?php echo wp_kses( $price_features, \cxf_get_svg_rules() ) . esc_html( $feature['title'] ); ?>
			</li>
		<?php endforeach; ?>
	</ul>
	<div>
		<h3 class="plan-price">
			<?php echo esc_html( $settings['curency_sign'] ) . esc_html( $settings['price'] ); ?>/
			<span class="text-base"><?php echo esc_html( $settings['duration'] ); ?></span>
		</h3>
	</div>
	<div>
		<a href="<?php echo esc_attr( $settings['btn_link']['url'] ); ?>" class="rory-btn-primary" aria-label="Pricing button">
			<?php
			if ( $btn_icon ) :
				?>
				<i class="btn-icon"><?php echo wp_kses( $btn_icon, \cxf_get_svg_rules() ); ?> <?php endif; ?> </i> <?php echo esc_html( $settings['btn_title'] ); ?>

		</a>
	</div>
</div>
