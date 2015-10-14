<?php
namespace Dukt\Github\Social\Gateway;

/**
 * @link      https://dukt.net/craft/github/
 * @copyright Copyright (c) 2015, Dukt
 * @license   https://dukt.net/craft/github/docs/license
 */

use Craft\UrlHelper;
use Dukt\Social\Gateway\BaseGateway;
use Guzzle\Http\Client;

class Github extends BaseGateway
{
    // Public Methods
    // =========================================================================

	/**
	 * Get Name
	 */
	public function getName()
    {
        return "GitHub";
    }

	/**
	 * Get Icon URL
	 */
    public function getIconUrl()
    {
        return UrlHelper::getResourceUrl('github/svg/github.svg');
    }

	/**
	 * Get Scopes
	 */
    public function getScopes()
    {
        return array(
            'user, repo',
        );
    }

	/**
	 * Get Profile
	 */
    public function getProfile()
    {
        $response = $this->api('get', 'user');

        return array(
            'id' => $response['id'],
            'email' => $response['email'],
            'username' => $response['login'],
            'photo' => $response['avatar_url'],
            'fullName' => $response['name'],
            'profileUrl' => $response['html_url'],
            'location' => $response['location'],
            'company' => $response['company'],
        );
    }
}
