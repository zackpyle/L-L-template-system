<?php
namespace Tangible\TemplateSystem;

use Tangible\TemplateSystem as system;

system::$state->admin_route_info = null;

function get_admin_route_info() {

  // Cached
  if (!empty(system::$state->admin_route_info)) {
    return system::$state->admin_route_info;
  }

  global $pagenow;

  $info = [
    'type'  => '',
    'edit' => false,
    'new' => false,
    'single' => false,
    'archive' => false,
  ];

  if ('post.php' == $pagenow && !empty($_GET['post'])) {

    // Edit single post

    $this_post = get_post($_GET['post']);

    if (!empty($this_post)) {
      $info['type'] = $this_post->post_type;
      $info['edit'] = true;
      $info['single'] = true;
    }

  } elseif ('post-new.php' == $pagenow && !empty($_GET['post_type'])) {

    // New post

    $info['type'] = $_GET['post_type'];
    $info['edit'] = true;
    $info['single'] = true;
    $info['new'] = true;

  } elseif ('edit.php' == $pagenow && !empty($_GET['post_type'])) {

    // Archive

    $info['type'] = $_GET['post_type'];
    $info['archive'] = true;
  }

  return system::$state->admin_route_info = $info;
};
