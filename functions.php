<?php

/**
 * Functions
 * 
 * This file is part of Launchrock TagHost.
 * 
 * @package launchrock_taghost
 * @version 0.2
 * @author James Inglis <hello@jamesinglis.no>
 * @copyright (c) 2015, James Inglis
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

/**
 * Get a value from a multidimensional array
 * @global array $config
 * @global array $tag_template
 * @param string $array
 * @param type $key
 * @return type
 */
function get_value($array_name, $key)
{
    global $config;
    global $tag_template;

    switch ($array_name) {
        case 'config':
            $source_array = $config;
            break;
        case 'template':
            $source_array = $tag_template;
            break;
    }

    if (isset($source_array) && is_array($source_array)) {
        $config_path = explode("_", $key);
        $current_path = $source_array;
        foreach ($config_path as $cp) {
            if (array_key_exists($cp, $current_path)) {
                $current_path = $current_path[$cp];
            } else {
                return null;
            }
        }
        if (is_string($current_path) && strlen($current_path) === 0) {
            $current_path = null;
        }
        return $current_path;
    }
    return null;
}

/**
 * Gets a value from the config array
 * @param string $key Path to value in array
 * @return mixed
 */
function get_config($key)
{
    return get_value('config', $key);
}

/**
 * Gets a value from the template tag array
 * @param string $key
 * @return mixed
 */
function get_tag_template($key)
{
    return get_value('template', $key);
}

/**
 * Validates the Launchrock widget ID
 * @param type $launchrock_id
 * @return type
 */
function launchrock_validate($launchrock_id)
{
    $validation = '/^[A-Z0-9]{8}$/';
    return preg_match($validation, strval($launchrock_id)) !== false ? true : false;
}

/**
 * Returns Launchrock widget if widget ID is valid
 * @return string
 */
function launchrock_output()
{
    $tag_id = get_config('launchrock_id');
    $template = get_tag_template('launchrock_widget');

    if (launchrock_validate($tag_id)) {
        return str_replace('%%TAG_ID%%', $tag_id, $template);
    }
}

/**
 * Validates the Google Tag Manager container ID
 * @param string $tag_id Google Tag Manager container ID
 * @return boolean
 */
function gtm_validate($tag_id)
{
    $validation = '/^GTM\-[A-Z0-9]{6}$/';
    return preg_match($validation, strval($tag_id)) !== false ? true : false;
}

/**
 * Returns Google Tag Manager code if enabled and the container ID is valid
 * @return string
 */
function gtm_output()
{
    $enabled = get_config('gtm_enabled');
    $tag_id = get_config('gtm_container');
    $template = get_tag_template('gtm');

    if ($enabled && gtm_validate($tag_id)) {
        return str_replace('%%TAG_ID%%', $tag_id, $template);
    } else {
        return '';
    }
}

/**
 * Validates the Google Analytics property ID
 * @param string $tag_id Google Analytics property ID
 * @return boolean
 */
function ga_validate($tag_id)
{
    $validation = '/^UA\-\d{8}\-\d{1,2}$/';
    return preg_match($validation, strval($tag_id)) !== false ? true : false;
}

/**
 * Returns Google Analytics tracking code if enabled and the container ID is valid
 * @return string
 */
function ga_output()
{
    $enabled = get_config('ga_enabled');
    $tag_id = get_config('ga_id');
    switch (get_config('ga_type')) {
        case 'analytics':
            $template = get_tag_template('ga_analytics');
            break;
        case 'ga':
            $template = get_tag_template('ga_ga');
            break;
        default:
            $template = get_tag_template('ga_ga');
    }

    if ($enabled && gtm_validate($tag_id)) {
        return str_replace('%%TAG_ID%%', $tag_id, $template);
    } else {
        return '';
    }
}

/**
 * Returns Google Analytics event tracking code if Google Analytics enabled
 * @param string $type Type of tag: 'conversion' or 'remarketing
 * @return string
 */
function ga_event_output(){
    $enabled = get_config('ga_enabled');
    $event_enabled = get_config('ga_event_enabled');
    $settings = array(
        get_config('ga_event_category'),
        get_config('ga_event_action'),
        get_config('ga_event_label'),
    );
    
    switch (get_config('ga_type')) {
        case 'analytics':
            $template = get_tag_template('ga_event_analytics');
            break;
        case 'ga':
            $template = get_tag_template('ga_event_ga');
            break;
        default:
            $template = get_tag_template('ga_event_ga');
    }

    if ($enabled && $event_enabled) {
        return str_replace(array('%%EVENT_CATEGORY%%', '%%EVENT_ACTION%%', '%%EVENT_LABEL%%'), $settings, $template);
    } else {
        return '';
    }
}

/**
 * Validates the Facebook advertising pixel ID
 * @param string $tag_id AdWords tag ID
 * @return boolean
 */
function fb_validate($tag_id)
{
    $validation = '/^\d{12,16}$/';
    return preg_match($validation, strval($tag_id)) !== false ? true : false;
}

/**
 * Returns Facebook Advertising pixel code if enabled and the pixel ID is valid
 * @param string $type Type of tag: 'conversion' or 'remarketing
 * @return string
 */
function fb_output($type)
{
    $enabled = false;
    $settings = array();

    switch ($type) {
        case 'conversion':
            $enabled = get_config('facebook_conversion_enabled');
            $tag_id = get_config('facebook_conversion_pixelid');
            $settings = array(
                get_config('facebook_conversion_currency'),
                get_config('facebook_conversion_amount')
            );
            $template = get_tag_template('facebook_conversion');
            break;
        case 'remarketing':
            $enabled = get_config('facebook_remarketing_enabled');
            $tag_id = get_config('facebook_remarketing_pixelid');
            $template = get_tag_template('facebook_remarketing');
            break;
    }

    array_unshift($settings, $tag_id);

    if ($enabled && fb_validate($tag_id)) {
        return str_replace(array('%%TAG_ID%%', '%%TAG_CURRENCY%%', '%%TAG_AMOUNT%%'), $settings, $template);
    } else {
        return '';
    }
}

/**
 * Validates the AdWords conversion code ID
 * @param string $tag_id AdWords tag ID
 * @return boolean
 */
function adwords_validate($tag_id)
{
    $validation = '/^\d{8,10}$/';
    return preg_match($validation, strval($tag_id)) !== false ? true : false;
}

/**
 * Returns AdWords conversion code if enabled and the conversion ID is valid
 * @param string $type Type of tag: 'conversion' or 'remarketing
 * @return string
 */
function adwords_output($type)
{
    $enabled = false;
    $settings = array();

    switch ($type) {
        case 'conversion':
            $enabled = get_config('adwords_conversion_enabled');
            $tag_id = get_config('adwords_conversion_id');
            $settings = array(
                get_config('adwords_conversion_label'),
                get_config('adwords_conversion_currency'),
                get_config('adwords_conversion_amount')
            );
            $template = get_tag_template('adwords_conversion');
            break;
        case 'remarketing':
            $enabled = get_config('adwords_remarketing_enabled');
            $tag_id = get_config('adwords_remarketing_id');
            $template = get_tag_template('adwords_remarketing');
            break;
    }

    array_unshift($settings, $tag_id);

    if ($enabled && adwords_validate($tag_id)) {
        return str_replace(array('%%TAG_ID%%', '%%TAG_LABEL%%', '%%TAG_CURRENCY%%', '%%TAG_AMOUNT%%'), $settings, $template);
    } else {
        return '';
    }
}

/**
 * Returns Javascript functions to be triggered by Launchrock
 * @return string
 */
function launchrock_submit(){
    return get_tag_template('launchrock_submit');   
}
