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
}
