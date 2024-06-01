<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse
{
    use GeneratePaginationMeta;
    public function generateJsonResponse(
        mixed $data = null,
        ?string $message = null,
        $metaData = null,
        int $statusCode = 200,
        bool $result = true,
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
