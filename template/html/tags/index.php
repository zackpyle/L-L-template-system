<?php

/**
 * Built-in tags
 */

// $html->add_raw_tag('cdata', function($atts, $content) use ($html) {
//   return "<![CDATA[$content]]>";
// });

$html->add_raw_tag('code', function($atts, $content) use ($html) {

  if (isset($atts['keys'][0]) && $atts['keys'][0]==='render') {
    $content = $html->render($content);
  }

  // Escaped PHP tags
  $content = str_replace(
    ['&amp;lt;?php', '&amp;lt;?='],
    ['&lt;?php', '&lt;?='],
    $content
  );

  return $html->render_raw_tag('code', $atts, $content);
});

$html->add_raw_tag('Raw', function($atts, $content) use ($html) {
  return $content;
});
