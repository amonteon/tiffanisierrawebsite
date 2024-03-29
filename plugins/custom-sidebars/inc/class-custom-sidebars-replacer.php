<?php

add_action( 'cs_init', array( 'CustomSidebarsReplacer', 'instance' ) );

/**
 * This class actually replaces sidebars on the frontend.
 *
 * @since  2.0
 */
class CustomSidebarsReplacer extends CustomSidebars {

	private $original_post_id = 0;

	/**
	 * Returns the singleton object.
	 *
	 * @since  2.0
	 */
	public static function instance() {
		static $Inst = null;

		if ( null === $Inst ) {
			$Inst = new CustomSidebarsReplacer();
		}

		return $Inst;
	}

	/**
	 * Constructor is private -> singleton.
	 *
	 * @since  2.0
	 */
	private function __construct() {
		add_action( 'widgets_init', array( $this, 'register_custom_sidebars' ) );

		// Support translation via WPML plugin.
		add_action( 'register_sidebar', array( $this, 'translate_sidebar' ) );

		if ( ! is_admin() ) {
			// Frontend hooks.
			add_action( 'wp_head', array( $this, 'replace_sidebars' ) );
			add_action( 'wp', array( $this, 'store_original_post_id' ) );
			/**
			 * print styles for media query
			 *
			 * @since 3.2.0
			 */
			add_action( 'wp_print_styles', array( $this, 'add_custom_css_for_media' ) );
		}
	}

	/**
	 * Add css styles for custom media width
	 *
	 * @since 3.2.0
	 */
	public function add_custom_css_for_media() {
		global $wp_registered_sidebars, $_wp_sidebars_widgets;
		$defaults = self::get_options();
		$replacements = $this->determine_replacements( $defaults );
		foreach ( $replacements as $sb_id => $replace_info ) {
			if ( empty( $replace_info ) || ! is_array( $replace_info ) ) {
				continue;
			}
			$replacement = array_shift( $replace_info );
			if (
				empty( $replacement )
				|| ! is_string( $replacement )
			) {
				continue;
			}
			if (
				isset( $defaults['screen'] )
				&& isset( $defaults['screen'][ $replacement ] )
			) {
				$css = '';
				$css_before = array();
				foreach ( $defaults['screen'][ $replacement ] as $css_size => $css_data ) {
					if ( empty( $css_data ) ) {
						continue;
					}
					foreach ( $css_data as $css_minmax => $css_mode ) {
						if ( empty( $css_size ) ) {
							continue;
						}
						if (
							! isset( $_wp_sidebars_widgets[ $replacement ] )
							|| empty( $_wp_sidebars_widgets[ $replacement ] )
						) {
							continue;
						}
						$css_selectors = array_map( array( $this, 'convert_do_css_id' ), $_wp_sidebars_widgets[ $replacement ] );
						$css_before[] = sprintf( '%s { display: none }', implode( ', ', $css_selectors ) );

						if ( 'max' === $css_minmax ) {
							$css .= sprintf(
								'@media screen and ( %s-width: %dpx ) { %s { display: %s; } }',
								esc_attr( $css_minmax ),
								esc_attr( $css_size ),
								implode( ', ', $css_selectors ),
								'hide' === $css_mode ? 'none':'initial'
							);
							$css .= PHP_EOL;
						} else {
							$css = sprintf(
								'@media screen and ( %s-width: %dpx ) { %s { display: %s; } }%s%s',
								esc_attr( $css_minmax ),
								esc_attr( $css_size ),
								implode( ', ', $css_selectors ),
								'hide' === $css_mode ? 'none':'initial',
								PHP_EOL,
								$css
							);
						}
					}
				}
				if ( ! empty( $css ) ) {
					$css_before = array_unique( $css_before );
					echo '<style type="text/css" media="screen">';
					echo PHP_EOL;
					echo implode( PHP_EOL, $css_before );
					echo PHP_EOL;
					echo $css;
					echo '</style>';
					echo PHP_EOL;

				}
			}
		}
	}

