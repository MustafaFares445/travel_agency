<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TourRequest;
use App\Http\Resources\V1\TourResource;
use App\Models\Travel;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TourController extends ApiController
{
    public function store(TourRequest $request , Travel $travel): JsonResponse
    {
       $tour = $travel->tours()->create($request->validated());

        return $this->generateJsonResponse(
            data: TourResource::make($tour),
            message: trans('Tour Has been Created successfully'),
            statusCode: ResponseAlias::HTTP_CREATED,
        );
    }
}
