<?php
/**
 * Archive Template.
 *
 * @package CodexShaper_Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<main id="content" class="site-main">
	<?php do_action( 'cxf_template_builder_archive_content' ); ?>
</main>

<?php
get_footer();
