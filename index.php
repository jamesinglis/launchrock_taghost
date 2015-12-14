<?php

/**
 * TagHost main page
 *
 * This file is part of Launchrock TagHost.
 *
 * @package launchrock_taghost
 * @version 0.4
 * @author James Inglis <hello@jamesinglis.no>
 * @copyright (c) 2015, James Inglis
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */
require_once 'config.php';
require_once 'tag-templates.php';
require_once 'functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= get_config("page_title"); ?></title>
        <meta property="og:title" content="<?= get_config("page_title"); ?>" />
        <meta property="og:type" content="company" />
        <meta property="og:site_name" content="<?= get_config("page_title"); ?>" />
        <meta property="og:description" content="<?= get_config("page_description"); ?>" />
        <meta property="og:url" content="<?= get_config("page_url"); ?>" />
        <meta property="og:image" content="<?= get_config("page_image"); ?>" />

        <style type="text/css">
            body {
                background-color: <?= get_config("page_bgcolor"); ?>;
                color: <?= get_config("page_color"); ?>;
            }
        </style>

        <?= ga_output(); ?>
        <?= ga_event_output(); ?>

        <script type="text/javascript">
            <?= get_config("gtm_datalayer"); ?> = (typeof <?= get_config("gtm_datalayer"); ?> !== 'undefined') ? <?= get_config("gtm_datalayer"); ?> : [];
            var _control = {
                gtm: <?= get_config("gtm_enabled") === true ? 'true' : 'false'; ?>,
                gtm_datalayer: '<?= get_config("gtm_datalayer"); ?>',
                gtm_event_success: '<?= get_config("gtm_submit_event"); ?>',
                gtm_event_email_share: '<?= get_config("gtm_email_event"); ?>',
                ga: <?= get_config("ga_enabled") === true ? 'true' : 'false'; ?>,
                ga_type: '<?= get_config("ga_type"); ?>',
                ga_event: <?= get_config("ga_event_enabled") === true ? 'true' : 'false'; ?>,
                adwords_conversion: <?= get_config("adwords_conversion_enabled") === true ? 'true' : 'false'; ?>,
                facebook_conversion: <?= get_config("facebook_conversion_enabled") === true ? 'true' : 'false'; ?>,
                fix_widget_styles: <?= get_config("launchrock_fixwidgetstyles") === true ? 'true' : 'false'; ?>,
                logging: <?= get_config("logging_enabled") === true ? 'true' : 'false'; ?>,
                nonce: '<?= NonceUtil::generate(get_config("logging_nonce"), 1800); ?>',
            };
        </script>
    </head>
    <body>
        <?= gtm_output(); ?>
        <?= launchrock_output(); ?>
        <?= adwords_output('conversion'); ?>
        <?= adwords_output('remarketing'); ?>
        <?= fb_output('conversion'); ?>
        <?= fb_output('remarketing'); ?>
        <?= logging_output(); ?>
        <?= launchrock_submit(); ?>
    </body>
</html>