<?php
/**
 * 404 Options
 */

$defaults = rishi__cb__get_breadcrumbs_defaults();

$options = [
    'layout_404_panel' => [
        'label'         => __('404 Page', 'rishi'),
        'type'          => 'rt-panel',
        'setting'       => ['transport' => 'postMessage'],
        'inner-options' => apply_filters( 'rishi__cb_:404:inneroptions', [
            '404_image' => [
				'label'        => __('Upload 404 Image', 'rishi'),
				'type'         => 'rt-image-uploader',
				'value'        => '',
				'inline_value' => true,
				'responsive'   => false,
				'attr'         => ['data-type' => 'small'],
			],
            '404_show_latest_post' => [
				'label'   => __('Show Latest Posts', 'rishi'),
				'type'    => 'rara-switch',
				'value'   => 'yes',
				'divider' => 'top',
				// 'setting' => ['transport' => 'postMessage'],
			],
          rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['404_show_latest_post' => 'yes'],
				'options' => [
                    '404_no_of_posts' => [
                        'label'   => __('Number of Posts', 'rishi'),
                        'type'    => 'rt-number',
                        'design'  => 'inline',
                        'value'   => 3,
                        'min'     => 1,
                        'max'     => 4,
                        'divider' => 'top',
                        'responsive' => false,
                    ],
                    '404_no_of_posts_row' => [
                        'label'   => __('Number of Posts per Row', 'rishi'),
                        'type'    => 'rt-number',
                        'design'  => 'inline',
                        'value'   => 3,
                        'min'     => 1,
                        'max'     => 4,
                        'divider' => 'top',
                        'responsive' => false,
                    ],

                    '404_show_blog_page_button' => [
                        'label'   => __('Show Blog Page Button', 'rishi'),
                        'type'    => 'rara-switch',
                        'value'   => 'yes',
                        'divider' => 'top',
                        // 'setting' => ['transport' => 'postMessage'],
                    ],
                ]
            ],
        ]),
    ],
];
