<?php

namespace Craft;

class SocialGithubPlugin extends BasePlugin
{
    /**
     * Initializes the application component.
     *
     * @return null
     */
    public function init()
    {
        require_once(CRAFT_PLUGINS_PATH.'socialgithub/vendor/autoload.php');
    }

    /**
     * Get Social Login Providers
     */
    public function getSocialLoginProviders()
    {
        require_once(CRAFT_PLUGINS_PATH.'socialgithub/providers/social/Github.php');

        return [
            'Dukt\Social\LoginProviders\Github',
        ];
    }

    /**
     * Get Name
     */
    public function getName()
    {
        return Craft::t('Social GitHub');
    }

    /**
     * Get Name
     */
    public function getDescription()
    {
        return Craft::t('GitHub integration for Social.');
    }

    /**
     * Get Version
     */
    public function getVersion()
    {
        return '2.1.0';
    }

    /**
     * Get Developer
     */
    public function getDeveloper()
    {
        return 'Dukt';
    }

    /**
     * Get Developer URL
     */
    public function getDeveloperUrl()
    {
        return 'https://dukt.net/';
    }

    /**
     * Get release feed URL
     */
    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/dukt/social-github/v2/releases.json';
    }
}
