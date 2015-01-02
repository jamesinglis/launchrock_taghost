<?php

/**
 * Configuration {Example}
 * 
 * All configuration for the application
 * 
 * This file is part of Launchrock TagHost.
 * 
 * @package launchrock_taghost
 * @version 0.1
 * @author James Inglis <hello@jamesinglis.no>
 * @copyright (c) 2015, James Inglis
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

$config['launchrock']['id']                   = ''; // ID for the Launchrock widget

/**
 * Base page configuration
 * 
 * Most of these values will be copied from Launchrock itself
 */
$config['page']['title']                      = ''; // Title is used in multiple places
$config['page']['description']                = ''; // This description is only used in the Open Graph tags
$config['page']['image']                      = ''; // This image is only used in the Open Graph tags
$config['page']['bgcolor']                    = '#FFFFFF'; // To avoid a flash of white before loading the full screen widget
$config['page']['color']                      = '#000000';

/**
 * Google Tag Manager configuration
 * 
 * If GTM is enabled, you would usually disable all of the other tags and set 
 * these up through GTM.
 */
$config['gtm']['enabled']                     = false;
$config['gtm']['container']                   = '';
$config['gtm']['datalayer']                   = 'dataLayer'; // Name for the datalayer, just in case it needs to be changed
$config['gtm']['event']                       = 'expression-of-interest-success'; // This event is triggered in the dataLayer when the form is submitted.

/**
 * Google Analytics configuration
 */
$config['ga']['enabled']                      = false;
$config['ga']['id']                           = '';
$config['ga']['type']                         = 'analytics'; // Choose either 'analytics' (Universal Analytics) or 'ga' (Classic Analytics)
$config['ga']['event']['enabled']             = false; // 
$config['ga']['event']['category']            = 'Form'; // 
$config['ga']['event']['action']              = 'Submission'; // 
$config['ga']['event']['label']               = 'Expression of Interest'; //

/**
 * Facebook Ads - Remarketing configuration
 */
$config['facebook']['remarketing']['enabled'] = false;
$config['facebook']['remarketing']['pixelid'] = '';

/**
 * Facebook Ads - Conversion configuration
 */
$config['facebook']['conversion']['enabled']  = false;
$config['facebook']['conversion']['pixelid']  = '';
$config['facebook']['conversion']['currency'] = 'USD';
$config['facebook']['conversion']['amount']   = '0.00'; // This amount is pushed through to Facebook as the value of the conversion.

/**
 * Google AdWords - Remarketing configuration
 */
$config['adwords']['remarketing']['enabled']  = false;
$config['adwords']['remarketing']['id']       = '';

/**
 * Google AdWords - Conversion configuration
 */
$config['adwords']['conversion']['enabled']   = false;
$config['adwords']['conversion']['id']        = '';
$config['adwords']['conversion']['label']     = '';
$config['adwords']['conversion']['currency']  = 'USD';
$config['adwords']['conversion']['amount']    = '0.00'; // This amount is pushed through to AdWords as the value of the conversion.