	/**
	 * Tell WordPress about the custom sidebars.
	 */
	public function register_custom_sidebars() {
		$sb = self::get_custom_sidebars();
		$sb = CustomSidebars::sort_sidebars_by_name( $sb );
		foreach ( $sb as $sidebar ) {
			/**
			 * Filter sidebar options for custom sidebars.
			 *
			 * @since  2.0
			 *
			 * @param  array $sidebar Options used by WordPress to display
			 *           the sidebar.
			 */
			$sidebar = apply_filters( 'cs_sidebar_params', $sidebar );
			register_sidebar( $sidebar );
		}
	}

	/**
	 * Stores the original post id before any plugin (buddypress) can modify this data, to show the proper sidebar.
	 */
	public function store_original_post_id() {
		global $post;

		if ( isset( $post->ID ) ) {
			$this->original_post_id = $post->ID;
		}
	}

	/**
	 * Replace the sidebars on current page with some custom sidebars.
	 * Sidebars are replaced by directly modifying the WordPress globals
	 * `$_wp_sidebars_widgets` and `$wp_registered_sidebars`
	 *
	 * What it really does it not replacing a specific *sidebar* but simply
	 * replacing all widgets inside the theme sidebars with the widgets of the
	 * custom defined sidebars.
	 */
	public function replace_sidebars() {
		global $_wp_sidebars_widgets,
			$wp_registered_sidebars,
			$wp_registered_widgets;

		$custom_sidebars_explain = CustomSidebarsExplain::instance();
		$expl = $custom_sidebars_explain->do_explain();

		$expl && do_action( 'cs_explain', '<h4>Replace sidebars</h4>', true );

		do_action( 'cs_before_replace_sidebars' );

		/**
		 * Original sidebar configuration by WordPress:
		 * Lists sidebars and all widgets inside each sidebar.
		 */
		$original_widgets = $_wp_sidebars_widgets;

		$defaults = self::get_options();

		/**
		 * Fires before determining sidebar replacements.
		 *
		 * @param  array $defaults Array of the default sidebars for the page.
		 */
		do_action( 'cs_predetermine_replacements', $defaults );

		// Legacy handler with camelCase
		do_action( 'cs_predetermineReplacements', $defaults );

		$replacements = $this->determine_replacements( $defaults );

		foreach ( $replacements as $sb_id => $replace_info ) {
			if ( ! is_array( $replace_info ) || count( $replace_info ) < 3 ) {
				$expl && do_action( 'cs_explain', 'Replacement for "' . $sb_id . '": -none-' );
				continue;
			}

			// Fix rare message "illegal offset type in isset or empty"
			$replacement = (string) @$replace_info[0];
			$replacement_type = (string) @$replace_info[1];
			$extra_index = (string) @$replace_info[2];

			$check = $this->is_valid_replacement( $sb_id, $replacement, $replacement_type, $extra_index );

			if ( $check && isset( $original_widgets[ $replacement ] ) ) {
				$expl && do_action( 'cs_explain', 'Replacement for "' . $sb_id . '": ' . $replacement );

				if ( sizeof( $original_widgets[ $replacement ] ) == 0 ) {
					// No widgets on custom sidebar, show nothing.
					$wp_registered_widgets['csemptywidget'] = $this->get_empty_widget();
					$_wp_sidebars_widgets[ $sb_id ] = array( 'csemptywidget' );
				} else {

					$_wp_sidebars_widgets[ $sb_id ] = $original_widgets[ $replacement ];

					/**
					 * When custom sidebars use some wrapper code (before_title,
					 * after_title, ...) then we need to strip-slashes for this
					 * wrapper code to work properly
					 */
					$sidebar_for_replacing = $wp_registered_sidebars[ $replacement ];
					if ( $this->has_wrapper_code( $sidebar_for_replacing ) ) {
						$sidebar_for_replacing = $this->clean_wrapper_code( $sidebar_for_replacing );
						$wp_registered_sidebars[ $sb_id ] = $sidebar_for_replacing;
					}
				}
				$wp_registered_sidebars[ $sb_id ]['class'] = $replacement;
			} else {
				// endif: is_valid_replacement
				$expl && do_action( 'cs_explain', 'Replacement for "' . $sb_id . '": -none-' );
			}
		} // endforeach
	}

