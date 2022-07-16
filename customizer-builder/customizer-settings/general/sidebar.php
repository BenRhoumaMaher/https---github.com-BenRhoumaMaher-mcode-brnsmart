<?php

/**
 * Colors options
 *
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

// $options = [
// 	'sidebar_section_options' => [
// 		'type' => 'rt-options',
// 		'setting' => ['transport' => 'postMessage'],
// 		'inner-options' => [

// 		 rishi__cb_customizer_rand_md5() => [
// 				'title' => __('General', 'rishi'),
// 				'type' => 'tab',
// 				'options' => [

// 					'sidebar_type' => [
// 						'label' => false,
// 						'type' => 'rt-image-picker',
// 						'value' => 'type-1',
// 						'setting' => ['transport' => 'postMessage'],
// 						'choices' => [

// 							'type-1' => [
// 								'src' => rishi__cb_customizer_image_picker_url('sidebar-type-1.svg'),
// 								'title' => __('Type 1', 'rishi'),
// 							],

// 							'type-2' => [
// 								'src' => rishi__cb_customizer_image_picker_url('sidebar-type-2.svg'),
// 								'title' => __('Type 2', 'rishi'),
// 							],

// 							'type-3' => [
// 								'src' => rishi__cb_customizer_image_picker_url('sidebar-type-3.svg'),
// 								'title' => __('Type 3', 'rishi'),
// 							],


// 							'type-4' => [
// 								'src' => rishi__cb_customizer_image_picker_url('sidebar-type-4.svg'),
// 								'title' => __('Type 4', 'rishi'),
// 							],

// 						],
// 					],

// 					'sidebarWidth' => [
// 						'label' => __('Sidebar Width', 'rishi'),
// 						'type' => ,
// 						'value' => 27,
// 						'min' => 10,
// 						'max' => 70,
// 						'defaultUnit' => '%',
// 						'setting' => ['transport' => 'postMessage'],
// 					],

// 					'sidebarGap' => [
// 						'label' => __('Sidebar Gap', 'rishi'),
// 						'type' => 'rt-slider',
// 						'value' => '4%',
// 						'units' => rishi__cb_customizer_units_config([
// 							['unit' => '%', 'min' => 0, 'max' => 50],
// 							['unit' => 'px', 'min' => 0, 'max' => 600],
// 							['unit' => 'pt', 'min' => 0, 'max' => 500],
// 							['unit' => 'em', 'min' => 0, 'max' => 100],
// 							['unit' => 'rem', 'min' => 0, 'max' => 100],
// 							['unit' => 'vw', 'min' => 0, 'max' => 50],
// 							['unit' => 'vh', 'min' => 0, 'max' => 50],
// 						]),
// 						'setting' => ['transport' => 'postMessage'],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-divider',
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-condition',
// 						'condition' => ['sidebar_type' => 'type-2 | type-3 | type-4'],
// 						'options' => [

// 							'sidebarInnerSpacing' => [
// 								'label' => __('Container Inner Spacing', 'rishi'),
// 								'type' => 'rt-slider',
// 								'min' => 5,
// 								'max' => 80,
// 								'responsive' => true,
// 								'value' => [
// 									'mobile' => 35,
// 									'tablet' => 35,
// 									'desktop' => 35,
// 								],
// 								'setting' => ['transport' => 'postMessage'],
// 							],

// 						 rishi__cb_customizer_rand_md5() => [
// 								'type' => 'rt-divider',
// 							],

// 						],
// 					],

// 					'sidebarWidgetsSpacing' => [
// 						'label' => __('Widgets Vertical Spacing', 'rishi'),
// 						'type' => 'rt-slider',
// 						'min' => 0,
// 						'max' => 100,
// 						'responsive' => true,
// 						'value' => [
// 							'desktop' => 60,
// 							'tablet' => 40,
// 							'mobile' => 40,
// 						],
// 						'setting' => ['transport' => 'postMessage'],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-divider',
// 					],

// 					'widgets_title_wrapper' => [
// 						'label' => __('Widget Title Tag', 'rishi'),
// 						'type' => 'rt-select',
// 						'value' => 'h2',
// 						'view' => 'text',
// 						'design' => 'inline',
// 						'setting' => ['transport' => 'postMessage'],
// 						'choices' => rishi__cb_customizer_ordered_keys(
// 							[
// 								'h1' => 'H1',
// 								'h2' => 'H2',
// 								'h3' => 'H3',
// 								'h4' => 'H4',
// 								'h5' => 'H5',
// 								'h6' => 'H6',
// 								'span' => 'span',
// 							]
// 						),
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-condition',
// 						'condition' => ['sidebar_type' => 'type-2'],
// 						'options' => [

// 						 rishi__cb_customizer_rand_md5() => [
// 								'type' => 'rt-divider',
// 							],

// 							'separated_widgets' => [
// 								'label' => __('Separate Widgets', 'rishi'),
// 								'type' => 'rara-switch',
// 								'value' => 'no',
// 								'setting' => ['transport' => 'postMessage'],
// 							],

// 						],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-divider',
// 					],

// 					'has_sticky_sidebar' => [
// 						'label' => __('Sticky Sidebar', 'rishi'),
// 						'type' => 'rara-switch',
// 						'value' => 'no',
// 						'setting' => ['transport' => 'postMessage'],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-condition',
// 						'condition' => ['has_sticky_sidebar' => 'yes'],
// 						'options' => [

// 							'sidebarOffset' => [
// 								'label' => __('Top Offset', 'rishi'),
// 								'type' => 'rt-slider',
// 								'value' => 50,
// 								'min' => 0,
// 								'max' => 200,
// 								'defaultUnit' => 'px',
// 								'divider' => 'top',
// 								'setting' => ['transport' => 'postMessage'],
// 							],

// 						],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-divider',
// 					],

// 					'sidebar_visibility' => [
// 						'label' => __('Visibility', 'rishi'),
// 						'type' => 'rt-visibility',
// 						'design' => 'block',
// 						'setting' => ['transport' => 'postMessage'],

// 						'value' => [
// 							'desktop' => true,
// 							'tablet' => false,
// 							'mobile' => false,
// 						],

// 						'choices' => rishi__cb_customizer_ordered_keys([
// 							'desktop' => __('Desktop', 'rishi'),
// 							'tablet' => __('Tablet', 'rishi'),
// 							'mobile' => __('Mobile', 'rishi'),
// 						]),
// 					],

// 				],
// 			],

// 		 rishi__cb_customizer_rand_md5() => [
// 				'title' => __('Design', 'rishi'),
// 				'type' => 'tab',
// 				'options' => [

// 					'sidebarWidgetsTitleFont' => [
// 						'type' => 'rt-typography',
// 						'label' => __('Widgets Title Font', 'rishi'),
// 						'value' => rishi__cb_customizer_typography_default_values([
// 							'size' => '18px',
// 						]),
// 						'setting' => ['transport' => 'postMessage'],
// 					],

// 					'sidebarWidgetsTitleColor' => [
// 						'label' => __('Widgets Title Font Color', 'rishi'),
// 						'type'  => 'rt-color-picker',
// 						'design' => 'block:right',
// 						'responsive' => true,
// 						'setting' => ['transport' => 'postMessage'],

// 						'value' => [
// 							'default' => [
// 								'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
// 							],
// 						],

// 						'pickers' => [
// 							[
// 								'title' => __('Initial', 'rishi'),
// 								'id' => 'default',
// 								'inherit' => 'var(--headingColor)'
// 							],
// 						],
// 					],

// 					'sidebarWidgetsFont' => [
// 						'type' => 'rt-typography',
// 						'label' => __('Widgets Font', 'rishi'),
// 						'value' => rishi__cb_customizer_typography_default_values([
// 							// 'size' => '16px',
// 						]),
// 						'divider' => 'top',
// 						'setting' => ['transport' => 'postMessage'],
// 					],

// 					'sidebarWidgetsFontColor' => [
// 						'label' => __('Widgets Font Color', 'rishi'),
// 						'type'  => 'rt-color-picker',
// 						'design' => 'block:right',
// 						'responsive' => true,
// 						'setting' => ['transport' => 'postMessage'],
// 						'value' => [
// 							'default' => [
// 								'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
// 							],

// 							'link_initial' => [
// 								'color' => 'var(--color)',
// 							],

// 							'link_hover' => [
// 								'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
// 							],
// 						],

// 						'pickers' => [
// 							[
// 								'title' => __('Text Initial', 'rishi'),
// 								'id' => 'default',
// 								'inherit' => 'var(--color)'
// 							],

// 							[
// 								'title' => __('Link Initial', 'rishi'),
// 								'id' => 'link_initial',
// 							],

// 							[
// 								'title' => __('Link Hover', 'rishi'),
// 								'id' => 'link_hover',
// 								'inherit' => 'var(--linkHoverColor)'
// 							],
// 						],
// 					],

// 					'sidebarWidgetsHeadingFontColor' => [
// 						'label' => __('Widgets Headings Font Color', 'rishi'),
// 						'type'  => 'rt-color-picker',
// 						'design' => 'block:right',
// 						'responsive' => true,
// 						'divider' => 'top',
// 						'setting' => ['transport' => 'postMessage'],

// 						'value' => [
// 							'default' => [
// 								'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
// 							],
// 						],

// 						'pickers' => [
// 							[
// 								'title' => __('Initial', 'rishi'),
// 								'id' => 'default',
// 								'inherit' => 'var(--headingColor)'
// 							],
// 						],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-divider',
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-condition',
// 						'condition' => ['sidebar_type' => 'type-2 | type-4'],
// 						'options' => [

// 							'sidebarBackgroundColor' => [
// 								'label' => __('Background Color', 'rishi'),
// 								'type'  => 'rt-color-picker',
// 								'design' => 'block:right',
// 								'responsive' => true,
// 								'setting' => ['transport' => 'postMessage'],
// 								'value' => [
// 									'default' => [
// 										'color' => 'var(--paletteColor5)',
// 									],
// 								],

// 								'pickers' => [
// 									[
// 										'title' => __('Initial', 'rishi'),
// 										'id' => 'default',
// 									],
// 								],
// 							],

// 						],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-condition',
// 						'condition' => ['sidebar_type' => 'type-2'],
// 						'options' => [

// 							'sidebarBorder' => [
// 								'label' => __('Border', 'rishi'),
// 								'type' => 'rt-border',
// 								'design' => 'block',
// 								'divider' => 'top',
// 								'responsive' => true,
// 								'setting' => ['transport' => 'postMessage'],
// 								'value' => [
// 									'width' => 1,
// 									'style' => 'none',
// 									'color' => [
// 										'color' => 'rgba(224, 229, 235, 0.8)',
// 									],
// 								]
// 							],

// 						],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-condition',
// 						'condition' => ['sidebar_type' => 'type-3'],
// 						'options' => [

// 							'sidebarDivider' => [
// 								'label' => __('Divider', 'rishi'),
// 								'type' => 'rt-border',
// 								'design' => 'block',
// 								'responsive' => true,
// 								'setting' => ['transport' => 'postMessage'],
// 								'value' => [
// 									'width' => 1,
// 									'style' => 'solid',
// 									'color' => [
// 										'color' => 'rgba(224, 229, 235, 0.8)',
// 									],
// 								]
// 							],

// 						],
// 					],

// 				 rishi__cb_customizer_rand_md5() => [
// 						'type' => 'rt-condition',
// 						'condition' => ['sidebar_type' => 'type-2'],
// 						'options' => [

// 							'sidebarShadow' => [
// 								'label' => __('Shadow', 'rishi'),
// 								'type' => 'rt-box-shadow',
// 								'responsive' => true,
// 								'divider' => 'top',
// 								'setting' => ['transport' => 'postMessage'],
// 								'value' => rishi__cb_customizer_box_shadow_value([
// 									'enable' => true,
// 									'h_offset' => 0,
// 									'v_offset' => 12,
// 									'blur' => 18,
// 									'spread' => -6,
// 									'inset' => false,
// 									'color' => [
// 										'color' => 'rgba(34, 56, 101, 0.04)',
// 									],
// 								])
// 							],

// 							'sidebarRadius' => [
// 								'label' => __('Border Radius', 'rishi'),
// 								'type' => 'rt-spacing',
// 								'divider' => 'top',
// 								'setting' => ['transport' => 'postMessage'],
// 								'value' => rishi__cb_customizer_spacing_value([
// 									'linked' => true,
// 								]),
// 								'responsive' => true
// 							],

// 						],
// 					],

// 				],
// 			],
// 		],
// 	],
// ];
