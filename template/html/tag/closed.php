<?php

/**
 * Closed tags have no content, and use "/>" to close itself.
 *
 * For fast checking during render, it's a map of tag name => true
 */
$html->closed_tags = array_reduce([
  'area',
  'base',
  'br',
  'col',
  'embed',
  'hr',
  'img',
  'input',
  'keygen',
  'link',
  'menuitem',
  'meta',
  'param',
  'source',
  'track',
  'wbr'
], function($tags, $tag) {
  $tags[ $tag ] = true;
  return $tags;
}, []);

$html->is_closed_tag = function($tag) use ($html) {
  return isset($html->closed_tags[ $tag ]);
};

$html->add_closed_tag = function($tag, $callback, $options =[]) use ($html) {

  $html->add_open_tag($tag, $callback, $options + [ 'closed' => true ]);

  if (!isset($html->closed_tags[ $tag ])) {
    $html->closed_tags[ $tag ] = true;
  }
};

$html->get_all_closed_tag_names = function() use ($html) {

  $closed_tags = [];

  foreach ($html->tags as $tag => $tag_config) {
    if (isset($tag_config['closed']) && $tag_config['closed']) {
      $closed_tags []= $tag;
    } else if ($tag_config['local_tags']) {
      foreach ($tag_config['local_tags'] as $local_tag => $local_tag_config) {
        if (isset($local_tag_config['closed']) && $local_tag_config['closed']) {
          $closed_tags []= $local_tag;
        }
      }
    }
  }

  return $closed_tags;
};
