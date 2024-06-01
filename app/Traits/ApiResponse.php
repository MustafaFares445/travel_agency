<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    use GeneratePaginationMeta;
    public function generateJsonResponse(
        mixed $data = null,
        ?string $message = null,
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

        if ($data instanceof LengthAwarePaginator) {
            $response['meta'] = $this->generatePaginationMeta($data);
        }

        $response['status'] = $statusCode;
        $response['result'] = $result;

        return response()->json($response, $statusCode);
    }
}
