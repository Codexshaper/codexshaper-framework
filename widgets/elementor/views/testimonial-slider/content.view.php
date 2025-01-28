<?php
/**
 * Testimonial Widget View file
 *
 * @category   Widget
 * @package    CodexshaperFramework
 * @author     CodexShaper <info@codexshaper.com>
 * @license    https://www.gnu.org/licenses/gpl-2.0.html
 * @link       https://github.com/codexshaper/codexshaper-framework
 * @since      1.0.0
 */
?>

<div class="cxf--slider-wrapper">

    <div class="cxf--main-slider">
        <div <?php $instance->print_render_attribute_string('slider-wrapper') ?>>
            <div class="swiper-wrapper">
                <?php
                if (! empty($settings['items'])) :
                    foreach ($settings['items'] as $key => $item) :
                ?>
                        <div class="swiper-slide">
                            <div class="cdx-testimonial-item-card">
                                <div class="cdx-rating">
                                    <?php for ($i = 0; $i < $item['rating_count_testimonial']; $i++) : ?>
                                        <?php echo wp_kses($star_icon, cxf_get_svg_rules()); ?>
                                    <?php endfor; ?>
                                </div>
                                <?php

                                if ($item['testimonial_title']) :
                                ?>
                                    <h2 class="cdx-title"><?php echo esc_html($item['testimonial_title']); ?></h2>
                                <?php
                                endif;
                                ?>
                                <?php if ($item['testimonial_description']) : ?>
                                    <p class="cdx-description"><?php echo esc_html($item['testimonial_description']); ?></p>
                                <?php endif; ?>
                                <?php if ($item['testimonial_author_image']['url'] || $item['testimonial_name'] || $item['testimonial_designation']) : ?>
                                    <div class="cdx-author">
                                        <?php if ($item['testimonial_author_image']['url']) : ?>
                                            <?php echo wp_kses_post( $author_size_image[$key] ); ?>
                                        <?php endif; ?>
                                        <div class="cdx-details">
                                            <?php if ($item['testimonial_name']) : ?>
                                                <h3 class="cdx-name"><?php echo esc_html($item['testimonial_name']); ?></h3>
                                            <?php endif; ?>
                                            <?php if ($item['testimonial_designation']) : ?>
                                                <p class="cdx-designation"><?php echo esc_html($item['testimonial_designation']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
            <?php if ( 'yes' === $settings['button_control'] ): ?>
                <div class="cdx-testimonial-slider-navigation cdx-primary-navigation-btn">
                    <div class="cdx-testimonial-banner-prev cdx-slider-nav-btn cxf--arrow-prev">
                        <?php echo wp_kses($previous_btn_icon, cxf_get_svg_rules()); ?>
                    </div>
                    <div class="cdx-testimonial-banner-next cdx-slider-nav-btn cxf--arrow-next">
                        <?php echo wp_kses($next_btn_icon, cxf_get_svg_rules()); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( 'yes' == $settings['show_pagination'] ) : ?>
                <div class="swiper-pagination cdx-pagination-bullet cdx-pagination-bullet-slider-2"></div>
            <?php endif; ?>
        </div>
    </div>
    <!--Thumb slider.-->
    <?php if ('yes' === $is_thumb_slider): ?>
        <div class="cxf--thumb-slider-wrapper">
            <div <?php $this->print_render_attribute_string('thumb-slider-wrapper') ?>>
                <div class="swiper-wrapper">
                    <?php
                    if (! empty($settings['items'])) :
                        foreach ($settings['items'] as $key => $item) :
                    ?>
                            <div class="swiper-slide">
                                <div class="cxf--slide-content"><?php echo esc_html($key + 1); ?></div>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>