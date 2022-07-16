<?php
/**
 * Header and Footer Injection
 */

/**
 * Customizer Builder Header Output
 */
function rishi__cb_header_output() {

	if (
		function_exists('rishi__cb_get_content_block_that_matches')
		&&
		rishi__cb_get_content_block_that_matches([
			'template_type' => 'header'
		])
	) {
		echo rishi__cb_html_tag(
			'header',
			array_merge(
				[
					'id' => 'header',
				],
				rishi__cb_customizer_schema_org_definitions('header', ['array' => true])
			),
			rishi__cb_render_content_block(
				rishi__cb_get_content_block_that_matches([
					'template_type' => 'header'
				])
			)
		);

		return '';
	}

	echo rishi__cb_customizer_manager()->header_builder->render();
}
add_action( 'rishi__cb_header_output', 'rishi__cb_header_output', 20 );

/**
 * Customizer Builder Footer Output
 */
function rishi__cb_footer_output() {

	if (
		function_exists('rishi__cb_get_content_block_that_matches')
		&&
		rishi__cb_get_content_block_that_matches([
			'template_type' => 'footer'
		])
	) {
		echo rishi__cb_html_tag(
			'footer',
			rishi__cb_customizer_schema_org_definitions('footer', [
				'array' => true
			]),
			rishi__cb_render_content_block(
				rishi__cb_get_content_block_that_matches([
					'template_type' => 'footer'
				])
			)
		);

		return '';
	}

	echo rishi__cb_customizer_manager()->footer_builder->render();
}
add_action( 'rishi__cb_footer_output', 'rishi__cb_footer_output', 20 );
