<?php

if (!isset($sidebarId)) {
	$sidebarId = 'footer-one';
}

if (!isset($id)) {
	$id = '_one';
}

$options = [
	'footer_hide_widget'.$id => [
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
	'widget' => [
		'type' => 'rt-widget-area',
		'sidebarId' => $sidebarId
	],

];
