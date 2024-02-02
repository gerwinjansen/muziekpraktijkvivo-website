<?php
/**
 * Plugin Name:  wp-option from constant
 * Description:  Intercepts reads from the wp-options table and returns the corresponding WP_OPTION_<NAME> constant if available.
 * Version:      1.0
 * Author:       Gerwin Jansen
 * License:      The Unlicense
 */

define("OPTION_PREFIX", "WP_OPTION_");

foreach (get_defined_constants() as $constantName=>$value) {
    if(str_starts_with($constantName, OPTION_PREFIX)) {
        $optionName = substr($constantName, strlen(OPTION_PREFIX));
        add_filter("default_option_$optionName", valueCallback($value));
        add_filter("option_$optionName", valueCallback($value));
    }
}

function valueCallback($value) : Closure {
    return function() use ($value) : mixed {
        return $value;
    };
}
?>
