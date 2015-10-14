<?php
namespace Craft;

/**
 * @link      https://dukt.net/craft/github/
 * @copyright Copyright (c) 2015, Dukt
 * @license   https://dukt.net/craft/github/docs/license
 */

require_once(CRAFT_PLUGINS_PATH.'github/socialgateways/Github.php');

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
        return 'https://dukt.net/';
    }
}
