# Launchrock TagHost
James Inglis [hello@jamesinglis.no](mailto:hello@jamesinglis.no)

## Overview
Launchrock is a popular SAAS lead generation platform with some unique referal features popular with marketers. The platform has Google Analytics ('Classic Analytics') tracking built into it, but nothing else; however the kind of marketers that strategically run lead generation campaigns typically want to track performance of these campigns using Google Tag Manager, Google Analytics, Google AdWords and Facebook Ads.

This is a very simple PHP application designed to make deployment of Launchrock landing pages with marketing tags extremely easy. For marketers using Google Tag Manager, you enter your container ID and the rest can be done in GTM. For marketers not using Google Tag Manager, you can configure Google Analytics (both Classic and Universal), Google AdWords remarketing and conversions and Facebook Ads remarketing and conversions.

##Features

###Supported Tags
- Google Tag Manager
  - Inclusion of standard tag container
  - Support for custom data layer global variable
  - Firing of a configurable custom event upon submit (to create a *Rule* in GTM to trigger other tags)
  - Firing of a configurable custom event upon email share (to create a *Rule* in GTM to trigger other tags)
- Google Analytics
  - Choice of Classic Analytics or Universal Analytics
  - Optional firing of a configurable event upon submit
- Google AdWords
  - Both conversion and remarketing tags
  - Remarketing triggers on page load, conversion triggers on submit
- Facebook Advertising
  - Both conversion and remarketing tags
  - Remarketing triggers on page load, conversion triggers on submit

###Other Features
- Change color and background color of base page from config, to avoid ugly splash of color while loading the Launchrock widget.
- Change title and meta tags for use in Open Graph tags (as recommendeded in the *Domain* section of the Launchrock page editor)

##Installation
1. Set up your Launchrock landing page as a *widget* rather than a *page*. 
2. Obtain the page ID from the *Domain* section of the page settings.
3. Make sure that the Google Analytics ID under *Advanced Settings* is left blank.
4. Prepare your hosting environment and place all of the files into the web root of your web server.
5. Copy config-example.php to config.php in the same directory. (Failure to do this will cause the application to fail!)
6. Add the page ID obtained in step 1 to line 16 of the config.php file, in $config['launchrock']['id'].
7. Enable and configure the marketing tags that you wish to enable in config.php.
8. In the Launchrock page editor interface, click the *Advanced Code Editor* button at the bottom-right of the page.
9. Copy the contents of launchrock.js into the Javascript panel of the Advanced Code Editor.
  - This code is intended to completed replace what is there already. This will *erase* any existing customizations.
10. Click *Apply Changes* and then *Launch Widget*.
  - From experience, it takes about 5-10 minutes for changes to go live.

##Tech Notes
- Tested using PHP 5.4.14
- The only reliance on jQuery is in the code added to Launchrock.
- Tag Templates sourced directly from respective platform documentation on 2015-01-02.
- If you want to configure multiple conversion tags for AdWords of Facebook Ads, you will need to do this using a Google Tag Manager implementation.
- Feedback welcome!

##Changelog
Version 0.2 (2015-01-09)
- Changes (minimises) the code required for addition to Launchrock
- Adds dataLayer event for email share (Google Tag Manager only)

Version 0.1 (2015-01-02)
- Initial release