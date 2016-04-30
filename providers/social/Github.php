<?php
/**
 * @link      https://dukt.net/craft/oauth/
 * @copyright Copyright (c) 2015, Dukt
 * @license   https://dukt.net/craft/oauth/docs/license
 */

namespace Dukt\Social\LoginProviders;

use Craft\Craft;

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

	public function getProfile($token)
	{
		$remoteProfile = $this->getRemoteProfile($token);
		$remoteProfileArray = $remoteProfile->toArray();

		$photoUrl = null;

		if(isset($remoteProfileArray['avatar_url']))
		{
			$photoUrl = $remoteProfileArray['avatar_url'];
		}

		return [
			'id' => $remoteProfile->getId(),
			'email' => $remoteProfile->getEmail(),
			'photoUrl' => $photoUrl,

			'name' => $remoteProfile->getName(),
		];
	}
}
