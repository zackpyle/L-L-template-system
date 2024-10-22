<?php
/**
 * Plugin Name: Tangible Template System
 * Description: Template system shared by Tangible Blocks and Loops & Logic
 * Version: 2024.10.20
 * GitHub URI: TangibleInc/template-system
 */
use tangible\framework;
use tangible\updater;

define('TANGIBLE_TEMPLATE_SYSTEM_IS_PLUGIN', true);

// require_once __DIR__ . '/vendor/tangible/framework/index.php';
require_once __DIR__ . '/vendor/tangible/updater/index.php';
require_once __DIR__ . '/index.php';

add_action('plugins_loaded', function() {
  updater\register_plugin([
    'name' => 'tangible-template-system',
    'file' => __FILE__,    
  ]);
});
