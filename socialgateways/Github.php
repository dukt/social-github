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
        return [
            'user'
        ];
    }

	/**
	 * Get Profile
	 */
    public function getProfile()
    {
        $response = $this->api('get', 'user');

        return [
            'id' => $response['id'],
            'email' => $response['email'],
            'username' => $response['login'],
            'photo' => $response['avatar_url'],
            'fullName' => $response['name'],
            'profileUrl' => $response['html_url'],
            'location' => $response['location'],
            'company' => $response['company'],
        ];
    }

    private function api($method = 'get', $uri, $params = null, $headers = null, $postFields = null)
    {
        // client
        $client = new Client('https://api.github.com/');

        //token
        $token = $this->token;

        // params
        $params['access_token'] = $token->accessToken;


        // request

        $query = '';

        if($params)
        {
            $query = http_build_query($params);

            if($query)
            {
                $query = '?'.$query;
            }
        }

        $url = $uri.$query;

        $response = $client->get($url, $headers, $postFields)->send();

        $response = $response->json();

        return $response;
    }
}
