window.lrignition.themesJS.customTheme = function () {
    /* DO NOT MODIFY ABOVE THIS LINE UNLESS YOU KNOW WHAT YOU ARE DOING */
    this.init.push(function () {
        /* Your code here to run on initialization */
        jQuery(".LR-sign-up-submit").click(function () {
            if(typeof(window['_control'].gtm) !== 'undefined' && window['_control'].gtm === true){
                window[window['_control'].gtm_datalayer].push({'event':window['_control'].gtm_event_success});
            }
            if(typeof(window['_control'].ga_event) !== 'undefined' && window['_control'].ga_event === true){
                window.gaEventExecute();
            }
            if(typeof(window['_control'].adwords_conversion) !== 'undefined' && window['_control'].adwords_conversion === true){
                window.adwordsConversion();
            }
            if(typeof(window['_control'].facebook_conversion) !== 'undefined' && window['_control'].facebook_conversion === true){
                window.facebookConversion();
            }
            
        });
    });
    // Uncomment to override default mode set behavior
    /*
     this.setMode = function( ignition, mode ) {
     var container = ignition.getContainer(); // jQuery
     if( mode === "main" ) {
     container.find( ".LR-content" ).removeClass( "LR-sharing-page" );
     container.find( ".LR-site-share" ).hide();
     container.find( ".LR-sign-up-container" ).show();
     } else if( mode === "postsignup" ) {
     container.find( ".LR-content" ).addClass( "LR-sharing-page" );
     container.find( ".LR-sign-up-container" ).hide();
     container.find( ".LR-site-share" ).show();
     }
     };
     */
    /* DO NOT MODIFY BELOW THIS LINE UNLESS YOU KNOW WHAT YOU ARE DOING */
};
window.lrignition.themesJS.customTheme.prototype = new (window.lrignition.themesJS.classic || window.lrignition.themesJS.common)("customTheme");