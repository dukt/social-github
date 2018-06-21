<?php

namespace dukt\social\github\loginproviders;

use Craft;
use dukt\social\base\LoginProvider;

/**
 * Github represents the Github gateway
 *
 * @author    Dukt <support@dukt.net>
 * @since     1.0
 */
class Github extends LoginProvider
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'GitHub';
    }

    /**
     * @inheritdoc
     */
    public function getIconUrl()
    {
        return Craft::$app->assetManager->getPublishedUrl('@dukt/social/github/icon.svg', true);
    }

    /**
     * @inheritDoc
     */
    public function getDefaultOauthScope(): array
    {
        return [
            'user:email'
        ];
    }

    /**
     * @inheritdoc
     */
    public function getManagerUrl()
    {
        return 'https://github.com/settings/developers';
    }

    /**
     * @inheritdoc
     */
    public function getScopeDocsUrl()
    {
        return 'https://developer.github.com/v3/oauth/#scopes';
    }

    /**
     * @inheritDoc
     */
    public function getOauthProvider(): \League\OAuth2\Client\Provider\Github
    {
        $config = $this->getOauthProviderConfig();

        return new \League\OAuth2\Client\Provider\Github($config['options']);
    }

    /**
     * @inheritdoc
     */
    public function getDefaultUserFieldMapping(): array
    {
        return [
            'id' => '{{ profile.getId() }}',
            'email' => '{{ profile.getEmail() }}',
            'username' => '{{ profile.getEmail() }}',
            'photo' => '{{ profile.toArray().avatar_url }}',
        ];
    }
}
