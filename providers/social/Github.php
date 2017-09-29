<?php

namespace Dukt\Social\LoginProviders;

use Guzzle\Http\Client;
use Craft\Oauth_TokenModel;

class Github extends BaseProvider
{
    public function getName()
    {
        return 'GitHub';
    }

    public function getOauthProviderHandle()
    {
        return 'github';
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

    public function getProfile(Oauth_TokenModel $token)
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

    private function getRemoteEmail($token)
    {
        $oauthProvider = $this->getOauthProvider();

        $client = new Client('https://api.github.com');
        $client->addSubscriber($oauthProvider->getSubscriber($token));

        $request = $client->get('/user/emails');

        $response = $request->send();
        $emails = $response->json();

        if (is_array($emails))
        {
            foreach ($emails as $email)
            {
                if (isset($email['primary']) && $email['primary'])
                {
                    return $email['email'];
                }
            }
        }
    }
}
