<?php
namespace dukt\social\github;

use dukt\social\services\LoginProviders;
use yii\base\Event;

/**
 * Plugin represents the GitHub integration plugin.
 *
 * @author    Dukt <support@dukt.net>
 * @since     1.0
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Event::on(LoginProviders::class, LoginProviders::EVENT_REGISTER_LOGIN_PROVIDER_TYPES, function($event): void {
            $loginProviderTypes = [
                \dukt\social\github\loginproviders\Github::class
            ];

            $event->loginProviderTypes = array_merge($event->loginProviderTypes, $loginProviderTypes);
        });
    }
}
