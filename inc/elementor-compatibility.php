<?php
/**
 * Rishi\Elementor\Component class
 *
 * @package rishi
 */

namespace Rishi\Elementor;

use Elementor;
// use function add_action;
// use function add_theme_support;
// use function have_posts;
// use function the_post;
// use function apply_filters;
// use function get_template_part;
// use function get_post_type;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Controls\Repeater as Global_Style_Repeater;
use Elementor\Repeater;
use Elementor\Plugin;

class Rishi_Elementor_Widget_Loader{

	private static $_instance = null;

	public static function instance(){
		if ( is_null(self::$_instance) ) {
		self::$_instance = new self();
		}
		return self::$_instance;
	}

    public function __construct(){
		// add_filter( 'body_class', array( $this, 'add_body_class' ) );
		// add_action( 'elementor/editor/init', array( $this, 'elementor_add_theme_colors' ) );

		add_action( 'customize_save_after', array( $this, 'elementor_add_theme_colors' ) );

		add_action( 'rest_request_after_callbacks', array( $this, 'elementor_api_add_theme_colors' ), 999, 3 );
		add_filter( 'rest_request_after_callbacks', array( $this, 'display_global_colors_front_end' ), 999, 3 );
		add_filter( 'rishi_dynamic_theme_css', array( $this, 'generate_global_elementor_style' ), 11 );

		// add_action( 'elementor/element/kit/section_global_colors/after_section_end', array( $this, 'elementor_add_theme_color_controls' ), 10, 2 );
		// // Add Scripts for elementor.
		// add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'elementor_add_scripts' ) );
		// add_action( 'elementor/document/before_save', array( $this, 'elementor_before_save' ), 10, 2 );
		// add_action( 'elementor/document/after_save', array( $this, 'elementor_after_save' ), 10, 2 );
    }

