api = 2

core = 6.x

projects[drupal][type] = core
projects[drupal][version] = "6.35"
projects[drupal][patch][] = "https://www.drupal.org/files/issues/d6-db_url_empty_user-2444923-1.patch"
projects[drupal][patch][] = "patches/d6-install_redirect_on_empty_database-728702.patch"
projects[drupal][patch][] = "patches/d6-clean_urls_non_apache.patch"
