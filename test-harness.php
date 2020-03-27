<?php
/**
 * Plugin Name: Test Harness
 * Plugin URI: https://stompgear.com/plugins/test-harness
 * Description: Test harness for running WP code
 * Author: Mike Hale
 * Author URI: https://mikehale.me/
 * Version: 1.0.0
 * Text Domain: test-harness
 * Domain Path: /languages
 *
 * License: GNU General Public License v2.0 (or later)
 * License URI: https://www.opensource.org/licenses/gpl-license.php
 *
 * @package Test_Harness
 */

add_action( 'admin_menu', 'test_harness_admin_menu' );

/**
 * Add Test Harness menu page.
 * Handles `admin_menu`
 *
 * @return void
 */
function test_harness_admin_menu() {

	$menu_icon = 'data:image/svg+xml;base64,' . base64_encode( '<svg height="100px" width="100px"  fill="#000000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 128 128" style="enable-background:new 0 0 128 128;" xml:space="preserve"><g><g><path d="M64,32.521c-17.057,0-30.934,14.122-30.934,31.479S46.943,95.479,64,95.479S94.934,81.358,94.934,64    S81.057,32.521,64,32.521z M79.666,54.355L59.748,74.786c-0.389,0.399-0.91,0.604-1.433,0.604c-0.421,0-0.844-0.132-1.202-0.402    l-8.978-6.758c-0.883-0.664-1.06-1.918-0.395-2.8c0.665-0.882,1.919-1.059,2.8-0.395l7.571,5.7l18.689-19.17    c0.772-0.792,2.038-0.806,2.828-0.036C80.42,52.298,80.437,53.564,79.666,54.355z"></path><path d="M119.585,51.864h-7.292c-1.366-5.479-3.63-10.643-6.746-15.388l4.671-4.641c1.287-1.279,1.996-2.98,1.996-4.791    c0-1.811-0.708-3.512-1.996-4.792l-5.93-5.892c-2.649-2.633-6.959-2.632-9.607,0l-4.813,4.783    c-4.956-3.092-10.352-5.284-16.083-6.531V8.769c0-3.732-3.05-6.769-6.8-6.769h-8.387c-3.75,0-6.8,3.037-6.8,6.769v5.842    c-5.961,1.298-11.561,3.622-16.688,6.925l-3.501-3.479c-2.648-2.632-6.958-2.632-9.607,0l-5.93,5.892    c-1.287,1.279-1.996,2.98-1.996,4.791c0,1.811,0.708,3.512,1.996,4.792l3.565,3.542c-3.363,5.284-5.673,11.052-6.885,17.19H8.415    c-3.75,0-6.8,3.037-6.8,6.769v8.333c0,3.733,3.05,6.77,6.8,6.77h4.814c1.487,6.094,4.063,11.773,7.678,16.923l-3.125,3.106    c-1.287,1.279-1.996,2.98-1.996,4.791c0,1.811,0.708,3.512,1.996,4.792l5.93,5.892c2.65,2.633,6.959,2.633,9.607,0l3.765-3.741    c5.313,3.092,11.062,5.168,17.131,6.186v5.146c0,3.732,3.05,6.769,6.8,6.769h8.387c3.75,0,6.8-3.037,6.8-6.769v-6.202    c5.704-1.537,11.026-4.017,15.858-7.39l4.331,4.303c2.648,2.633,6.958,2.632,9.607,0l5.93-5.892    c1.287-1.279,1.996-2.98,1.996-4.791c0-1.811-0.708-3.512-1.996-4.792l-4.988-4.957c2.873-4.917,4.867-10.21,5.941-15.776h6.705    c3.75,0,6.8-3.037,6.8-6.769v-8.333C126.385,54.9,123.334,51.864,119.585,51.864z M64,99.479    c-19.263,0-34.934-15.916-34.934-35.479S44.737,28.521,64,28.521S98.934,44.437,98.934,64S83.263,99.479,64,99.479z"></path></g></g></svg>' );

	add_menu_page(
		__( 'Test Harness', 'test-harness' ),
		__( 'Test Harness', 'test-harness' ),
		'manage_options',
		'test-harness',
		'test_harness_admin_page',
		$menu_icon
	);
}

/**
 * Test Harness admin page.
 *
 * @return void
 */
function test_harness_admin_page() {

	$results = '';

	if ( isset( $_REQUEST['_test_harness_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['_test_harness_nonce'] ) ), 'do_test_harness' ) ) {
		$results = test_harness_do_test();
	}
	?>

	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form method="post" id="test_harness">
			<?php submit_button( __( 'Run', 'test-harness' ) ); ?>
			<?php wp_nonce_field( 'do_test_harness', '_test_harness_nonce' ); ?>
		</form>
		<div id="test_harness-results">
		<?php echo wp_kses_post( $results ); ?>
		</div>
	</div>
	<?php
}

/**
 * Does the code being tested.
 * Put whatever you want to run in this method.
 *
 * @return mixed
 */
function test_harness_do_test() {
	return true;
}
