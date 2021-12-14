<?php
function anipat_page_metabox( $meta_boxes ) {

	$anipat_prefix = '_anipat_';
	$meta_boxes[] = array(
		'id'        => 'anipat_metaboxes',
		'title'     => esc_html__( 'Page Options', 'anipat-companion' ),
		'post_types'=> array( 'page' ),
		'priority'  => 'high',
		'autosave'  => 'false',
		'fields'    => array(
			array(
				'id'    => $anipat_prefix . 'page_title',
				'type'  => 'text',
				// 'required'  => true,
				'name'  => esc_html__( 'Page Title', 'anipat-companion' ),
			),
			array(
				'id'    => $anipat_prefix . 'banner_img',
				'type'  => 'background',
				// 'required'  => true,
				'name'  => esc_html__( 'Banner Image', 'anipat-companion' ),
			),
		),
	);


	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'anipat_page_metabox' );
