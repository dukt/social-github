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
    public function getDefaultScope()
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
     * @inheritdoc
     */
    public function getProfile(Token $token)
	{
		$remoteProfile = $this->getRemoteProfile($token);
		$remoteProfileArray = $remoteProfile->toArray();

        $email = (isset($remoteProfileArray['email']) ? $remoteProfileArray['email'] : $this->getRemoteEmail($token));
        $photoUrl = (isset($remoteProfileArray['avatar_url']) ? $remoteProfileArray['avatar_url'] : null);

		return [
			'id' => $remoteProfile->getId(),
			'email' => $email,
			'photoUrl' => $photoUrl,

			'name' => $remoteProfile->getName(),
		];
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

        return new \League\OAuth2\Client\Provider\Github($config);
    }

    // Private Methods
    // =========================================================================

    private function getRemoteEmail(Token $token)
    {
        $client = $this->getClient($token);

        $response = $client->request('GET', 'user/emails');
        $data = json_decode($response->getBody(), true);

        if (is_array($data))
        {
            foreach ($data as $email)
            {
                if (isset($email['primary']) && $email['primary'])
                {
                    return $email['email'];
                }
            }
        }
    }

    /**
     * Returns the authenticated Guzzle client.
     *
     * @param Token $token
     *
     * @return Client
     */
    private function getClient(Token $token)
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
