<?php
namespace dukt\social\github\loginproviders;

use Craft;
use dukt\social\base\LoginProvider;
use GuzzleHttp\Client;
use dukt\social\models\Token;

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
     * Returns the login provider’s OAuth provider.
     *
     * @return \League\OAuth2\Client\Provider\Github
     * @throws \yii\base\InvalidConfigException
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

    // Private Methods
    // =========================================================================

    /**
     * Returns the authenticated Guzzle client.
     *
     * @param Token $token
     *
     * @return Client
     */
    private function getClient(Token $token): Client
    {
        $headers = [];

        if ($token) {
            $headers['Authorization'] = 'Bearer '.$token->token;
        }

        $options = [
            'base_uri' => 'https://api.github.com/',
            'headers' => $headers
        ];

        return new Client($options);
    }
}
