<?php

namespace Craft;

require_once(CRAFT_PLUGINS_PATH.'github/vendor/autoload.php');

class GithubPlugin extends BasePlugin
{
    /**
     * Get Social Gateways
     */
    public function getSocialGateways()
    {
        return [
            'Dukt\Github\Social\Gateway\Github'
        ];
    }

    /**
     * Get Name
     */
    function getName()
    {
        return Craft::t('GitHub');
    }

    /**
     * Get Version
     */
    function getVersion()
    {
        return '1.0.0';
    }

    /**
     * Get Developer
     */
    function getDeveloper()
    {
        return 'Dukt';
    }

    /**
     * Get Developer URL
     */
    function getDeveloperUrl()
    {
        return 'http://dukt.net/';
    }
}
