<?php

namespace hateoasLaravel\Domain\UseCases;

use Exception;
use hateoasLaravel\Domain\ValueObject\JsonResponse;
use \Illuminate\Http\JsonResponse as LaravelJsonResponse;

class HateoasLaravel
{
    public function __construct()
    {
    }

    /**
     *
     * @param int $code
     * @return bool
     */
    private function orientateCode(int $code): bool
    {
        $success = [200, 201];

        if (in_array($code, $success)) {
            return true;
        }

        return false;
    }

    private function formatToHateoas(string $classForResponse, string $hashMessage, ?int $code, ?array $dataToFormatter): array
    {
        return [
            $classForResponse => $dataToFormatter,
            'message' => $hashMessage,
            'success' => $this->orientateCode($code)
        ];
    }

    /**
     *
     * Formatted a universal response object to Hateoas response
     *
     * @param string $classInResponse
     * @param string $hashMessage
     * @param int|null $code
     * @param array|null $dataResponse
     * @return LaravelJsonResponse
     */
    public function formatResponse(string $classInResponse,
                                   string $hashMessage,
                                   ?int   $code = null,
                                   ?array $dataResponse = null): LaravelJsonResponse
    {
        try {
            $validate = new JsonResponse(
                $this->formatToHateoas(
                    $classInResponse,
                    $hashMessage,
                    $code,
                    $dataResponse
                )
            );

            return new LaravelJsonResponse(
                $validate->getArray(),
                (!is_null($code)) ? $code : 200,
                [
                    'Content-Type', 'application/json'
                ]
            );
        } catch (Exception $exceptionFormatter) {
            return new LaravelJsonResponse(
                $dataResponse,
                (!is_null($code)) ? $code : 200,
                [
                    'Content-Type', 'application/json'
                ]
            );
        }
    }
}
