<?php
/**
 * Testimonial_Seven Widget View file
 *
 * @category   Widget
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
?>

<section class="cdx-testimonial-area-7">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12">
            <div <?php $parent->print_render_attribute_string('slider-wrapper') ?>>
                <div class="swiper-wrapper">
                    <?php if (! empty($settings['items'])) :
                        foreach ($settings['items'] as $item) : ?>
                            <div class="swiper-slide cdx-testimonial-item-7">
                                <div class="cdx-review d-flex">
                                    <?php for ($i = 0; $i < $item['rating_count_testimonial']; $i++) { ?>
                                        <span class="cdx-icon">
                                            <?php echo wp_kses($star_icon, cxf_get_svg_rules()); ?>
                                        </span>
                                    <?php } ?>
                                </div>
                                <?php
                                if ($item['testimonial_title']) :
                                ?>
                                    <h2 class="cdx-title"><?php echo esc_html($item['testimonial_title']); ?></h2>
                                <?php
                                endif;
                                ?>
                                <?php if (! empty($item['testimonial_description'])) : ?>
                                    <p class="cdx-content"><?php echo esc_html($item['testimonial_description']); ?></p>
                                <?php endif; ?>
                                <div class="cdx-client-info">
                                    <?php if ($item['testimonial_name']) : ?>
                                        <h3 class="cdx-name"><?php echo esc_html($item['testimonial_name']); ?></h3>
                                    <?php endif; ?>
                                    <?php if ($item['testimonial_designation']) : ?>
                                        <h4 class="cdx-designation"><?php echo esc_html($item['testimonial_designation']); ?></h4>
                                    <?php endif; ?>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <?php if ('yes' === $settings['button_control']) : ?>
                <div class="cdx-navigation-style-9">
                    <div class="cdx-testimonial-prev-7 cdx-btn-navigation cxf--arrow-prev">
                        <span class="cdx-icon">
                            <?php echo wp_kses($previous_btn_icon, cxf_get_svg_rules()); ?>
                        </span>
                    </div>
                    <div class="cdx-testimonial-next-7 cdx-btn-navigation cxf--arrow-next">
                        <span class="cdx-icon">
                            <?php echo wp_kses($next_btn_icon, cxf_get_svg_rules()); ?>
                        </span>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 col-md-12">
            <div <?php $parent->print_render_attribute_string('thumb-slider-wrapper') ?>>
                <div class="swiper-wrapper">
                    <?php
                    if (! empty($settings['items'])) :
                        foreach ($settings['items'] as $key => $item) :
                    ?>
                            <div class="swiper-slide cdx-testimonial-thumb-7">
                                <?php if (! empty($item['testimonial_author_image']['url'])) : ?>
                                    <?php echo wp_kses_post( $author_size_image[$key] ); ?>
                                <?php endif; ?>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>