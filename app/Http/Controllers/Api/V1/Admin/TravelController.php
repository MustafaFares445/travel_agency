<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\V1\TravelResource;
use App\Models\Travel;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TravelController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelRequest $request): JsonResponse
    {
        $travel = Travel::create($request->validated());

        return $this->generateJsonResponse(
            data: TravelResource::make($travel),
            message: trans('Travel Has been Created successfully'),
            statusCode: ResponseAlias::HTTP_CREATED,
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TravelRequest $request, Travel $travel): JsonResponse
    {
        $travel->update($request->validated());

        return $this->generateJsonResponse(
            data: TravelResource::make($travel),
            message: trans('Travel Has been Updated successfully'),
        );
    }
}
