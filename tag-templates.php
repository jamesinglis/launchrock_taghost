<?php

/**
 * Tag Templates
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
 * Tag variables used:
 * - %%TAG_ID%% - Standard ID used across most types of tag/include
 * - %%EVENT_CATEGORY%% - Used in Google Analytics Events
 * - %%EVENT_ACTION%% - Used in Google Analytics Events
 * - %%EVENT_LABEL%% - Used in Google Analytics Events
 * - %%TAG_LABEL%% - Used in Google AdWords Conversions
 * - %%TAG_CURRENCY%% - Used in Google AdWords Conversions and Facebook Ads Conversions
 * - %%TAG_AMOUNT%% - Used in Google AdWords Conversions and Facebook Ads Conversions
 */

$tag_template['launchrock']['widget'] = <<<EOD
<!-- Begin LaunchRock Widget -->
<div id="lr-widget" rel="%%TAG_ID%%"></div>
<script type="text/javascript" src="//ignition.launchrock.com/ignition-current.min.js"></script>
<!-- End LaunchRock Widget -->
        
EOD;


$tag_template['launchrock']['submit'] = <<<EOD
<script type="text/javascript">
    function launchrockTagHost() {
        // Adds click handlers to the Launchrock elements
        jQuery('body')
                .on('click', '.LR-sign-up-submit', function () {
                    if (typeof launchrockTagSubmit === 'function') {
                        launchrockTagSubmit();
                    }
                })
                .on('click', '.LR-share-email-send', function () {
                    if (typeof launchrockTagEmailShare === 'function') {
                        launchrockTagEmailShare();
                    }
                });

        // If enabled, detects relative URIs from Launchrock (which will fail!) and converts them to absolute
        if (typeof (window['_control'].fix_widget_styles) !== 'undefined' && window['_control'].fix_widget_styles === true) {
            jQuery('link[rel=stylesheet]').each(function (index, element) {
                var relativeURIRegEx = /^\/themes\//;
                var existingHref = jQuery(this).attr('href');
                if (relativeURIRegEx.test(existingHref)) {
                    jQuery(this).attr('href', '//ignition.launchrock.com' + existingHref);
                }
            });
        }
    }

    function launchrockTagSubmit() {
        if (typeof (window['_control'].gtm) !== 'undefined' && window['_control'].gtm === true) {
            window[window['_control'].gtm_datalayer].push({'event': window['_control'].gtm_event_success});
        }
        if (typeof (window['_control'].ga_event) !== 'undefined' && window['_control'].ga_event === true) {
            window.gaEventExecute();
        }
        if (typeof (window['_control'].adwords_conversion) !== 'undefined' && window['_control'].adwords_conversion === true) {
            window.adwordsConversion();
        }
        if (typeof (window['_control'].facebook_conversion) !== 'undefined' && window['_control'].facebook_conversion === true) {
            window.facebookConversion();
        }
    }

    function launchrockTagEmailShare() {
        if (typeof (window['_control'].gtm) !== 'undefined' && window['_control'].gtm === true) {
            window[window['_control'].gtm_datalayer].push({'event': window['_control'].gtm_event_email_share});
        }
    }
</script>
        
EOD;


$tag_template['gtm'] = <<<EOD
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=%%TAG_ID%%"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','%%TAG_ID%%');</script>
<!-- End Google Tag Manager -->
        
EOD;


$tag_template['ga']['analytics'] = <<<EOD
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '%%TAG_ID%%', 'auto');
  ga('send', 'pageview');
</script>
        
EOD;


$tag_template['ga']['ga'] = <<<EOD
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '%%TAG_ID%%']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
        
EOD;


$tag_template['ga']['event']['analytics'] = <<<EOD
<script type="text/javascript">
    function gaEventExecute() {
        ga('send', 'event', '%%EVENT_CATEGORY%%', '%%EVENT_ACTION%%', '%%EVENT_LABEL%%');
    };   
</script>
        
EOD;


$tag_template['ga']['event']['ga'] = <<<EOD
<script type="text/javascript">
    function gaEventExecute() {
        console.log('event logged');
        _gaq.push(['_trackEvent', '%%EVENT_CATEGORY%%', '%%EVENT_ACTION%%', '%%EVENT_LABEL%%']);
    };   
</script>
        
EOD;


$tag_template['adwords']['conversion'] = <<<EOD
<script type="text/javascript">
  function adwordsConversion() {
    var img = document.createElement('img'); img.height = '1'; img.width = '1'; img.style = 'border-style:none;';
    img.src = '//www.googleadservices.com/pagead/conversion/%%TAG_ID%%/?value=%%TAG_AMOUNT%%&currency_code=%%TAG_CURRENCY%%&label=%%TAG_LABEL%%&guid=ON&script=0';
    var s = document.getElementsByTagName('div')[0]; s.parentNode.insertBefore(img, s.nextSibling);
  };   
</script>
        
EOD;


$tag_template['adwords']['remarketing'] = <<<EOD
<!-- Google Code for Remarketing Tag -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = %%TAG_ID%%;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/%%TAG_ID%%/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

EOD;


$tag_template['facebook']['conversion'] = <<<EOD
<!-- Facebook Conversion Code -->
<script type="text/javascript">
    function facebookConversion() {
        var img = document.createElement('img'); img.height = '1'; img.width = '1'; img.style = 'display:none;';
        img.src = 'https://www.facebook.com/tr?ev=%%TAG_ID%%&amp;cd[value]=%%TAG_AMOUNT%%&amp;cd[currency]=%%TAG_CURRENCY%%&amp;noscript=1';
        var s = document.getElementsByTagName('div')[0]; s.parentNode.insertBefore(img, s.nextSibling);
    };   
</script>
        
EOD;


$tag_template['facebook']['remarketing'] = <<<EOD
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '%%TAG_ID%%']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=%%TAG_ID%%&amp;ev=PixelInitialized" /></noscript>
EOD;
