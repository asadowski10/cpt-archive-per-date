<?php
class CPT_APD_Main {

	/**
	 * Constructor, register hooks
	 *
	 * @return void
	 * @author Alexandre Sadowski
	 */
	public function __construct() {
		add_action( 'init', array( __CLASS__, 'init' ), 99999999 );
	}

	public static function init() {
		global $wp_rewrite;

		foreach ( get_post_types( array( 'exclude_from_search' => false ) ) as $post_type ) {
			//Exclude Attachment
			if ( $post_type === 'attachment' ) {
				continue;
			}
			// Get prefix CPT
			$cpt_obj = get_post_type_object( $post_type );
			$cpt_query_var = $cpt_obj->query_var;
			if ( !empty( $cpt_obj->has_archive ) && $cpt_obj->has_archive !== true ) {
				$cpt_query_var = $cpt_obj->has_archive;
			}

			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/([0-9]{1,2})/?$", 'index.php?year=$matches[1]&monthnum=$matches[2]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$", 'index.php?year=$matches[1]&feed=$matches[2]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$", 'index.php?year=$matches[1]&feed=$matches[2]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/page/?([0-9]{1,})/?$", 'index.php?year=$matches[1]&paged=$matches[2]' . '&post_type=' . $post_type, 'top' );
			add_rewrite_rule( $wp_rewrite->root . $cpt_query_var . "/([0-9]{4})/?$", 'index.php?year=$matches[1]' . '&post_type=' . $post_type, 'top' );
		}
	}

}