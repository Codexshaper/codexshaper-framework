<?php
/**
 * Repeater View
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

?>

<div class="cxf--repeater-item cxf--repeater-cloneable" data-depend-id="<?php echo esc_attr( $field['id'] ); ?>">
    <div class="cxf--repeater-action-wrapper">
        <div class="cxf--repeater-action-content">
            <i class="button cxf--a-btn cxf--a-btn-primary cxf--repeater-sort fas fa-arrows-alt"></i>
            <i class="button cxf--a-btn cxf--a-btn-primary cxf--repeater-clone far fa-clone"></i>
            <i class="button cxf--a-btn cxf--a-btn-danger cxf--repeater-remove fas fa-times"></i>
        </div>
    </div>
    <div class="cxf--repeater-content">
        <?php
        foreach ( $field['fields'] as $new_field ) {
            $new_field_default = $new_field['default'] ?? '';
            $new_field_unique  = $identifier ? "{$identifier}[{$field['id']}][0]" : "{$field['id']}[0]";
            Field::render( $new_field, $new_field_default, '___' . $new_field_unique, 'repeater' );
        }
        ?>
    </div>
</div>
<div class="cxf--repeater-wrapper" data-field-id="[<?php echo esc_attr( $field['id'] ); ?>]" data-max="<?php echo esc_attr( $options['max'] ); ?>" data-min="<?php echo esc_attr( $options['min'] ); ?>">
    <?php
    if ( is_array( $value ) && count( $value ) > 0 ) :
        $num = 0;
        foreach ( $value as $key => $value ) :
    ?>
    <div class="cxf--repeater-item">
        <div class="cxf--repeater-action-wrapper">
            <div class="cxf--repeater-action-content">
                <i class="button cxf--a-btn cxf--a-btn-primary cxf--repeater-sort fas fa-arrows-alt"></i>
                <i class="button cxf--a-btn cxf--a-btn-primary cxf--repeater-clone far fa-clone"></i>
                <i class="button cxf--a-btn cxf--a-btn-danger cxf--repeater-remove fas fa-times"></i>
            </div>
        </div>
        <div class="cxf--repeater-content">
            <?php
            foreach ( $field['fields'] as $new_field ) {
                $new_field_unique = $identifier ? "{$identifier}[{$field['id']}][{$num}]" : "{$field['id']}[{$num}]";
                $new_field_value  = isset( $new_field['id'] ) && isset( $value[ $key ][ $new_field['id'] ] ) ? $value[ $key ][ $new_field['id'] ] : '[0]';
                Field::render( $new_field, $new_field_value, $new_field_unique, 'repeater' );
            }
            ?>
        </div>
    </div>
    <?php
            ++$num;
        endforeach;
    endif;
    ?>

</div>
<div class="cxf--repeater-footer">
    <button type="button" class="button cxf--a-btn cxf--a-btn-primary cxf--repeater-add">
        <?php echo wp_kses( $options['button_title'], array( 'i' => array( 'class' => array() ) ) ); ?>
    </button>
</div>