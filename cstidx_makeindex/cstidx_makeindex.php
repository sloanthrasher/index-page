<?php
/*
 * Contributors: sloanthrasher
 * Plugin Name: cstidx_makeindex
 * Text Domain: cstidx_makeindex
 * Plugin URI: https://sloansweb.com/page-6/
 * Tags: table of contents, idx, index, page index, headings  
 * Requires at least: 5.0
 * Tested up to: 6.6
 * Requires PHP: 7.2  
 * Stable tag: 1.0  
 * Donate link: https://sloansweb.com/say-thanks/
 * Author: Sloan Thrasher
 * Author URI: https://sloansweb.com/about/
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Description: A plugin to generate a dynamic, hierarchical index of pages (IDX) based on page headings using a customizable shortcode.
 */

// Hook to add the settings page under the "Settings" menu
function cstidx_admin_menu()
{
	add_options_page(
		esc_html__('Create An Index For A Page', 'cstidx_makeindex'), // Page title
		esc_html__('Index A Page', 'cstidx_makeindex'),               // Menu title
		'manage_options',                                             // Capability required
		'cstidx_settings',                                            // Menu slug
		'cstidx_settings_page'                                        // Function to display the page content
	);
}
add_action('admin_menu', 'cstidx_admin_menu');

// Function to display the settings page content
function cstidx_settings_page()
{
	?>
	<div class="wrap">
		<h1><?php esc_html_e('Index Settings', 'cstidx_makeindex'); ?></h1>
		<form method="post" action="options.php">
			<?php
			// Output security fields for the registered setting
			settings_fields('cstidx_settings_group');
			// Output setting sections and their fields
			do_settings_sections('cstidx_settings');
			// Output save settings button
			submit_button();
			?>
		</form>
	</div>
	<?php
}

// Register settings, sections, and fields
function cstidx_register_settings()
{
	// Register each setting with WordPress
	register_setting('cstidx_settings_group', 'cstidx_title');
	register_setting('cstidx_settings_group', 'cstidx_selectors');
	register_setting('cstidx_settings_group', 'cstidx_options'); // Store style and custom CSS in an array

	// Add a new section to the settings page
	add_settings_section(
		'cstidx_settings_section',                           // ID
		esc_html__('Page Index Settings', 'cstidx_makeindex'),       // Title
		'cstidx_settings_section_callback',                  // Callback
		'cstidx_settings'                                    // Page
	);

	// Add fields to the settings section
	add_settings_field(
		'cstidx_title',
		esc_html__('Index Title', 'cstidx_makeindex'),
		'cstidx_title_callback',
		'cstidx_settings',
		'cstidx_settings_section'
	);

	add_settings_field(
		'cstidx_selectors',
		esc_html__('Default Selectors', 'cstidx_makeindex'),
		'cstidx_selectors_callback',
		'cstidx_settings',
		'cstidx_settings_section'
	);

	add_settings_field(
		'cstidx_style',
		esc_html__('Style', 'cstidx_makeindex'),
		'cstidx_style_callback',
		'cstidx_settings',
		'cstidx_settings_section'
	);

	add_settings_field(
		'cstidx_custom_css',
		esc_html__('Custom CSS', 'cstidx_makeindex'),
		'cstidx_custom_css_callback',
		'cstidx_settings',
		'cstidx_settings_section'
	);
}
add_action('admin_init', 'cstidx_register_settings');

// Callback function to display section description
function cstidx_settings_section_callback()
{
	echo '<p>' . esc_html__('Configure the default settings for generating a page index. These will be overridden by the settings in the Page Index plugin.', 'cstidx_makeindex') . '</p>';
}

// Callback functions to render input fields
function cstidx_title_callback()
{
	$title = get_option('cstidx_title', '');
	echo '<input type="text" name="cstidx_title" value="' . esc_attr($title) . '" class="regular-text" />';
	echo '<p class="description">' . esc_html__('The title to display for the index.', 'cstidx_makeindex') . '</p>';
}

function cstidx_selectors_callback()
{
	$selectors = get_option('cstidx_selectors', '');
	echo '<input type="text" name="cstidx_selectors" value="' . esc_attr($selectors) . '" class="regular-text" />';
	echo '<p class="description">' . esc_html__('Comma-separated list of selectors (e.g., h2,h3,h4).', 'cstidx_makeindex') . '</p>';
}

function cstidx_style_callback()
{
	$options = get_option('cstidx_options', array());
	$style = isset($options['cstidx_style']) ? $options['cstidx_style'] : 'css/cstidx_on_right.css';
	?>
	<select name="cstidx_options[cstidx_style]" id="cstidx_style_select">
		<option value="css/cstidx_on_left.css" <?php selected($style, 'css/cstidx_on_left.css'); ?>>
			<?php echo esc_html__('On Left', 'cstidx_makeindex'); ?>
		</option>
		<option value="css/cstidx_on_right.css" <?php selected($style, 'css/cstidx_on_right.css'); ?>>
			<?php echo esc_html__('On Right', 'cstidx_makeindex'); ?>
		</option>
		<option value="css/cstidx_top_left.css" <?php selected($style, 'css/cstidx_top_left.css'); ?>>
			<?php echo esc_html__('Fixed at Top Left', 'cstidx_makeindex'); ?>
		</option>
		<option value="css/cstidx_top_right.css" <?php selected($style, 'css/cstidx_top_right.css'); ?>>
			<?php echo esc_html__('Fixed at Top Right', 'cstidx_makeindex'); ?>
		</option>
		<option value="custom" <?php selected($style, 'custom'); ?>>
			<?php echo esc_html__('Custom', 'cstidx_makeindex'); ?>
		</option>
		<option value="css/cstidx_bottom_left.css" <?php selected($style, 'css/cstidx_bottom_left.css'); ?>>
			<?php echo esc_html__('Fixed at Bottom Left', 'cstidx_makeindex'); ?>
		</option>
		<option value="css/cstidx_bottom_right.css" <?php selected($style, 'css/cstidx_bottom_right.css'); ?>>
			<?php echo esc_html__('Fixed at Bottom Right', 'cstidx_makeindex'); ?>
		</option>
	</select>
	<?php
}

