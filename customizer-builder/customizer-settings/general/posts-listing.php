<?php

if (!isset($is_cpt)) {
	$is_cpt = false;
}

if (!isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (!isset($title)) {
	$title = __('blog', 'rishi');
}

$options = [
 rishi__cb_customizer_rand_md5() => [
		'type'  => 'rt-title',
		'label' => sprintf(
			// translators: placeholder here means the actual structure title.
			__('%s Structure', 'rishi'),
			$title
		),
		'desc' => sprintf(
			// translators: placeholder here means the actual structure title.
			__('Set the %s entries default structure.', 'rishi'),
			$title
		),
	],

	$prefix . 'structure' => [
		'label' => false,
		'type' => 'rt-image-picker',
		'value' => 'grid',
		'sync' => rishi__cb_customizer_sync_whole_page([
			'prefix' => $prefix,
			'loader_selector' => '.entries > article'
		]),
		'choices' => [
			'simple' => [
				'src' => rishi__cb_customizer_image_picker_url('simple.svg'),
				'title' => __('Simple', 'rishi'),
			],

			'classic' => [
				'src' => rishi__cb_customizer_image_picker_url('classic.svg'),
				'title' => __('Classic', 'rishi'),
			],

			'grid' => [
				'src' => rishi__cb_customizer_image_picker_url('grid.svg'),
				'title' => __('Grid', 'rishi'),
			],

			'enhanced-grid' => [
				'src' => rishi__cb_customizer_image_picker_url('enhanced-grid.svg'),
				'title' => __('Enhanced Grid', 'rishi'),
			],

			'gutenberg' => [
				'src' => rishi__cb_customizer_image_picker_url('gutenberg.svg'),
				'title' => __('Gutenberg', 'rishi'),
			],
		],
	],

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-divider',
		'attr' => ['data-type' => 'small']
	],

	$prefix . 'archive_listing_panel' => [
		'label' => __('Cards Options', 'rishi'),
		'type' => 'rt-panel',
		'value' => 'yes',
		'wrapperAttr' => ['data-panel' => 'only-arrow'],
		'inner-options' => [
		 rishi__cb_customizer_rand_md5() => [
				'title' => __('General', 'rishi'),
				'type' => 'tab',
				'options' => [

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [$prefix . 'structure' => '!grid'],
						'options' => [

							$prefix . 'archive_per_page' => [
								'label' => __('Posts per page', 'rishi'),
								'type' => 'rt-number',
								'value' => 10,
								'min' => 1,
								'max' => 30,
								'design' => 'inline',
								'sync' => rishi__cb_customizer_sync_whole_page([
									'prefix' => $prefix,
									'loader_selector' => '.entries > article'
								]),
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [$prefix . 'structure' => 'grid'],
						'options' => [

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-group',
								'label' => __('Posts Number', 'rishi'),
								'attr' => ['data-columns' => '2:medium'],
								'options' => [

									$prefix . 'columns' => [
										'label' => false,
										'desc' => __('Posts per row', 'rishi'),
										'type' => 'rt-number',
										'value' => 3,
										'min' => 2,
										'max' => 5,
										'design' => 'block',
										'disableRevertButton' => true,
										'attr' => ['data-width' => 'full'],
										'sync' => rishi__cb_customizer_sync_whole_page([
											'prefix' => $prefix,
											'loader_selector' => '.entries > article'
										]),
									],

									$prefix . 'archive_per_page' => [
										'label' => false,
										'desc' => __('Posts per page', 'rishi'),
										'type' => 'rt-number',
										'value' => 10,
										'min' => 1,
										'max' => 30,
										'design' => 'block',
										'disableRevertButton' => true,
										'attr' => ['data-width' => 'full'],
										'sync' => rishi__cb_customizer_sync_whole_page([
											'prefix' => $prefix,
											'loader_selector' => '.entries > article'
										]),
									],

								],
							],

						],
					],


				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					$prefix . 'archive_order' => apply_filters('rishi:options:posts-listing-archive-order', [
						'label' => __('Card Elements', 'rishi'),
						'type' => 'rt-layers',

						'sync' => [
						 rishi__cb_customizer_sync_whole_page([
								'prefix' => $prefix,
								'loader_selector' => '.entries > article[id]'
							]),

							[
								'prefix' => $prefix,
								'id' => $prefix . 'archive_order_heading_tag',
								'loader_selector' => '.entry-title',
								'container_inclusive' => false
							],

							[
								'prefix' => $prefix,
								'id' => $prefix . 'archive_order_image',
								'loader_selector' => '.rt-image-container',
								'container_inclusive' => false
							],

							[
								'prefix' => $prefix,
								'id' => $prefix . 'archive_order_button',
								'loader_selector' => '.entry-button',
								'container_inclusive' => false
							],

							[
								'prefix' => $prefix,
								'id' => $prefix . 'archive_order_skip',
								'loader_selector' => 'skip',
								'container_inclusive' => false
							],

							[
								'prefix' => $prefix,
								'id' => $prefix . 'archive_order_meta_first',
								'loader_selector' => '.entry-meta:1',
								'container_inclusive' => false
							],

							[
								'prefix' => $prefix,
								'id' => $prefix . 'archive_order_meta_second',
								'loader_selector' => '.entry-meta:2',
								'container_inclusive' => false
							],
						],

						'value' => [
							[
								'id' => 'post_meta',
								'enabled' => true,
								'meta_elements' => rishi__cb__customizer_post_meta_defaults([
									[
										'id' => 'categories',
										'enabled' => true,
									],
								]),
								'meta_type' => 'simple',
								'meta_divider' => 'slash',
							],

							[
								'id' => 'title',
								'heading_tag' => 'h2',
								'enabled' => true,
							],

							[
								'id' => 'featured_image',
								'thumb_ratio' => '4/3',
								'is_boundless' => 'yes',
								'image_size' => 'medium_large',
								'enabled' => true,
							],

							[
								'id' => 'excerpt',
								'excerpt_length' => '40',
								'enabled' => true,
							],

							[
								'id' => 'read_more',
								'button_type' => 'background',
								'enabled' => false,
							],

							[
								'id' => 'post_meta',
								'enabled' => true,
								'meta_elements' => rishi__cb__customizer_post_meta_defaults([
									[
										'id' => 'author',
										'enabled' => true,
									],

									[
										'id' => 'post_date',
										'enabled' => true,
									],

									[
										'id' => 'comments',
										'enabled' => true,
									],
								]),
								'meta_type' => 'simple',
								'meta_divider' => 'slash',
							],

							[
								'id' => 'divider',
								'enabled' => false
							]
						],

						'settings' => [
							'title' => [
								'label' => __('Title', 'rishi'),
								'options' => [

									'heading_tag' => [
										'label' => __('Heading tag', 'rishi'),
										'type' => 'rt-select',
										'value' => 'h2',
										'view' => 'text',
										'design' => 'inline',
										'sync' => [
											'id' => $prefix . 'archive_order_heading_tag',
										],
										'choices' => rishi__cb_customizer_ordered_keys(
											[
												'h1' => 'H1',
												'h2' => 'H2',
												'h3' => 'H3',
												'h4' => 'H4',
												'h5' => 'H5',
												'h6' => 'H6',
											]
										),
									],

								],
							],

							'featured_image' => [
								'label' => __('Featured Image', 'rishi'),
								'options' => [
									'thumb_ratio' => [
										'label' => __('Image Ratio', 'rishi'),
										'type' => 'rt-ratio',
										'view' => 'inline',
										'value' => '4/3',
										'sync' => [
											'id' => $prefix . 'archive_order_skip',
										],
									],

									'image_size' => [
										'label' => __('Image Size', 'rishi'),
										'type' => 'rt-select',
										'value' => 'medium_large',
										'view' => 'text',
										'design' => 'inline',
										'sync' => [
											'id' => $prefix . 'archive_order_image',
										],
										'choices' => rishi__cb_customizer_ordered_keys(
										 rishi__cb_customizer_get_all_image_sizes()
										),
									],

								 rishi__cb_customizer_rand_md5() => [
										'type' => 'rt-condition',
										'condition' => [
											$prefix . 'card_type' => 'boxed',
											$prefix . 'structure' => '!gutenberg'
										],
										'values_source' => 'global',
										'options' => [
											'is_boundless' => [
												'label' => __('Boundless Image', 'rishi'),
												'type' => 'rara-switch',
												'sync' => [
													'id' => $prefix . 'archive_order_skip',
												],
												'value' => 'yes',
											],
										],
									],

								],
							],

							'excerpt' => [
								'label' => __('Excerpt', 'rishi'),
								'options' => [
									'excerpt_length' => [
										'label' => __('Length', 'rishi'),
										'type' => 'rt-number',
										'design' => 'inline',
										'value' => 40,
										'min' => 10,
										'max' => 100,
									],
								],
							],

							'read_more' => [
								'label' => __('Read More Button', 'rishi'),
								'options' => [
									'button_type' => [
										'label' => false,
										'type' => 'rt-radio',
										'value' => 'background',
										'view' => 'text',
										'choices' => [
											'simple' => __('Simple', 'rishi'),
											'background' => __('Background', 'rishi'),
											'outline' => __('Outline', 'rishi'),
										],

										'sync' => [
											'id' => $prefix . 'archive_order_skip',
										]
									],

									'read_more_text' => [
										'label' => __('Text', 'rishi'),
										'type' => 'text',
										'design' => 'inline',
										'value' => __('Read More', 'rishi'),
										'sync' => [
											'id' => $prefix . 'archive_order_skip',
										]
									],

									'read_more_arrow' => [
										'label' => __('Show Arrow', 'rishi'),
										'type' => 'rara-switch',
										'value' => 'no',
										'sync' => [
											'id' => $prefix . 'archive_order_button',
										]
									],

									'read_more_alignment' => [
										'type' => 'rt-radio',
										'label' => __('Alignment', 'rishi'),
										'value' => 'left',
										'view' => 'text',
										'attr' => ['data-type' => 'alignment'],
										'design' => 'block',
										'sync' => [
											'prefix' => $prefix,
											'id' => $prefix . 'archive_order_skip',
										],
										'choices' => [
											'left' => '',
											'center' => '',
											'right' => '',
										],
									],
								],
							],

							'post_meta' => [
								'label' => __('Post Meta', 'rishi'),
								'clone' => true,
								'sync' => [
									'id' => $prefix . 'archive_order_meta'
								],
								'options' => rishi__cb_customizer_get_options('general/meta', [
									'is_cpt' => $is_cpt,
									'skip_sync_id' => [
										'id' => $prefix . 'archive_order_skip'
									],
									'meta_elements' => rishi__cb__customizer_post_meta_defaults([
										[
											'id' => 'author',
											'enabled' => true,
										],

										[
											'id' => 'post_date',
											'enabled' => true,
										],

										[
											'id' => 'comments',
											'enabled' => true,
										],
									]),
								])
							],

							'divider' => [
								'label' => __('Divider', 'rishi'),
								'clone' => true,
								'sync' => [
									'id' => $prefix . 'archive_order_meta'
								],
							]
						],
					], trim($prefix, '_')),

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'structure' => '!gutenberg'
						],
						'options' => [
							$prefix . 'card_type' => [
								'label' => __('Card Type', 'rishi'),
								'type' => 'rt-radio',
								'value' => 'boxed',
								'view' => 'text',
								'divider' => 'bottom',
								'sync' => 'live',
								'choices' => [
									'simple' => __('Simple', 'rishi'),
									'boxed' => __('Boxed', 'rishi'),
								],
							],
						],
					],

					$prefix . 'cardsGap' => [
						'label' => __('Cards Gap', 'rishi'),
						'type' => 'rt-slider',
						'min' => 0,
						'max' => 100,
						'responsive' => true,
						'sync' => 'live',
						'value' => 30,
					],

					$prefix . 'card_spacing' => [
						'label' => __('Card Inner Spacing', 'rishi'),
						'type' => 'rt-slider',
						'min' => 0,
						'max' => 100,
						'responsive' => true,
						'value' => [
							'mobile' => 25,
							'tablet' => 35,
							'desktop' => 35,
						],
						'divider' => 'top',
						'sync' => 'live',
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'title' => __('Design', 'rishi'),
				'type' => 'tab',
				'options' => [

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'archive_order:array-ids:title:enabled' => '!no'
						],
						'options' => [

							$prefix . 'cardTitleFont' => [
								'type' => 'rt-typography',
								'label' => __('Title Font', 'rishi'),
								'sync' => 'live',
								'value' => rishi__cb_customizer_typography_default_values([
									'size' => [
										'desktop' => '20px',
										'tablet'  => '20px',
										'mobile'  => '18px'
									],
									'line-height' => '1.3'
								]),
							],

							$prefix . 'cardTitleColor' => [
								'label' => __('Title Font Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'sync' => 'live',
								'design' => 'inline',

								'value' => [
									'default' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],

									'hover' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--headingColor)'
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--linkHoverColor)'
									],
								],
							],

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-divider',
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'archive_order:array-ids:excerpt:enabled' => '!no'
						],
						'options' => [

							$prefix . 'cardExcerptFont' => [
								'type' => 'rt-typography',
								'label' => __('Excerpt Font', 'rishi'),
								'sync' => 'live',
								'value' => rishi__cb_customizer_typography_default_values([
									'size' => [
										'desktop' => '16px',
										'tablet'  => '16px',
										'mobile'  => '16px'
									],
								]),
							],

							$prefix . 'cardExcerptColor' => [
								'label' => __('Excerpt Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'noColor' => ['background' => 'var(--color)'],
								'sync' => 'live',
								'value' => [
									'default' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--color)'
									],
								],
							],

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-divider',
							],

						],
					],

					$prefix . 'cardMetaFont' => [
						'type' => 'rt-typography',
						'label' => __('Meta Font', 'rishi'),
						'sync' => 'live',
						'value' => rishi__cb_customizer_typography_default_values([
							'size' => [
								'desktop' => '12px',
								'tablet'  => '12px',
								'mobile'  => '12px'
							],
							'variation' => 'n6',
							'text-transform' => 'uppercase',
						]),
					],

					$prefix . 'cardMetaColor' => [
						'label' => __('Meta Font Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'noColor' => ['background' => 'var(--color)'],
						'sync' => 'live',
						'value' => [
							'default' => [
								'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--color)'
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],


				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'archive_order:array-ids:read_more:button_type' => 'simple',
							$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
						],
						'options' => [

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-divider',
							],

							$prefix . 'cardButtonSimpleTextColor' => [
								'label' => __('Button Font Color', 'rishi'),
								'sync' => 'live',
								'type'  => 'rt-color-picker',
								'design' => 'inline',

								'value' => [
									'default' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],

									'hover' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--linkInitialColor)'
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--linkHoverColor)'
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'archive_order:array-ids:read_more:button_type' => 'background',
							$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
						],
						'options' => [

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-divider',
							],

							$prefix . 'cardButtonBackgroundTextColor' => [
								'label' => __('Button Font Color', 'rishi'),
								'sync' => 'live',
								'type'  => 'rt-color-picker',
								'design' => 'inline',

								'value' => [
									'default' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],

									'hover' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--buttonTextInitialColor)'
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--buttonTextHoverColor)'
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'archive_order:array-ids:read_more:button_type' => 'outline',
							$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
						],
						'options' => [

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-divider',
							],

							$prefix . 'cardButtonOutlineTextColor' => [
								'label' => __('Button Font Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'sync' => 'live',
								'design' => 'inline',

								'value' => [
									'default' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],

									'hover' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--linkInitialColor)'
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--linkHoverColor)'
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'archive_order:array-ids:read_more:button_type' => '!simple',
							$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
						],
						'options' => [

							$prefix . 'cardButtonColor' => [
								'label' => __('Button Color', 'rishi'),
								'sync' => 'live',
								'type'  => 'rt-color-picker',
								'design' => 'inline',

								'value' => [
									'default' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],

									'hover' => [
										'color' => \RT_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--buttonInitialColor)'
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--buttonHoverColor)'
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'card_type' => 'simple',
							$prefix . 'archive_order:array-ids:featured_image:enabled' => '!no'

						],
						'options' => [

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-divider',
							],

							$prefix . 'cardThumbRadius' => [
								'label' => __('Featured Image Radius', 'rishi'),
								'type' => 'rt-spacing',
								'sync' => 'live',
								'value' => rishi__cb_customizer_spacing_value([
									'linked' => true,
								]),
								'responsive' => true
							],

							$prefix . 'cardDivider' => [
								'label' => __('Card bottom divider', 'rishi'),
								'type' => 'rt-border',
								'sync' => 'live',
								'design' => 'inline',
								'divider' => 'top',
								'value' => [
									'width' => 1,
									'style' => 'dashed',
									'color' => [
										'color' => 'rgba(224, 229, 235, 0.8)',
									],
								]
							],
						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					$prefix . 'entryDivider' => [
						'label' => __('Card Divider', 'rishi'),
						'type' => 'rt-border',
						'sync' => 'live',
						'design' => 'inline',
						'value' => [
							'width' => 1,
							'style' => 'solid',
							'color' => [
								'color' => 'rgba(224, 229, 235, 0.8)',
							],
						]
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'card_type' => 'boxed',
							$prefix . 'structure' => '!gutenberg'
						],
						'options' => [

						 rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-divider',
							],

							$prefix . 'cardBackground' => [
								'label' => __('Card Background Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'sync' => 'live',
								'design' => 'inline',
								'value' => [
									'default' => [
										'color' => '#ffffff',
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],
								],
							],

							$prefix . 'cardBorder' => [
								'label' => __('Card Border', 'rishi'),
								'type' => 'rt-border',
								'design' => 'block',
								'sync' => 'live',
								'divider' => 'top',
								'responsive' => true,
								'value' => [
									'width' => 1,
									'style' => 'none',
									'color' => [
										'color' => 'rgba(44,62,80,0.2)',
									],
								]
							],

							$prefix . 'cardShadow' => [
								'label' => __('Card Shadow', 'rishi'),
								'type' => 'rt-box-shadow',
								'sync' => 'live',
								'responsive' => true,
								'divider' => 'top',
								'value' => rishi__cb_customizer_box_shadow_value([
									'enable' => true,
									'h_offset' => 0,
									'v_offset' => 12,
									'blur' => 18,
									'spread' => -6,
									'inset' => false,
									'color' => [
										'color' => 'rgba(34, 56, 101, 0.04)',
									],
								])
							],

							$prefix . 'cardRadius' => [
								'label' => __('Border Radius', 'rishi'),
								'sync' => 'live',
								'type' => 'rt-spacing',
								'divider' => 'top',
								'value' => rishi__cb_customizer_spacing_value([
									'linked' => true,
								]),
								'responsive' => true
							],

						],
					],
				],
			],
		]
	],
];
