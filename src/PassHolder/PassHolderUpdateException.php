<?php

namespace CultuurNet\UiTPASBeheer\PassHolder;

use CultuurNet\UiTPASBeheer\Exception\ReadableCodeExceptionInterface;
use CultuurNet\UiTPASBeheer\Exception\ResponseException;

class PassHolderUpdateException extends ResponseException implements ReadableCodeExceptionInterface
{
    /**
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($code = 500, \CultureFeed_Exception $previous = null)
    {
        $message = 'Something went wrong while updating the passholder.';

        if (!is_null($previous)) {
            $message .= ' (' . $previous->getMessage() . ')';
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public static function getReadableCode()
    {
        return 'PASSHOLDER_UPDATE_CULTUREFEED_ERROR';
    }
}
