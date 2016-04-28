<?php
namespace Craft;

/**
 * @link      https://dukt.net/craft/github/
 * @copyright Copyright (c) 2015, Dukt
 * @license   https://dukt.net/craft/github/docs/license
 */



class GithubPlugin extends BasePlugin
{
    /**
     * Get OAuth Providers
     */
    public function getOAuthProviders()
    {
        require_once(CRAFT_PLUGINS_PATH.'oauth/providers/BaseProvider.php');
        require_once(CRAFT_PLUGINS_PATH.'github/providers/oauth/Github.php');

        return [
            'Dukt\OAuth\Providers\Github'
        ];
    }

    /**
     * Get OAuth Providers
     */
    public function getSocialLoginProviders()
    {
        require_once(CRAFT_PLUGINS_PATH.'github/providers/social/Github.php');

        return [
            'Dukt\Social\LoginProviders\Github',
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
        return '1.0.1';
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
