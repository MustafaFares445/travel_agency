<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    public function generateJsonResponse(
        mixed $data = null,
        ?string $message = null,
        int $statusCode = 200,
        bool $result = true,
        ?array $metaData = null,
    ): JsonResponse
    {
        $response = [];

        if ($message !== null) {
            $response['message'] = $message;
        }

        if ($data !== null) {
            $response['data'] = $data;
        }

        if ($metaData !== null) {
            $response['meta'] = $metaData;
        }

        $response['status'] = $statusCode;
        $response['result'] = $result;

        return response()->json($response, $statusCode);
    }
}
