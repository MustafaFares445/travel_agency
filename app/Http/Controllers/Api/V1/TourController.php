<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToursListRequest;
use App\Http\Resources\V1\TourResource;
use App\Models\Travel;
use App\Services\TourService;

class TourController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(ToursListRequest $request , Travel $travel , TourService $tourService)
    {
        $tours = $tourService->getToursFiltered($request , $travel);

        return $this->generateJsonResponse(
            data: TourResource::collection($tours),
            message: trans('Travel Has been Created successfully'),
            metaData: $this->generatePaginationMeta($tours),
        );
    }
}
