<?php
/**
 * Configuration overrides for WP_ENVIRONMENT_TYPE === 'production'
 */

use Roots\WPConfig\Config;
use function Env\env;

Config::define('FORCE_SSL_ADMIN', true);