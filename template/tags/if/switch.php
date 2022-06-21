<?php

/**
 * <Switch> and <When>
 *
 * Shortcut to generate a series of If/Else conditions
 */

$html->add_open_tag('Switch', function( $atts, $nodes ) use ( $html ) {

  // <Switch debug .. /> to see converted If/Else statements

  $debug = false;

  if ( ( $index = array_search( 'debug', $atts['keys'] ) ) !== false ) {
    unset( $atts['keys'][ $index ] );
    $atts['keys'] = array_values( $atts['keys'] );
    $debug        = true;
  }

  $if_node = [
    'tag'        => 'If',
    'attributes' => $atts,
    'children'   => [],
  ];

  $when_count = 0;

  foreach ( $nodes as $node_index => $node ) {

    if ( ! isset( $node['tag'] ) || $node['tag'] !== 'When' ) {
      $if_node['children'] [] = $node;
      continue;
    }

    $when_count++;

    // First instance of When becomes an If tag

    if ( $when_count === 1 ) {

      // Merge attributes to If

      $else_keys = $node['attributes']['keys'];

      $if_node['attributes']         = array_merge( $atts, $node['attributes'] );
      $if_node['attributes']['keys'] = array_merge( $atts['keys'], $else_keys );

      continue;
    }

    // Subsequent instances of When are converted to Else

    $node['tag'] = 'Else';

    $has_no_attributes = empty( $node['attributes']['keys'] ) // No attribute values
      && count( array_keys( $node['attributes'] ) ) === 1; // Only "keys", no other attribute keys

    if ( $has_no_attributes ) {

      // <When /> with no attributes covers default condition

    } else {

      // Otherwise, convert to <Else if .. />

      // Merge Switch and When attributes

      $else_keys = $node['attributes']['keys'];

      $node['attributes']         = array_merge( $atts, $node['attributes'] );
      $node['attributes']['keys'] = array_merge( $node['attributes']['keys'], $else_keys );

      array_unshift( $node['attributes']['keys'], 'If' );
    }

    $if_node['children'] [] = $node;
  }

  if ( $debug ) {
    tangible()->see( 'Switch converted to:', $html->render_raw( $if_node ) );
  }

  return $html->render( $if_node );
});
