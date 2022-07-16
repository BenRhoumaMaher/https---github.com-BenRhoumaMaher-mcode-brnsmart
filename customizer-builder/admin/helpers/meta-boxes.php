<?php
/**
 * Rishi theme Meta Boxes
 *
 * @package customizer-builder
 *
 * @since 1.0.0
 */
namespace __PREFIX__;
/**
 * Rishi Metaboxes
 *
 * @since 1.0.0
 */
class Metaboxes {

	public function __construct() {
		add_action( 'init', array( $this, 'init_taxonomies' ), 999 );

		add_action( 'load-post.php', array( $this, 'init_metabox' ) );
		add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
	}

	public function init_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'setup_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
	}

	public function init_taxonomies() {
		$post_types = apply_filters(
			'rishi:editor:post_types_for_rest_field',
			array( 'post', 'page' )
		);

		$custom_post_types = rishi__cb_customizer_manager()->post_types->get_supported_post_types();

		foreach ( $custom_post_types as $single_custom_post_type ) {
			$post_types[] = $single_custom_post_type;
		}

		register_rest_field(
			$post_types,
			'rishi__cb_customizer_meta',
			array(
				'get_callback'    => function ( $object ) {
					$post_id = $object['id'];
					return get_post_meta( $post_id, 'rishi__cb_customizer_post_meta_options', true );
				},
				'update_callback' => function ( $value, $object ) {
					$post_id = $object->ID;
					update_post_meta( $post_id, 'rishi__cb_customizer_post_meta_options', $value );
				},
			)
		);

		$current_edit_taxonomy = $this->get_current_edit_taxonomy();

		if ( ! empty( $_POST ) ) {
			add_action(
				'edited_term',
				function ( $term_id, $tt_id, $taxonomy ) {
					return;
					if (
					! ( isset( $_POST['action'] )
						&&
						'editedtag' === $_POST['action']
						&&
						isset( $_POST['taxonomy'] )
						&&
						( $taxonomy = get_taxonomy( sanitize_text_field( wp_unslash( $_POST['taxonomy'] ) ) ) )
						&&
						current_user_can( $taxonomy->cap->edit_terms ) )
					) {
						return;
					}

					if ( isset( $_POST['tag_ID'] ) && intval( sanitize_text_field( wp_unslash( $_POST['tag_ID'] ) ) ) !== $term_id ) {
						// the $_POST values belongs to another term, do not save them into this one
						return;
					}

					$options = $this->get_options_for_taxonomy( $taxonomy->name );

					if ( empty( $options ) ) {
						return;
					}

					$values = array();

					if ( isset( $_POST['rishi__cb_customizer_taxonomy_meta_options'][ rishi__cb_customizer_post_name() ] ) ) {
						$values = json_decode(
							sanitize_text_field( wp_unslash( $_POST['rishi__cb_customizer_taxonomy_meta_options'][ rishi__cb_customizer_post_name() ] ) ),
							true
						);
					}

					update_term_meta(
						$term_id,
						'rishi__cb_customizer_taxonomy_meta_options',
						$values
					);
				},
				10,
				3
			);
		}

		if (
			$current_edit_taxonomy['taxonomy'] === 'category'
			||
			$current_edit_taxonomy['taxonomy'] === 'post_tag'
		) {
			add_action(
				$current_edit_taxonomy['taxonomy'] . '_edit_form',
				function ( $term ) {
					return;
					$values = get_term_meta(
						$term->term_id,
						'rishi__cb_customizer_taxonomy_meta_options'
					);

					if ( empty( $values ) ) {
						$values = array( array() );
					}

					$options = $this->get_options_for_taxonomy( $term->taxonomy );

					if ( empty( $options ) ) {
						return;
					}

					$theme = rishi__cb_customizer_get_wp_theme();

					echo '<div class="cb__taxonomy-meta-box">';

					echo rishi__cb_html_tag(
						'h2',
						array(),
						sprintf(
							// Translators: %s is the theme name.
							__( '%s Settings', 'rishi' ),
							$theme->get( 'Name' )
						)
					);

					/**
					 * Note to code reviewers: This line doesn't need to be escaped.
					 * Function rishi__cb_customizer_output_options_panel() used here escapes the value properly.
					 */
					echo rishi__cb_customizer_output_options_panel(
						array(
							'options'     => $options,
							'values'      => $values[0],
							'id_prefix'   => 'cb__post-meta-options',
							'name_prefix' => 'rishi__cb_customizer_taxonomy_meta_options',
							'attr'        => array(
								'class' => 'cb__meta-box',
							),
						)
					);

					echo '</div>';
				}
			);
		}
	}

	public function setup_meta_box() {
		// Get all public posts.
		$post_types = get_post_types( array( 'public' => true ) );

		foreach ( $post_types as $type ) {
			$options = apply_filters( 'rishi__cb_customizer_post_meta_options', null, $type );

			if ( ! $options ) {
				continue;
			}

			add_meta_box(
				'rishi__cb_customizer_settings_meta_box',
				sprintf(
					// Translators: %s is the theme name.
					__( '%s Settings', 'rishi' ),
					__( 'Rishi', 'rishi' )
				),
				function ( $post ) {
					$values = get_post_meta( $post->ID, 'rishi__cb_customizer_post_meta_options' );

					if ( empty( $values ) ) {
						$values = array( array() );
					}

					$options = apply_filters(
						'rishi__cb_customizer_post_meta_options',
						null,
						get_post_type( $post )
					);

					if ( ! $options ) {
						return;
					}

					/**
					 * Note to code reviewers: This line doesn't need to be escaped.
					 * Function rishi__cb_customizer_output_options_panel() used here escapes the value properly.
					 */
					echo rishi__cb_customizer_output_options_panel(
						array(
							'options'     => $options,
							'values'      => $values[0],
							'id_prefix'   => 'cb__post-meta-options',
							'name_prefix' => 'rishi__cb_customizer_post_meta_options',
							'attr'        => array(
								'class' => 'cb__meta-box',
								'data-disable-reverse-button' => 'yes',
							),
						)
					);

					wp_nonce_field( basename( __FILE__ ), 'rishi__cb_customizer_settings_meta_box' );
				},
				$type,
				'normal',
				'default'
			);
		}
	}

	public function save_meta_box( $post_id ) {
		 // Checks save status.
		$is_autosave    = wp_is_post_autosave( $post_id );
		$is_revision    = wp_is_post_revision( $post_id );
		$is_valid_nonce = ! ! ( isset( $_POST['rishi__cb_customizer_settings_meta_box'] ) && wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['rishi__cb_customizer_settings_meta_box'] ) ),
			basename( __FILE__ )
		) );

		if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
			return;
		}

		$values = array();

		if ( isset( $_POST['rishi__cb_customizer_post_meta_options'][ rishi__cb_customizer_post_name() ] ) ) {
			$values = json_decode(
				wp_unslash( $_POST['rishi__cb_customizer_post_meta_options'][ rishi__cb_customizer_post_name() ] ),
				true
			);
		}

		update_post_meta( $post_id, 'rishi__cb_customizer_post_meta_options', $values );
	}

	private function get_current_edit_taxonomy() {
		static $cache_current_taxonomy_data = null;

		if ( $cache_current_taxonomy_data !== null ) {
			return $cache_current_taxonomy_data;
		}

		$result = array(
			'taxonomy' => null,
			'term_id'  => 0,
		);

		do {
			if ( ! is_admin() ) {
				break;
			}

			// code from /wp-admin/admin.php line 110
			{
			if (
					isset( $_REQUEST['taxonomy'] )
					&&
					taxonomy_exists(
						sanitize_text_field( wp_unslash( $_REQUEST['taxonomy'] ) )
					)
				) {
				$taxnow = sanitize_text_field( wp_unslash( $_REQUEST['taxonomy'] ) );
			} else {
				$taxnow = '';
			}
			}

			if ( empty( $taxnow ) ) {
				break;
			}

			$result['taxonomy'] = $taxnow;

			if ( empty( $_REQUEST['tag_ID'] ) ) {
				return $result;
			}

			// code from /wp-admin/edit-tags.php
			{
				$tag_ID = (int) $_REQUEST['tag_ID'];
			}

			$result['term_id'] = $tag_ID;
		} while ( false );

		$cache_current_taxonomy_data = $result;
		return $cache_current_taxonomy_data;
	}

	private function get_options_for_taxonomy( $taxonomy ) {
		$options = array();

		$taxonomy_slug = str_replace( '_', '-', $taxonomy );

		global $wp_taxonomies;

		$post_type = $wp_taxonomies[ $taxonomy ]->object_type;

		if ( is_array( $post_type ) && strpos( implode( '', $post_type ), 'post' ) !== false ) {
			$taxonomy_slug = 'category';
		}

		$path = get_template_directory() . '/inc/options/taxonomies/' . $taxonomy_slug . '.php';

		if ( file_exists( $path ) ) {
			$options = rishi__cb_get_akv(
				'options',
			 rishi__cb_customizer_get_variables_from_file( $path, array( 'options' => array() ) )
			);
		}

		return $options;
	}
}

class_alias( '__PREFIX__\Metaboxes', '\Rishi_Meta_Boxes' );

new Metaboxes();