function cstidx_custom_css_callback()
{
	$options = get_option('cstidx_options', array());
	$custom_css = isset($options['cstidx_custom_css']) ? $options['cstidx_custom_css'] : '';
	echo '<textarea name="cstidx_options[cstidx_custom_css]" class="regular-text" rows="5">' . esc_textarea($custom_css) . '</textarea>';
	echo '<p class="description">' . esc_html__('Your own CSS to style the page index. Used only if the Style above is Custom.', 'cstidx_makeindex') . '</p>';
}


// Enqueue the JavaScript and CSS files
function cstidx_enqueue_scripts()
{
	$plugin_url = plugin_dir_url(__FILE__) . '/';

	// Enqueue JavaScript file
	wp_enqueue_script(
		'cstidx_scripts',
		$plugin_url . 'js/cstidx_idx_script.js',
		array('jquery'),
		'1.0',
		true
	);

}
add_action('admin_enqueue_scripts', 'cstidx_enqueue_scripts');




/**
 * Generates a shortcode for displaying an index of headings on a page.
 *
 * @param array $atts An array of shortcode attributes.
 *                    - title: The title of the index (default: 'In This Article').
 *                    - selectors: The CSS selectors for the headings to include in the index (default: 'h2, h3, h4').
 * @return string The HTML for the index shortcode.
 */

// Shortcode handler function to generate the index
function cstidx_index_shortcode($atts = [])
{
	// Ensure that CSS and JS are loaded
	cstidx_enqueue_scripts();

	$plugin_url = plugin_dir_url(__FILE__) . '/';

	// Retrieve the options saved in the settings
	$default_title = get_option('cstidx_title', esc_html__('In This Article', 'cstidx_makeindex'));
	$default_selectors = get_option('cstidx_selectors', 'h2, h3, h4');

	$options = get_option('cstidx_options', array());
	$default_style = isset($options['cstidx_style']) ? $options['cstidx_style'] : 'css/cstidx_on_right.css';

	$custom_css = get_option('cstidx_custom_css', '');

	// Shortcode attributes
	$title = isset($atts['title']) && !empty($atts['title']) ? $atts['title'] : $default_title;
	$selectors = isset($atts['selectors']) && !empty($atts['selectors']) ? $atts['selectors'] : $default_selectors;
	$style = isset($atts['style']) && !empty($atts['style']) ? $atts['style'] : $default_style;

	// Enqueue the selected style or custom CSS
	//	Set the current plugin version
	$ver = '1.0';

	/* Enqueue the variables for the styles */
	wp_enqueue_style('cstidx-style_vars', $plugin_url . 'css/vars.css', array(), $ver);
	wp_enqueue_style('cstidx-style_common', $plugin_url . 'css/cstidx_common.css', array(), $ver);

	if (!empty($custom_css) && $style == 'on_left') {
		$style = 'css/cstidx_on_left.css';
	} else if (!empty($custom_css) && $style == 'on_right') {
		$style = 'css/cstidx_on_right.css';
	} else if (!empty($custom_css) && $style == 'bottom_right') {
		$style = 'css/cstidx_bottom_right.css';
	} else if (!empty($custom_css) && $style == 'bottom_left') {
		$style = 'css/cstidx_bottom_left.css';
	} else if (!empty($custom_css) && $style == 'top_right') {
		$style = 'css/cstidx_top_right.css';
	} else if (!empty($custom_css) && $style == 'bottom_left') {
		$style = 'css/cstidx_bottom_left.css';
	} else if (!empty($custom_css) && $style == 'custom') {
		wp_add_inline_style('cstidx-style', $custom_css);
	} else {
		$style = 'css/cstidx_on_right.css';
	}
	if ($style !== 'custom') {
		wp_enqueue_style('cstidx-style', $plugin_url . $style, array(), $ver);
	}

	// Output the HTML structure for the index
	ob_start();
	?>
	<div id="cstidx_pg_idx_list" class="cstidx_pg_idx_list">
		<div class="cstidx-idx-heading"><i class="fa fa-spinner fa-spin" style="color:#f00;"></i></div>
		<div class="cstidx-idx-container"></div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			cstidx_generateIdx('<?php echo esc_js($selectors); ?>');
			jQuery('.cstidx-idx-heading').html('<?php echo esc_html($title); ?>');
		});
	</script>
	<?php
	return ob_get_clean();
}
add_shortcode('cstidx_index', 'cstidx_index_shortcode');
