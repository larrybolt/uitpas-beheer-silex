<?php

namespace CultuurNet\UiTPASBeheer\Exception;

use CultuurNet\UiTPASBeheer\Response\JsonErrorResponse;
use Silex\Application;
use Silex\ServiceProviderInterface;

class ExceptionHandlerServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app->error(
            function (ResponseException $exception) {
                return new JsonErrorResponse($exception);
            }
        );

        $app->error(
            function (\CultureFeed_Exception $cfException) {
                $responseException = ReadableCodeResponseException::fromCultureFeedException($cfException);
                return new JsonErrorResponse($responseException);
            }
        );
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     *
     * @param Application $app
     */
    public function boot(Application $app)
    {
    }
}
