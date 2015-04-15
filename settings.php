<?php

if (isset($_ENV['PLATFORM_APP_DIR'])) {
  $conf['composer_manager_file_dir'] = $_ENV['PLATFORM_APP_DIR'] . '/composer';
  $conf['composer_manager_vendor_dir'] = $_ENV['PLATFORM_APP_DIR'] . '/composer/vendor';
  $conf['composer_manager_autobuild_file'] = 0;
  $conf['composer_manager_autobuild_packages'] = 0;
}

if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}
