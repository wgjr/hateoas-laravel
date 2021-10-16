<?php

namespace hateoasLaravel\Domain\ValueObject;

use Exception;
use JsonSerializable;
use RuntimeException;

class JsonResponse implements JsonSerializable
{
    private string $response;

    public function __construct(array $responseObject)
    {
        try {
            $this->response = json_encode($responseObject);

            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    throw new RuntimeException(
                        'Maximum stack depth exceeded in formatter JSON Response'
                    );
                case JSON_ERROR_STATE_MISMATCH:
                    throw new RuntimeException(
                        ' Underflow or the modes mismatch in formatter JSON Response'
                    );
                case JSON_ERROR_CTRL_CHAR:
                    throw new RuntimeException(
                        'Unexpected control character found in formatter JSON Response'
                    );
                case JSON_ERROR_SYNTAX:
                    throw new RuntimeException(
                        'Syntax error, malformed JSON in formatter JSON Response'
                    );
                case JSON_ERROR_UTF8:
                    throw new RuntimeException(
                        'Malformed UTF-8 characters, possibly incorrectly encoded in formatter JSON Response'
                    );
                default:
                    throw new RuntimeException(
                        'Unknown error in formatter JSON Response'
                    );
            }
        } catch (Exception $exceptionFormatResponse){
            throw new RuntimeException(
                'Unknown error in formatter JSON Response'
            );
        }
    }

    public function jsonSerialize(): string
    {
        return $this->response;
    }

    public function __toString()
    {
        return $this->response;
    }
}