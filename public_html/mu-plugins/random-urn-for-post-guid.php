<?php
/**
 * Plugin Name:  Random URN for post GUID
 * Description:  Replaces the default GUID (which uses URLs with the domain name) with a random UUID URN. This is also compliant with the spec or Atom/RSS:
 *               'Identifies the feed using a universally unique and permanent URI'
 *               See https://www.bjornjohansen.com/uuid-as-wordpress-guid
 * Version:      1.0
 * Author:       Gerwin Jansen
 * License:      The Unlicense
 */

add_filter( 'wp_insert_post_data', 'inject_guid_in_data', 10, 3 );
add_filter( 'wp_insert_attachment_data', 'inject_guid_in_data', 10, 3 );

/**
 * Injects a random UUID URN in the post data
 *
 * @param array $data                An array of slashed, sanitized, and processed post data.
 * @param array $postarr             An array of sanitized (and slashed) but otherwise unmodified post data.
 * @param array $unsanitized_postarr An array of slashed yet *unsanitized* and unprocessed post data as
 *                                   originally passed to wp_insert_post().
 */
function inject_guid_in_data(  $data, $postarr, $unsanitized_postarr )
{
    if( empty( $data['guid'] ) )
    {
        // because wp_generate_uuid4() uses mt_rand which relies on a random seed
        srand(random_int(PHP_INT_MIN, PHP_INT_MAX));
        $data['guid'] = wp_slash( sprintf( 'urn:uuid:%s', wp_generate_uuid4() ) );
    }
    return $data;
}
?>