	/**
	 * Adds a link style class to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array Filtered body classes.
	 */
	public function add_body_class( $classes ) {
		$classes[] = 'rishi-elementor-colors';

		return $classes;
	}
	/**
	 * Adds a 'el-is-editing' class to the array of body classes for when we are in elementor editing.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array Filtered body classes.
	 */
	public function filter_body_classes_add_editing_class( array $classes ) : array {
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$classes[] = 'el-is-editing';
		}
		return $classes;
	}

	/**
	 * Add some css styles for elementor admin.
	 */
	public function elementor_add_scripts() {
		if ( apply_filters( 'rishi_add_global_colors_to_elementor', true ) ) {
			wp_enqueue_style( 'rishi-elementor-admin', get_theme_file_uri( '/inc/css/elementor-admin.css' ), array(), RISHI_VERSION );
		}
	}


	public function elementor_before_save( $object, $data ) {
		// error_log( 'thisistest' );
		// error_log( print_r( $data, true ) );
	}
	public function elementor_after_save( $object, $data ) {
		if ( apply_filters( 'rishi_add_global_colors_to_elementor', true ) ) {
			if ( $data && isset( $data['settings'] ) && is_array( $data['settings'] ) && isset( $data['settings']['rishi_colors'] ) && is_array( $data['settings']['rishi_colors'] ) ) {
				$update_palette = false;
				$paletteColors = rishi__cb_customizer_get_colors(
					get_theme_mod('colorPalette'),
					[
						'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
						'color2' => [ 'color' => '#292929' ],
						'color3' => [ 'color' => '#307ac9' ],
						'color4' => [ 'color' => '#5081F5' ],
						'color5' => [ 'color' => '#ffffff' ],
						'color6' => [ 'color' => '#EDF2FE' ],
						'color7' => [ 'color' => '#F6F9FE' ],
						'color8' => [ 'color' => '#F9FBFE' ],
					]
				);

				$theme_colors = array(
					array(
						'_id' => 'rishi1',
						'title'  => __( 'Theme Color 1', 'rishi' ),
						'color' => $paletteColors['color1'],
					),
					array(
						'_id' => 'rishi2',
						'title'  => __( 'Theme Color 2', 'rishi' ),
						'color' => $paletteColors['color2'],
					),
					array(
						'_id' => 'rishi3',
						'title'  => __( 'Theme Color 3', 'rishi' ),
						'color' => $paletteColors['color3'],
					),
					array(
						'_id' => 'rishi4',
						'title'  => __( 'Theme Color 4', 'rishi' ),
						'color' => $paletteColors['color4'],
					),
					array(
						'_id' => 'rishi5',
						'title'  => __( 'Theme Color 5', 'rishi' ),
						'color' => $paletteColors['color5'],
					),
					array(
						'_id' => 'rishi6',
						'title'  => __( 'Theme Color 6', 'rishi' ),
						'color' => $paletteColors['color6'],
					),
					array(
						'_id' => 'rishi7',
						'title'  => __( 'Theme Color 7', 'rishi' ),
						'color' => $paletteColors['color7'],
					),
					array(
						'_id' => 'rishi8',
						'title'  => __( 'Theme Color 7', 'rishi' ),
						'color' => $paletteColors['color7'],
					),
				);
			
				foreach ( $data['settings']['rishi_colors'] as $key => $value ) {
					if ( 'palette1' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color1'] = $value['color'];
						$update_palette = true;
					}
					if ( 'palette2' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color2'] = $value['color'];
						$update_palette = true;
					}
					if ( 'palette3' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color3'] = $value['color'];
						$update_palette = true;
					}
					if ( 'palette4' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color4'] = $value['color'];
						$update_palette = true;
					}
					if ( 'palette5' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color5'] = $value['color'];
						$update_palette = true;
					}
					if ( 'palette6' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color6'] = $value['color'];
						$update_palette = true;
					}
					if ( 'palette7' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color7'] = $value['color'];
						$update_palette = true;
					}
					if ( 'palette8' == $value['_id'] && ! empty( $value['color'] ) ) {
						$paletteColors['color8'] = $value['color'];
						$update_palette = true;
					}
				
				}
				$current = \Elementor\Plugin::$instance->kits_manager->get_current_settings();
				if ( $current && isset( $current['custom_colors'] ) && $update_palette ) {
					$custom_colors = $current['custom_colors'];
					$rishi_add = true;
					
					$rishi = array( 'rishi1', 'rishi2', 'rishi3', 'rishi4', 'rishi5', 'rishi6', 'rishi7', 'rishi8', 'rishi9' );
					foreach ( $custom_colors as $key => $value ) {
						// error_log( print_r( $custom_colors, true ) );
						if ( is_array( $value ) && isset( $value['_id'] ) && in_array( $value['_id'], $rishi ) ) {
							$rishi_add = false;
							if ( $value['_id'] == 'rishi1' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color1'];
							}
							if ( $value['_id'] == 'rishi2' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color2'];
							}
							if ( $value['_id'] == 'rishi3' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color3'];
							}
							if ( $value['_id'] == 'rishi4' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color4'];
							}
							if ( $value['_id'] == 'rishi5' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color5'];
							}
							if ( $value['_id'] == 'rishi6' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color6'];
							}
							if ( $value['_id'] == 'rishi7' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color7'];
							}
							if ( $value['_id'] == 'rishi8' ) {
								$custom_colors[ $key ]['color'] = $paletteColors['color8'];
							}
						}
					}
					if ( $rishi_add ) {
						$custom_colors = array_merge( $theme_colors, $custom_colors );
					}
					//error_log( 'update?' );
					//error_log( print_r( $custom_colors, true ) );
					\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'custom_colors', $custom_colors );
					// Refresh cache.
					\Elementor\Plugin::instance()->files_manager->clear_cache();
					\Elementor\Plugin::$instance->documents->get( Plugin::$instance->kits_manager->get_active_id(), false );
				}

				$active_palette_colors = array();

				foreach ( $paletteColors as $key => $value ) {
					$active_palette_colors[ $key ] = [ 'color' => $value ];
				}
				
				$pallete_defaults = [
					'color1' => [
						'color' => 'rgba(41, 41, 41, 0.9)',
					],

					'color2' => [
						'color' => '#292929',
					],

					'color3' => [
						'color' => '#307ac9',
					],

					'color4' => [
						'color' => '#5081F5',
					],

					'color5' => [
						'color' => '#ffffff',
					],

					'color6' => [
						'color' => '#EDF2FE',
					],

					'color7' => [
						'color' => '#F6F9FE',
					],

					'color8' => [
						'color' => '#F9FBFE',
					],

					'current_palette' => 'palette-1',

					'palettes' => [
						[
							'id' => 'palette-1',

							'color1' => [
								'color' => 'rgba(41, 41, 41, 0.9)',
							],

							'color2' => [
								'color' => '#292929',
							],

							'color3' => [
								'color' => '#307ac9',
							],

							'color4' => [
								'color' => '#5081F5',
							],

							'color5' => [
								'color' => '#ffffff',
							],

							'color6' => [
								'color' => '#EDF2FE',
							],

							'color7' => [
								'color' => '#F6F9FE',
							],

							'color8' => [
								'color' => '#F9FBFE',
							],
						],
						
						[
							'id' => 'palette-2',

							'color1' => [
								'color' => 'rgba(0, 26, 26, 0.8)',
							],

							'color2' => [
								'color' => 'rgba(0, 26, 26, 0.9)',
							],

							'color3' => [
								'color' => '#03a6a6',
							],

							'color4' => [
								'color' => '#001a1a',
							],

							'color5' => [
								'color' => '#ffffff',
							],

							'color6' => [
								'color' => '#CDEDED',
							],

							'color7' => [
								'color' => '#F4FCFC',
							],

							'color8' => [
								'color' => '#FAFDFD',
							],
						],

						[
							'id' => 'palette-3',

							'color1' => [
								'color' => '#1e2436',
							],

							'color2' => [
								'color' => '#242b40',
							],

							'color3' => [
								'color' => '#ff8b3c',
							],

							'color4' => [
								'color' => '#8E919A',
							],

							'color5' => [
								'color' => '#ffffff',
							],

							'color6' => [
								'color' => '#E9E9EC',
							],

							'color7' => [
								'color' => '#FFF7F1',
							],

							'color8' => [
								'color' => '#FFFBF9',
							],
						],

						[
							'id' => 'palette-4',

							'color1' => [
								'color' => '#8D8D8D',
							],

							'color2' => [
								'color' => '#31332e',
							],

							'color3' => [
								'color' => '#8cb369',
							],

							'color4' => [
								'color' => '#A3C287',
							],

							'color5' => [
								'color' => '#ffffff',
							],

							'color6' => [
								'color' => '#E8F0E1',
							],

							'color7' => [
								'color' => '#F3F7F0',
							],

							'color8' => [
								'color' => '#ffffff',
							],
						],

						[
							'id' => 'palette-5',

							'color1' => [
								'color' => '#21201d',
							],

							'color2' => [
								'color' => '#21201d',
							],

							'color3' => [
								'color' => '#dea200',
							],

							'color4' => [
								'color' => '#343330',
							],

							'color5' => [
								'color' => '#ffffff',
							],

							'color6' => [
								'color' => '#F8ECCC',
							],

							'color7' => [
								'color' => '#FDF8ED',
							],

							'color8' => [
								'color' => '#fdfcf7',
							],
						],
					]
				];

				if ( $update_palette ) {
					$color_palette_mod = get_theme_mod('colorPalette', $pallete_defaults );
					if ( isset( $color_palette_mod['current_palette'] ) && isset( $color_palette_mod['palettes'] ) ) {
						$pallete_by_id = array_column( $color_palette_mod['palettes'], null, 'id' );

						$new_pallete_value = array_merge( $pallete_by_id[ $color_palette_mod['current_palette'] ], $active_palette_colors );

						$pallete_by_id[ $color_palette_mod['current_palette'] ] = $new_pallete_value;

						$color_palette_mod['palettes'] = array_column( $pallete_by_id, null );

						$color_palette_mod = array_merge( $color_palette_mod, $active_palette_colors );
					}
					$updated_nm = set_theme_mod( 'colorPalette', $color_palette_mod );
				}
			}
		}
	}

	/**
	 * Add some css styles for Restrict Content Pro
	 */
	public function elementor_add_theme_colors($return_data = false) {
		if ( apply_filters( 'rishi_add_global_colors_to_elementor', true ) ) {

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#307ac9' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#F6F9FE' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);

			$theme_colors = array(
				array(
					'_id' => 'rishi1',
					'title'  => __( 'Theme Color 1', 'rishi' ),
					'color' => $paletteColors['color1'],
				),
				array(
					'_id' => 'rishi2',
					'title'  => __( 'Theme Color 2', 'rishi' ),
					'color' => $paletteColors['color2'],
				),
				array(
					'_id' => 'rishi3',
					'title'  => __( 'Theme Color 3', 'rishi' ),
					'color' => $paletteColors['color3'],
				),
				array(
					'_id' => 'rishi4',
					'title'  => __( 'Theme Color 4', 'rishi' ),
					'color' => $paletteColors['color4'],
				),
				array(
					'_id' => 'rishi5',
					'title'  => __( 'Theme Color 5', 'rishi' ),
					'color' => $paletteColors['color5'],
				),
				array(
					'_id' => 'rishi6',
					'title'  => __( 'Theme Color 6', 'rishi' ),
					'color' => $paletteColors['color6'],
				),
				array(
					'_id' => 'rishi7',
					'title'  => __( 'Theme Color 7', 'rishi' ),
					'color' => $paletteColors['color7'],
				),
				array(
					'_id' => 'rishi8',
					'title'  => __( 'Theme Color 8', 'rishi' ),
					'color' => $paletteColors['color8'],
				),
			);
			$theme_placeholder_colors = array(
				array(
					'_id' => 'palette1',
					'title'  => __( 'Theme Color 1', 'rishi' ),
					'color' => $paletteColors['color1'],
				),
				array(
					'_id' => 'palette2',
					'title'  => __( 'Theme Color 2', 'rishi' ),
					'color' => $paletteColors['color2'],
				),
				array(
					'_id' => 'palette3',
					'title'  => __( 'Theme Color 3', 'rishi' ),
					'color' => $paletteColors['color3'],
				),
				array(
					'_id' => 'palette4',
					'title'  => __( 'Theme Color 4', 'rishi' ),
					'color' => $paletteColors['color4'],
				),
				array(
					'_id' => 'palette5',
					'title'  => __( 'Theme Color 5', 'rishi' ),
					'color' => $paletteColors['color5'],
				),
				array(
					'_id' => 'palette6',
					'title'  => __( 'Theme Color 6', 'rishi' ),
					'color' => $paletteColors['color6'],
				),
				array(
					'_id' => 'palette7',
					'title'  => __( 'Theme Color 7', 'rishi' ),
					'color' => $paletteColors['color7'],
				),
				array(
					'_id' => 'palette8',
					'title'  => __( 'Theme Color 8', 'rishi' ),
					'color' => $paletteColors['color8'],
				),
			);
			// Prevent Errors.
			if ( ! method_exists( \Elementor\Plugin::$instance->kits_manager, 'get_current_settings' ) ) {
				return;
			}
			$current = \Elementor\Plugin::$instance->kits_manager->get_current_settings();
		
			if ( $current && isset( $current['custom_colors'] ) ) {
				$custom_colors = $current['custom_colors'];
				$rishi_add_array = array(
					'rishi1' => true,
					'rishi2' => true,
					'rishi3' => true,
					'rishi4' => true,
					'rishi5' => true,
					'rishi6' => true,
					'rishi7' => true,
					'rishi8' => true,
				);
				$rishi_add = true;
				$clear_cache = false;
				$rishi = array( 'rishi1', 'rishi2', 'rishi3', 'rishi4', 'rishi5', 'rishi6', 'rishi7', 'rishi8' );
				foreach ( $custom_colors as $key => $value ) {
					if ( is_array( $value ) && isset( $value['_id'] ) && in_array( $value['_id'], $rishi ) ) {
						$rishi_add = false;
						if ( $value['_id'] == 'rishi1' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[0]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi1'] = false;
							$custom_colors[ $key ] = $theme_colors[0];
						}
						if ( $value['_id'] == 'rishi2' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[1]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi2'] = false;
							$custom_colors[ $key ] = $theme_colors[1];
						}
						if ( $value['_id'] == 'rishi3' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[2]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi3'] = false;
							$custom_colors[ $key ] = $theme_colors[2];
						}
						if ( $value['_id'] == 'rishi4' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[3]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi4'] = false;
							$custom_colors[ $key ] = $theme_colors[3];
						}
						if ( $value['_id'] == 'rishi5' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[4]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi5'] = false;
							$custom_colors[ $key ] = $theme_colors[4];
						}
						if ( $value['_id'] == 'rishi6' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[5]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi6'] = false;
							$custom_colors[ $key ] = $theme_colors[5];
						}
						if ( $value['_id'] == 'rishi7' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[6]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi7'] = false;
							$custom_colors[ $key ] = $theme_colors[6];
						}
					}
				}

				if ( $rishi_add ) {
					$custom_colors = array_merge( $theme_colors, $custom_colors );
				} else {
					$i       = 0;
					$new_add = array();
					foreach ( $rishi_add_array as $key => $value ) {
						if ( $value ) {
							$new_add[] = $theme_colors[ $i ];
						}
						$i++;
					}
					// Somehow colors were removed so we need to add them back in.
					if ( ! empty( $new_add ) ) {
						$custom_colors = array_merge( $new_add, $custom_colors );
					}
				}
				// if ( $return_data ) {
				// 	return $custom_colors;
				// }
				\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'custom_colors', $custom_colors );
				\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'rishi_colors', $theme_placeholder_colors );
				// Refresh cache.
				// if ( $clear_cache ) {
					// If the palette was updated in the customizer then we need to clear all the css.
					\Elementor\Plugin::instance()->files_manager->clear_cache();
				// }
			}
			
		}
	}

	/**
	 * Display theme global colors to Elementor Global colors
	 *
	 * @since 3.7.0
	 * @param object          $response rest request response.
	 * @param array           $handler Route handler used for the request.
	 * @param WP_REST_Request $request Request used to generate the response.
	 * @return object
	 */
	public function elementor_api_add_theme_colors( $response, $handler, $request ) {

		$route = $request->get_route();

		if ( '/elementor/v1/globals' != $route ) {
			return $response;
		}

		$data = $response->get_data();

		$paletteColors = rishi__cb_customizer_get_colors(
			get_theme_mod('colorPalette'),
			[
				'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
				'color2' => [ 'color' => '#292929' ],
				'color3' => [ 'color' => '#307ac9' ],
				'color4' => [ 'color' => '#5081F5' ],
				'color5' => [ 'color' => '#ffffff' ],
				'color6' => [ 'color' => '#EDF2FE' ],
				'color7' => [ 'color' => '#F6F9FE' ],
				'color8' => [ 'color' => '#F9FBFE' ],
			]
		);
		$index = 1;
		foreach ( $paletteColors as $key => $color ) {

			$slug = 'rishi'. $index;
			// Remove hyphens from slug.
			$no_hyphens = str_replace( '-', '', $slug );

			$data['colors'][ $no_hyphens ] = array(
				'id'    => esc_attr( $no_hyphens ),
				'title' => 'Theme Color ' . $index,
				'value' => $color,
			);
			$index++;
		}

		$response->set_data( $data );
		return $response;
	}

	/**
		 * Display global paltte colors on Elementor front end Page.
		 *
		 * @since 3.7.0
		 * @param object          $response rest request response.
		 * @param array           $handler Route handler used for the request.
		 * @param WP_REST_Request $request Request used to generate the response.
		 * @return object
		 */
		public function display_global_colors_front_end( $response, $handler, $request ) {

			$route = $request->get_route();

			if ( 0 !== strpos( $route, '/elementor/v1/globals' ) ) {
				return $response;
			}

			$slug_map      = array();
			$palette_slugs = array( 'rishi1', 'rishi2', 'rishi3', 'rishi4', 'rishi5', 'rishi6', 'rishi7', 'rishi8' );

			foreach ( $palette_slugs as $key => $slug ) {
				// Remove hyphens as hyphens do not work with Elementor global styles.
				$no_hyphens              = str_replace( '-', '', $slug );
				$slug_map[ $no_hyphens ] = $key;
			}

			$rest_id = substr( $route, strrpos( $route, '/' ) + 1 );

			if ( ! in_array( $rest_id, array_keys( $slug_map ), true ) ) {
				return $response;
			}

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#307ac9' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#F6F9FE' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);
			$index = isset( $slug_map[ $rest_id ] ) && 0 == $slug_map[ $rest_id ] ? 1 : $slug_map[ $rest_id ];
			$palette_ck = 'color' . $index;
			$response = rest_ensure_response(
				array(
					'id'    => esc_attr( $rest_id ),
					'title' => 'rishi' . esc_html( $slug_map[ $rest_id ] ),
					'value' => $paletteColors[$palette_ck],
				)
			);
			
			return $response;
		}

			/**
		 * Generate CSS variable style for Elementor.
		 *
		 * @since 3.7.0
		 * @param string $dynamic_css Dynamic CSS.
		 * @return object
		 */
		public function generate_global_elementor_style( $dynamic_css ) {

			$palette_style  = array();
			$style          = array();

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#307ac9' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#F6F9FE' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);

			$index = 1;
			foreach ( $paletteColors as $key => $color ) {
	
				$slug = 'rishi'. $index;
				// Remove hyphens from slug.
				$no_hyphens = str_replace( '-', '', $slug );
	
				$variable_key           = '--e-global-color-' . str_replace( '-', '', $slug );
				$style[ $variable_key ] = $color;
				$index++;
			}

			$palette_style[':root'] = $style;
			$dynamic_css           .= rishi_parse_css( $palette_style );

			return $dynamic_css;
		}

    /**
	 * Add in new Custom Controls for Theme Colors.
	 */
	public function elementor_add_theme_color_controls( $tab, $args ) {
		if ( apply_filters( 'rishi_add_global_colors_to_elementor', true ) ) {

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#307ac9' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#F6F9FE' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);


			$tab->start_controls_section(
				'section_theme_global_colors',
				array(
					'label' => __( 'Theme Global Colors', 'rishi' ),
					'tab' => 'global-colors',
				)
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'title',
				array(
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'required' => true,
				)
			);

			// Color Value
			$repeater->add_control(
				'color',
				array(
					'type' => Controls_Manager::COLOR,
					'label_block' => true,
					'dynamic' => [],
					'selectors' => array(
						'{{WRAPPER}}.el-is-editing' => '--global-{{_id.VALUE}}: {{VALUE}}',
					),
					'global' => array(
						'active' => false,
					),
				)
			);

			

			$theme_colors = array(
				array(
					'_id' => 'color1',
					'title'  => __( 'Theme Accent', 'rishi' ),
					'color' => $paletteColors['color1'],
				),
				array(
					'_id' => 'color2',
					'title'  => __( 'Theme Accent - alt', 'rishi' ),
					'color' => $paletteColors['color2'],
				),
				array(
					'_id' => 'color3',
					'title'  => __( 'Strongest text', 'rishi' ),
					'color' => $paletteColors['color3'],
				),
				array(
					'_id' => 'color4',
					'title'  => __( 'Strong Text', 'rishi' ),
					'color' => $paletteColors['color4'],
				),
				array(
					'_id' => 'color5',
					'title'  => __( 'Medium text', 'rishi' ),
					'color' => $paletteColors['color5'],
				),
				array(
					'_id' => 'color6',
					'title'  => __( 'Subtle Text', 'rishi' ),
					'color' => $paletteColors['color6'],
				),
				array(
					'_id' => 'color7',
					'title'  => __( 'Subtle Background', 'rishi' ),
					'color' => $paletteColors['color7'],
				),
			);

			$tab->add_control(
				'rishi_colors',
				array(
					'type' => Global_Style_Repeater::CONTROL_TYPE,
					'fields' => $repeater->get_controls(),
					'default' => $theme_colors,
					'item_actions' => array(
						'add' => false,
						'remove' => false,
					),
				)
			);
			$tab->end_controls_section();
		}
	}


	
    /**
	 * Check if page is built with elementor
	 *
	 * @return boolean true if elementor edit false if not.
	 */
	private function is_built_with_elementor( $page_id ) {
		return Elementor\Plugin::$instance->db->is_built_with_elementor( $page_id );
	}

    private function is_elementor() {
		if ( ( isset( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] ) || isset( $_REQUEST['elementor-preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return true;
		}

		return false;
	}

}

// Instantiate Plugin Class
Rishi_Elementor_Widget_Loader::instance();
