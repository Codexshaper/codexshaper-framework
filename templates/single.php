<?php
/**
 * single Template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<main id="content" <?php post_class( 'site-main' ); ?>>
	<?php do_action( 'cxf_template_builder_single_content' ); ?>
</main>
<?php
get_footer();

