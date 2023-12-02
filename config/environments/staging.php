<?php
/**
 * Configuration overrides for WP_ENVIRONMENT_TYPE === 'staging'
 */

use Roots\WPConfig\Config;
use function Env\env;

Config::define('FORCE_SSL_ADMIN', true);