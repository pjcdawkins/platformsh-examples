<?php
/**
 * @file
 * Platform.sh example settings.php file for Drupal 8.
 */

// Install with the 'standard' profile for this example.
$settings['install_profile'] = 'standard';

/**
 * Default Drupal 8 settings.
 *
 * These are already explained with detailed comments in Drupal's
 * default.settings.php file.
 *
 * See https://api.drupal.org/api/drupal/sites!default!default.settings.php/8
 */
$databases = array();
$config_directories = array();
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = __DIR__ . '/services.yml';

// Override paths for config files in Platform.sh.
if (isset($_ENV['PLATFORM_APP_DIR'])) {
  $config_directories = array(
    CONFIG_ACTIVE_DIRECTORY => $_ENV['PLATFORM_APP_DIR'] . '/config/active',
    CONFIG_STAGING_DIRECTORY => $_ENV['PLATFORM_APP_DIR'] . '/config/staging',
  );
}

// Set trusted hosts based on real Platform.sh routes.
if (isset($_ENV['PLATFORM_ROUTES'])) {
  $routes = json_decode(base64_decode($_ENV['PLATFORM_ROUTES']), TRUE);
  $settings['trusted_host_patterns'] = array();
  foreach ($routes as $url => $route) {
    $host = parse_url($url, PHP_URL_HOST);
    if ($host !== FALSE && $route['type'] == 'upstream' && $route['upstream'] == $_ENV['PLATFORM_APPLICATION_NAME']) {
      $settings['trusted_host_patterns'][] = '^' . preg_quote($host) . '$';
    }
  }
  $settings['trusted_host_patterns'] = array_unique($settings['trusted_host_patterns']);
}

// Populate $settings based on Platform.sh variables.
if (isset($_ENV['PLATFORM_VARIABLES'])) {
  $variables = json_decode(base64_decode($_ENV['PLATFORM_VARIABLES']), TRUE);
  $prefix_len = strlen('drupal:');
  foreach ($variables as $name => $value) {
    if (substr($name, 0, $prefix_len) == 'drupal:') {
      $settings[substr($name, $prefix_len)] = $value;
    }
  }
}

// Local settings. These are required for Platform.sh.
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}
