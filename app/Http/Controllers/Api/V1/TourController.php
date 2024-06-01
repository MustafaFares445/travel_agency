<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToursListRequest;
use App\Http\Resources\V1\TourResource;
use App\Models\Travel;
use App\Services\TourService;
use Illuminate\Http\JsonResponse;

class TourController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ToursListRequest $request , Travel $travel , TourService $tourService): JsonResponse
    {
        $tours = $tourService->getToursFiltered($request , $travel);

        return $this->generateJsonResponse(
            data: TourResource::collection($tours),
            message: trans('Travel Has been Retrieved successfully'),
        );
    }
}