	/**
	 * THIS IS THE ACTUAL LOGIC OF THE PLUGIN
	 *
	 * Here we find out if some sidebars should be replaced, and if it is
	 * replaced we determine which custom sidebar to use.
	 *
	 * @param   array $options Plugin options with the replacement rules.
	 * @return  array List of the replaced sidebars.
	 */
	public function determine_replacements( $options ) {
		global $post, $sidebar_category;

		$sidebars = self::get_options( 'modifiable' );
		$replacements_todo = sizeof( $sidebars );
		$replacements = array();

		$custom_sidebars_explain = CustomSidebarsExplain::instance();
		$expl = $custom_sidebars_explain->do_explain();

		foreach ( $sidebars as $sb ) {
			$replacements[ $sb ] = false;
		}

		// 1 |== Single posts/pages --------------------------------------------
		if ( is_singular() && ! is_home() && ! is_front_page() ) {
			$post_type = get_post_type();
			$post_type = apply_filters( 'cs_replace_post_type', $post_type, 'single' );
			$expl && do_action( 'cs_explain', 'Type 1: Single ' . ucfirst( $post_type ) );

			if ( ! self::supported_post_type( $post_type ) ) {
				$expl && do_action( 'cs_explain', 'Invalid post type, use default sidebars.' );
				return $options;
			}

			// 1.1 Check if replacements are defined in the post metadata.
			$reps = self::get_post_meta( $this->original_post_id );
			foreach ( $sidebars as $sb_id ) {
				if ( is_array( $reps ) && ! empty( $reps[ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$reps[ $sb_id ],
						'particular',
						-1,
					);
					$replacements_todo -= 1;
				}
			}

			// 1.2 Try to use the parents metadata.
			if ( $post->post_parent != 0 && $replacements_todo > 0 ) {
				$reps = self::get_post_meta( $post->post_parent );
				foreach ( $sidebars as $sb_id ) {
					if ( $replacements[ $sb_id ] ) { continue; }
					if (
						is_array( $reps )
						&& ! empty( $reps[ $sb_id ] )
					) {
						$replacements[ $sb_id ] = array(
							$reps[ $sb_id ],
							'particular',
							-1,
						);
						$replacements_todo -= 1;
					}
				}
			}

			// 1.3 If no metadata set then use the category settings.
			if ( $replacements_todo > 0 ) {
				$categories = self::get_sorted_categories();
				$ind = sizeof( $categories ) -1;
				while ( $replacements_todo > 0 && $ind >= 0 ) {
					$cat_id = $categories[ $ind ]->cat_ID;
					foreach ( $sidebars as $sb_id ) {
						if ( $replacements[ $sb_id ] ) { continue; }
						if ( ! empty( $options['category_single'][ $cat_id ][ $sb_id ] ) ) {
							$replacements[ $sb_id ] = array(
								$options['category_single'][ $cat_id ][ $sb_id ],
								'category_single',
								$sidebar_category,
							);
							$replacements_todo -= 1;
						}
					}
					$ind -= 1;
				}
			}

			// 1.4 Look for post-type level replacements.
			if ( $replacements_todo > 0 ) {
				foreach ( $sidebars as $sb_id ) {
					if ( $replacements[ $sb_id ] ) { continue; }
					if (
						isset( $options['post_type_single'][ $post_type ] )
						&& ! empty( $options['post_type_single'][ $post_type ][ $sb_id ] )
					) {
						$replacements[ $sb_id ] = array(
							$options['post_type_single'][ $post_type ][ $sb_id ],
							'post_type_single',
							$post_type,
						);
						$replacements_todo -= 1;
					}
				}
			}
		} elseif ( is_category() ) {
			// 2 |== Category archive ----------------------------------------------
			$expl && do_action( 'cs_explain', 'Type 2: Category Archive' );
			/**
			 * 2.1 Category archive
			 */
			foreach ( $sidebars as $sb_id ) {
				if ( ! $replacements[ $sb_id ] && isset( $options['category_archive'][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['category_archive'][ $sb_id ],
						'category_archive',
						0,
					);
				}
			}
			/**
			 *  2.2 Start at current category and travel up all parents
			 */
			$category_object = get_queried_object();
			$current_category = $category_object->term_id;

			if ( 0 != $current_category && $replacements_todo > 0 ) {
				foreach ( $sidebars as $sb_id ) {
					if (
						isset( $options['category_archive'] )
						&& isset( $options['category_archive'][ $current_category ] )
						&& isset( $options['category_archive'][ $current_category ][ $sb_id ] )
					) {
						$replacements[ $sb_id ] = array(
							$options['category_archive'][ $current_category ][ $sb_id ],
							'category_archive',
							$current_category,
						);
					}
				}
				$current_category = $category_object->category_parent;
				if ( 0 != $current_category ) {
					$category_object = get_category( $current_category );
				}
			}
		} elseif ( is_search() ) {
			// 3 |== Search --------------------------------------------------------
			// Must be before the post-type archive section; otherwise a search with
			// no results is recognized as post-type archive...

			$expl && do_action( 'cs_explain', 'Type 3: Search Results' );

			foreach ( $sidebars as $sb_id ) {
				if ( ! empty( $options['search'][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['search'][ $sb_id ],
						'search',
						-1,
					);
				}
			}
		} elseif ( ! is_tax() && ! is_404() && ! is_category() && ! is_singular() && get_post_type() != 'post' ) {
			// 4 |== Post-Tpe Archive ----------------------------------------------
			// `get_post_type() != 'post'` .. post-archive = post-index (see 7)

			$post_type = get_post_type();
			$post_type = apply_filters( 'cs_replace_post_type', $post_type, 'archive' );
			$expl && do_action( 'cs_explain', 'Type 4: ' . ucfirst( $post_type ) . ' Archive' );

			if ( ! self::supported_post_type( $post_type ) ) {
				$expl && do_action( 'cs_explain', 'Invalid post type, use default sidebars.' );
				return $options;
			}

			foreach ( $sidebars as $sb_id ) {
				if (
					isset( $options['post_type_archive'][ $post_type ] )
					&& ! empty( $options['post_type_archive'][ $post_type ][ $sb_id ] )
				) {
					$replacements[ $sb_id ] = array(
						$options['post_type_archive'][ $post_type ][ $sb_id ],
						'post_type_archive',
						$post_type,
					);
					$replacements_todo -= 1;
				}
			}
		} elseif ( is_page() && ! is_front_page() ) {
			// 5 |== Page ----------------------------------------------------------
			// `! is_front_page()` .. in case the site uses static front page.

			$post_type = get_post_type();
			$post_type = apply_filters( 'cs_replace_post_type', $post_type, 'page' );
			$expl && do_action( 'cs_explain', 'Type 5: ' . ucfirst( $post_type ) );

			if ( ! self::supported_post_type( $post_type ) ) {
				$expl && do_action( 'cs_explain', 'Invalid post type, use default sidebars.' );
				return $options;
			}

			// 5.1 Check if replacements are defined in the post metadata.
			$reps = self::get_post_meta( $this->original_post_id );
			foreach ( $sidebars as $sb_id ) {
				if ( is_array( $reps ) && ! empty( $reps[ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$reps[ $sb_id ],
						'particular',
						-1,
					);
					$replacements_todo -= 1;
				}
			}

			// 5.2 Try to use the parents metadata.
			$post_orginal = $post;
			while ( $replacements_todo > 0 && $post->post_parent > 0 ) {
				if ( $replacements_todo > 0 ) {
					$reps = self::get_post_meta( $post->post_parent );
					foreach ( $sidebars as $sb_id ) {
						if ( $replacements[ $sb_id ] ) {
							continue;
						}
						if ( is_array( $reps )
							&& ! empty( $reps[ $sb_id ] )
						) {
							$replacements[ $sb_id ] = array(
								$reps[ $sb_id ],
								'particular',
								-1,
							);
						}
					}
					$post = get_post( $post->post_parent );
				}
			}
			$post = $post_orginal;

			// 5.3 Look for post-type level replacements.
			if ( $replacements_todo > 0 ) {
				foreach ( $sidebars as $sb_id ) {
					if ( $replacements[ $sb_id ] ) { continue; }
					if ( isset( $options['post_type_single'][ $post_type ] )
						&& ! empty( $options['post_type_single'][ $post_type ][ $sb_id ] )
					) {
						$replacements[ $sb_id ] = array(
							$options['post_type_single'][ $post_type ][ $sb_id ],
							'post_type_single',
							$post_type,
						);
						$replacements_todo -= 1;
					}
				}
			}
		} elseif ( is_front_page() ) {
			// 6 |== Front Page ----------------------------------------------------

			/*
             * The front-page of the site. Either
             * - the post-index (default) or
             * - a static front-page.
             */

			$expl && do_action( 'cs_explain', 'Type 6: Front Page' );

			if ( ! is_home() ) {
				// A static front-page. Maybe we need the post-meta data...
				$reps_post = self::get_post_meta( $this->original_post_id );
				$reps_parent = self::get_post_meta( $post->post_parent );
			}

			foreach ( $sidebars as $sb_id ) {

				// First check if there is a 'Front Page' replacement.
				if ( ! empty( $options['blog'][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['blog'][ $sb_id ],
						'blog',
						-1,
					);
				} else if ( ! is_home() ) {
					// There is no 'Front Page' reaplcement and this is a static
					// front page, so check if the page has a replacement.

					// 6.1 Check if replacements are defined in the post metadata.
					if ( is_array( $reps_post ) && ! empty( $reps_post[ $sb_id ] ) ) {
						$replacements[ $sb_id ] = array(
							$reps_post[ $sb_id ],
							'particular',
							-1,
						);
						$replacements_todo -= 1;
					}

					// 6.2 Try to use the parents metadata.
					if ( $post->post_parent != 0 && $replacements_todo > 0 ) {
						if ( $replacements[ $sb_id ] ) { continue; }
						if ( is_array( $reps_parent )
							&& ! empty( $reps_parent[ $sb_id ] )
						) {
							$replacements[ $sb_id ] = array(
								$reps_parent[ $sb_id ],
								'particular',
								-1,
							);
							$replacements_todo -= 1;
						}
					}
				}
			}
		} elseif ( is_home() ) {
			// 7 |== Post Index ----------------------------------------------------

			/*
             * The post-index of the site. Either
             * - the front-page (default)
             * - when a static front page is used the post-index page.
             *
             * Note: When the default front-page is used the condition 6
             * "is_front_page" above is used and this node is never executed.
             */

			$expl && do_action( 'cs_explain', 'Type 7: Post Index' );

			foreach ( $sidebars as $sb_id ) {
				if ( ! empty( $options['post_type_archive']['post'][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['post_type_archive']['post'][ $sb_id ],
						'postindex',
						-1,
					);
				}
			}
		} elseif ( is_tag() ) {
			// 8 |== Tag archive ---------------------------------------------------

			$expl && do_action( 'cs_explain', 'Type 8: Tag Archive' );
			foreach ( $sidebars as $sb_id ) {
				if ( ! empty( $options['tags'][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['tags'][ $sb_id ],
						'tags',
						-1,
					);
				}
			}
		} elseif ( is_author() ) {
			// 9 |== Author archive ------------------------------------------------

			$author_object = get_queried_object();
			$current_author = $author_object->ID;
			$expl && do_action( 'cs_explain', 'Type 9: Author Archive (' . $current_author . ')' );

			// 9.1 First check for specific authors.
			foreach ( $sidebars as $sb_id ) {
				if ( ! empty( $options['author_archive'][ $current_author ][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['author_archive'][ $current_author ][ $sb_id ],
						'author_archive',
						$current_author,
					);
					$replacements_todo -= 1;
				}
			}

			// 9.2 Then check if there is an "Any authors" sidebar
			if ( $replacements_todo > 0 ) {
				foreach ( $sidebars as $sb_id ) {
					if ( $replacements[ $sb_id ] ) { continue; }
					if ( ! empty( $options['authors'][ $sb_id ] ) ) {
						$replacements[ $sb_id ] = array(
							$options['authors'][ $sb_id ],
							'authors',
							-1,
						);
					}
				}
			}
		} elseif ( is_date() ) {
			// 10 |== Date archive -------------------------------------------------

			$expl && do_action( 'cs_explain', 'Type 10: Date Archive' );

			foreach ( $sidebars as $sb_id ) {
				if ( ! empty( $options['date'][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['date'][ $sb_id ],
						'date',
						-1,
					);
				}
			}
		} elseif ( is_404() ) {
			// 11 |== 404 not found ------------------------------------------------
			$expl && do_action( 'cs_explain', 'Type 11: 404 not found' );

			foreach ( $sidebars as $sb_id ) {
				if ( ! empty( $options['404'][ $sb_id ] ) ) {
					$replacements[ $sb_id ] = array(
						$options['404'][ $sb_id ],
						'404',
						-1,
					);
				}
			}
		} elseif ( is_tax() ) {
			// 12 |== Taxonomy Archive ----------------------------------------------
			$current_term = get_queried_object();
			$taxonomy = $current_term->taxonomy;
			$taxonomy = apply_filters( 'cs_replace_taxonomy', $taxonomy, 'archive' );
			$expl && do_action( 'cs_explain', 'Type 12: ' . ucfirst( $taxonomy ) . ' Archive' );
			foreach ( $sidebars as $sb_id ) {
				if (
					isset( $options['taxonomies_archive'] )
					&& isset( $options['taxonomies_archive'][ $taxonomy ] )
					&& isset( $options['taxonomies_archive'][ $taxonomy ][ $sb_id ] )
				) {
					$expl && do_action( 'cs_explain', 'Replacement for custom taxonomy archive"' . $taxonomy );
					$replacements[ $sb_id ] = array(
						$options['taxonomies_archive'][ $taxonomy ][ $sb_id ],
						'taxonomies_archive',
						-1,
					);
				}
				/**
				 * replace for single taxonomy
				 */
				if (
					isset( $options['taxonomies_single'] )
					&& isset( $options['taxonomies_single'][ $taxonomy ] )
					&& isset( $options['taxonomies_single'][ $taxonomy ][ $current_term->term_id ] )
					&& isset( $options['taxonomies_single'][ $taxonomy ][ $current_term->term_id ][ $sb_id ] )
				) {
					$expl && do_action( 'cs_explain', 'Replacement for custom taxonomy ("' . $taxonomy . ') - '.$current_term->name );
					$replacements[ $sb_id ] = array(
						$options['taxonomies_single'][ $taxonomy ][ $current_term->term_id ][ $sb_id ],
						'taxonomies_single',
						-1,
					);
				}
			}
		}

		/**
		 * Filter the replaced sidebars before they are processed by the plugin.
		 *
		 * @since 2.0
		 * @since 3.1.2 added param $options
		 *
		 * @param array $replacements List of the final/replaced sidebars.
		 * @param array $options Custom Sidebars settings.
		 */
		$replacements = apply_filters( 'cs_replace_sidebars', $replacements, $options );

		return $replacements;
	}

	/**
	 * Makes sure that the replacement sidebar exists.
	 * If the custom sidebar does not exist then the WordPress/Post options are
	 * updated to remove the invalid option.
	 *
	 * @since  1.0.0
	 * @param  string $sb_id The original sidebar (the one that is replaced).
	 * @param  string $replacement ID of the custom sidebar that should be used.
	 * @param  string $method Info where the replacement setting is saved.
	 * @param  int|string $extra_index Depends on $method - can be either one:
	 *                empty/post-type/category-ID
	 * @return bool
	 */
	public function is_valid_replacement( $sb_id, $replacement, $method, $extra_index ) {
		global $wp_registered_sidebars;
		$options = self::get_options();

		if ( isset( $wp_registered_sidebars[ $replacement ] ) ) {
			// Everything okay, we can use the replacement
			return true;
		}

		/*
         * The replacement sidebar was not registered. Something's wrong, so we
         * update the options and not try to replace this sidebar again.
         */
		if ( 'particular' == $method ) {
			// Invalid replacement was found in post-meta data.
			$sidebars = self::get_post_meta( $this->original_post_id );
			if ( $sidebars && isset( $sidebars[ $sb_id ] ) ) {
				unset( $sidebars[ $sb_id ] );
				self::set_post_meta( $this->original_post_id, $sidebars );
			}
		} else {
			// Invalid replacement is defined in wordpress options table.
			if ( isset( $options[ $method ] ) ) {
				if (
					-1 != $extra_index &&
					isset( $options[ $method ][ $extra_index ] ) &&
					isset( $options[ $method ][ $extra_index ][ $sb_id ] )
				) {
					unset( $options[ $method ][ $extra_index ][ $sb_id ] );
					self::set_options( $options );
				}

				if (
					1 == $extra_index &&
					isset( $options[ $method ] ) &&
					isset( $options[ $method ][ $sb_id ] )
				) {
					unset( $options[ $method ][ $sb_id ] );
					self::set_options( $options );
				}
			}
		}

		return false;
	}

	/**
	 * Returns an empty dummy-widget. This dummy widget is used when a custom
	 * sidebar has no widgets.
	 *
	 * @since  1.0.0
	 */
	public function get_empty_widget() {
		$widget = new CustomSidebarsEmptyPlugin();
		return array(
			'name'        => 'CS Empty Widget',
			'id'          => 'csemptywidget',
			'callback'    => array( $widget, 'display_callback' ),
			'params'      => array( array( 'number' => 2 ) ),
			'classname'   => 'CustomSidebarsEmptyPlugin',
			'description' => 'CS dummy widget',
		);
	}

	/**
	 * Checks if the specified sidebar uses custom wrapper code.
	 *
	 * @since  1.2
	 * @return bool
	 */
	public function has_wrapper_code( $sidebar ) {
		return (
			strlen( trim( $sidebar['before_widget'] ) )
			|| strlen( trim( $sidebar['after_widget'] ) )
			|| strlen( trim( $sidebar['before_title'] ) )
			|| strlen( trim( $sidebar['after_title'] ) )
		);
	}

	/**
	 * Clean the slashes of the custom sidebar wrapper code.
	 *
	 * @since  1.2
	 */
	public function clean_wrapper_code( $sidebar ) {
		$sidebar['before_widget'] = stripslashes( $sidebar['before_widget'] );
		$sidebar['after_widget'] = stripslashes( $sidebar['after_widget'] );
		$sidebar['before_title'] = stripslashes( $sidebar['before_title'] );
		$sidebar['after_title'] = stripslashes( $sidebar['after_title'] );
		return $sidebar;
	}

	/**
	 * Translates a sidebar using WPML right after it was registered.
	 *
	 * @since  2.0.9.7
	 * @param  array $sidebar The sidebar that was registered
	 */
	public function translate_sidebar( $sidebar ) {
		if ( ! function_exists( 'icl_t' ) ) {
			return false;
		}
		global $wp_registered_sidebars;
		$context = 'Sidebar';
		// Translate the name and description.
		$sidebar['name'] = icl_t( $context, $sidebar['id'] . '-name', $sidebar['name'] );
		$sidebar['description'] = icl_t( $context, $sidebar['id'] . '-description', $sidebar['description'] );
		$wp_registered_sidebars[ $sidebar['id'] ] = $sidebar;
	}

	/**
	 * Convert to CSS ID.
	 *
	 * @since 3.2.0
	 */
	private function convert_do_css_id( $v ) {
		return sprintf( '#%s', esc_attr( $v ) );
	}
};