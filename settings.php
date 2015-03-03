<?php

$db_url = 'mysql://database.internal/main';
$db_prefix = '';

$local_settings = dirname(__FILE__) . '/settings.local-d6.php';
if (file_exists($local_settings)) {
  require_once($local_settings);
}
