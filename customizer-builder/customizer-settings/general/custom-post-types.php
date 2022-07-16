<?php

$custom_post_types = rishi__cb_customizer_manager()->post_types->get_supported_post_types();

$options = [];

if (function_exists('is_bbpress')) {
	$options[ rishi__cb_customizer_rand_md5()] = [
		'type' => 'rt-group-title',
		'kind' => 'divider',
		'priority' => 3,
	];

	$options['post_type_single_bbpress'] = [
		'title'     => __('bbPress', 'rishi'),
		'container' => ['priority' => 3],
		'options'   => rishi__cb_customizer_get_options('posts/custom-post-type-single', [
			'post_type' => (object) [
				'name'   => 'bbpress',
				'labels' => (object) [
					'singular_name' => __('bbPress', 'rishi')
				]
			],

			'is_bbpress' => true
		]),
	];
}

if (function_exists('is_buddypress')) {
	$options[ rishi__cb_customizer_rand_md5()] = [
		'type' => 'rt-group-title',
		'kind' => 'divider',
		'priority' => 3,
	];

	$options['post_type_single_buddypress'] = [
		'title'     => __('BuddyPress', 'rishi'),
		'container' => ['priority' => 3],
		'options'   => rishi__cb_customizer_get_options('posts/custom-post-type-single', [
			'post_type' => (object) [
				'name'   => 'buddypress',
				'labels' => (object) [
					'singular_name' => __('BuddyPress', 'rishi')
				]
			],

			'is_bbpress' => true
		]),
	];
}

if (function_exists('tutor_course_enrolled_lead_info')) {
	$options[ rishi__cb_customizer_rand_md5()] = [
		'type' => 'rt-group-title',
		'kind' => 'divider',
		'priority' => 3,
	];

	$options['post_type_single_tutorlms'] = [
		'title' => __('TutorLMS', 'rishi'),
		'container' => ['priority' => 3],
		'options' => rishi__cb_customizer_get_options('integrations/tutorlms', []),
	];
}

foreach ($custom_post_types as $post_type) {
	$post_type_object = get_post_type_object($post_type);

	if (!$post_type_object) {
		continue;
	}


	$cpt_archive = apply_filters(
		'rishi:custom_post_types:archive-options',
		[
			'title' => $post_type_object->labels->name,
			'container' => ['priority' => 3],
			'options' => rishi__cb_customizer_get_options('posts/custom-post-type-archive', [
				'post_type' => $post_type_object
			]),
		],

		$post_type,
		$post_type_object
	);

	$cpt_single = apply_filters(
		'rishi:custom_post_types:single-options',
		[
			'title' => sprintf(
				__('Single %s', 'rishi'),
				$post_type_object->labels->name
			),
			'container' => ['priority' => 3, 'type' => 'child'],
			'options' => rishi__cb_customizer_get_options('posts/custom-post-type-single', [
				'post_type' => $post_type_object,
				'is_general_cpt' => true
			]),
		],
		$post_type,
		$post_type_object
	);

	if (
		$post_type === 'sfwd-courses'
		||
		$post_type === 'sfwd-topic'
		||
		$post_type === 'sfwd-lessons'
	) {
		if (!isset($options['learndash_posts_archives'])) {
			$options[ rishi__cb_customizer_rand_md5()] = [
				'type' => 'rt-group-title',
				'kind' => 'divider',
				'priority' => 2.8,
			];

			$options['learndash_posts_archives'] = [
				'title' => __('LearnDash', 'rishi'),
				'container' => [
					'priority' => 2.9
				],
				// 'only_if_exists' => true,
				'options' => []
			];
		}

		$options['learndash_posts_archives']['options']['post_type_archive_' . $post_type] = $cpt_archive;

		$options['learndash_posts_archives']['options']['post_type_single_' . $post_type] = $cpt_single;

		continue;
	}

	if ($post_type === 'courses') {
		continue;
	}

	$options[ rishi__cb_customizer_rand_md5()] = [
		'type' => 'rt-group-title',
		'kind' => 'divider',
		'priority' => 3,
	];

	$options['post_type_archive_' . $post_type] = $cpt_archive;
	$options['post_type_single_' . $post_type] = $cpt_single;
}
