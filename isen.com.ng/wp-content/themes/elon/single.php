<?php
// =============================================================================
// SINGLE.PHP
// -----------------------------------------------------------------------------
// Template file for single blog posts.
// =============================================================================

if (defined("HC_PLUGIN_PATH")) {
    include_once(HC_PLUGIN_PATH . "/global-content.php");
}
get_header();
wptf_the_content();
get_footer();
?>
