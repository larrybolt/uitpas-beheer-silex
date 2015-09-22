<?php
/**
 * @file
 */

namespace CultuurNet\UiTPASBeheer\CheckInDevice;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class CheckInDeviceControllerProvider implements ControllerProviderInterface
{
    /**
     * @inheritdoc
     */
    public function connect(Application $app)
    {
        $app['check_in_device_controller'] = $app->share(
            function (Application $app) {
                return new CheckInDeviceController(
                    $app['check_in_device_service']
                );
            }
        );

        /* @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/checkindevices', 'check_in_device_controller:all');

        $controllers->patch(
            '/checkindevices/{checkInDeviceId}',
            'check_in_device_controller:connectDeviceToActivity'
        );

        return $controllers;
    }
}
