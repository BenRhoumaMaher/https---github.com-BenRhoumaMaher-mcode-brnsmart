<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => array_merge([
			'header_hide_text' => [
				'label' => false,
				'type' => 'hidden',
				'value' => false,
				'sync' => 'live',
				'setting' => [
					'type' => 'option',
					// 'transport' => 'postMessage'
				],
				'disableRevertButton' => true,
				'desc' => __('Hide', 'rishi'),
			],
			'header_text' => [
				'label'               => false,
				'type'                => 'wp-editor',
				'value'               => __('Sample text', 'rishi'),
				'desc'                => __('You can add here HTML code.', 'rishi'),
				'divider'             => 'bottom',
				'disableRevertButton' => true,
				'setting'             => ['transport' => 'postMessage'],
			],

			'headerTextMaxWidth' => [
				'label' => __('Container Maximum Width', 'rishi'),
				'type' => 'rt-slider',
				'min' => 10,
				'max' => 100,
				'value' => [
					'mobile' => '100',
					'tablet' => '100',
					'desktop' => '100',
				],
				'defaultUnit' => '%',
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
			],
			'headerLinkUnderLine' => [
				'label' => __('Underline Link', 'rishi'),
				'desc' => __('Enable this option to underline the link', 'rishi'),
				'type'  => 'rara-switch',
				'value' => 'no',
				'divider' => 'top',
			],

		], $panel_type === 'footer' ? [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footer_html_horizontal_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Horizontal Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'responsive' => true,
				'attr' => ['data-type' => 'alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'flex-start',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

			'footer_html_vertical_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Vertical Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'divider' => 'top',
				'responsive' => true,
				'attr' => ['data-type' => 'vertical-alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'CT_CSS_SKIP_RULE',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

			'footer_visibility' => [
				'label' => __('Element Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'divider' => 'top',
				'sync' => 'live',
				'value' => [
					'desktop' => true,
					'tablet' => true,
					'mobile' => true,
				],
				'choices' => rishi__cb_customizer_ordered_keys([
					'desktop' => __('Desktop', 'rishi'),
					'tablet' => __('Tablet', 'rishi'),
					'mobile' => __('Mobile', 'rishi'),
				]),
			],

		] : []),
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

			'headerTextFont' => [
				'type' => 'rt-typography',
				'label' => __('Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => '15px',
					'line-height' => '1.5',
				]),
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Font Color', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerTextColor',
						'label' => __('Default State', 'rishi')
					],
				],
				'options' => [

					'headerTextColor' => [
						'label' => __('Font Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor1)',
							],
						],

						'pickers' => [
							[
								'title' => __('Text Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--color)'
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Link Color', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerLinkColor',
						'label' => __('Default State', 'rishi')
					],
				],
				'options' => [

					'headerLinkColor' => [
						'label' => __('Link Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						// 'setting' => ['transport' => 'postMessage'],

						'value' => [

							'link_initial' => [
								'color' => 'var(--paletteColor3)',
							],

							'link_hover' => [
								'color' => 'var(--paletteColor2)',
							],
						],

						'pickers' => [
							[
								'title' => __('Link Initial', 'rishi'),
								'id' => 'link_initial',
								'inherit' => 'var(--linkInitialColor)'
							],

							[
								'title' => __('Link Hover', 'rishi'),
								'id' => 'link_hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'headerTextMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true
			],

		],
	],
];

if ($panel_type === 'header') {
	$options[ rishi__cb_customizer_rand_md5()] = [
		'type' => 'rt-condition',
		'condition' => [
			'wp_customizer_current_view' => 'tablet|mobile'
		],
		'options' => [
		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'visibility' => [
				'label' => __('Item Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'allow_empty' => true,
				'value' => [
					'tablet' => true,
					'mobile' => true,
				],

				'choices' => rishi__cb_customizer_ordered_keys([
					'tablet' => __('Tablet', 'rishi'),
					'mobile' => __('Mobile', 'rishi'),
				]),
			],

		],
	];
}
